<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\DocumentTemplate;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    public function dashboard()
    {
        $member = Member::where('user_id', auth()->id())->with('designation')->first();
        if (!$member) abort(404);
        
        $donations = \App\Models\Donation::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalDonations = $donations->where('status', 'approved')->sum('amount');
        
        return view('member.dashboard', compact('member', 'donations', 'totalDonations'));
    }

    public function downloadIdCard()
    {
        $member = Member::where('user_id', auth()->id())->with('user', 'designation')->first();
        if (!$member || $member->status !== 'approved') abort(403, 'Unauthorized or Member not approved yet.');

        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $template = DocumentTemplate::where('type', 'id_card')->first();
        
        // Convert Photo to Base64
        $photoBase64 = null;
        if ($member->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($member->photo)) {
            $path = storage_path('app/public/' . $member->photo);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $photoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        // Generate QR Code and convert to Base64
        $qrData = "Member: " . $member->user->name . "\nID: SRS-" . str_pad($member->id, 5, '0', STR_PAD_LEFT) . "\nMobile: " . $member->mobile . "\nStatus: Approved";
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrData);
        $qrContext = stream_context_create([
            "ssl" => ["verify_peer" => false, "verify_peer_name" => false]
        ]);
        $qrContent = @file_get_contents($qrUrl, false, $qrContext);
        $qrBase64 = $qrContent ? 'data:image/png;base64,' . base64_encode($qrContent) : null;

        $pdf = Pdf::loadView('admin.members.id_card', compact('member', 'settings', 'template', 'photoBase64', 'qrBase64'))->setPaper('a4', 'portrait');
        return $pdf->download('ID_Card_'.$member->user->name.'.pdf');
    }

    public function downloadJoiningLetter()
    {
        $member = Member::where('user_id', auth()->id())->with('user', 'designation')->first();
        if (!$member || $member->status !== 'approved') abort(403, 'Unauthorized or Member not approved yet.');

        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $template = DocumentTemplate::where('type', 'joining_letter')->first();
        $pdf = Pdf::loadView('admin.members.joining_letter', compact('member', 'settings', 'template'));
        return $pdf->download('Joining_Letter_'.$member->user->name.'.pdf');
    }

    public function districtMembers()
    {
        $currentMember = Member::where('user_id', auth()->id())->first();
        if (!$currentMember) abort(404);

        $districtMembers = Member::where('district', $currentMember->district)
            ->where('status', 'approved')
            ->with('user', 'designation')
            ->get();

        return view('member.district-members', compact('districtMembers', 'currentMember'));
    }

    public function downloadReceipt(\App\Models\Donation $donation)
    {
        if ($donation->user_id !== auth()->id() || $donation->status !== 'approved') {
            abort(403, 'Unauthorized or donation not approved.');
        }

        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.donations.receipt', compact('donation', 'settings'));
        return $pdf->download('Donation_Receipt_'.$donation->transaction_id.'.pdf');
    }
}
