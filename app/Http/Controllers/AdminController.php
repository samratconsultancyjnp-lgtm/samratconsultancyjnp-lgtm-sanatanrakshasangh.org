<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\User;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Designation;
use App\Models\Setting;
use App\Models\DocumentTemplate;

use App\Models\GalleryAlbum;
use App\Models\GalleryMedia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationReceiptMail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_members' => Member::count(),
            'pending_approvals' => Member::where('status', 'pending')->count(),
            'total_donations' => Donation::where('status', 'approved')->sum('amount'),
            'total_events' => Event::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // Member Management
    public function members()
    {
        $members = Member::with('user', 'designation')->latest()->paginate(20);
        return view('admin.members.index', compact('members'));
    }

    public function approveMember(Member $member)
    {
        $member->update(['status' => 'approved']);
        return back()->with('success', 'Member approved successfully.');
    }

    public function memberShow(Member $member)
    {
        $member->load('user', 'designation');
        return view('admin.members.show', compact('member'));
    }

    public function downloadIdCard(Member $member)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $template = DocumentTemplate::where('type', 'id_card')->first();
        
        // Convert Photo to Base64
        $photoBase64 = null;
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
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

    public function downloadJoiningLetter(Member $member)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $template = DocumentTemplate::where('type', 'joining_letter')->first();
        $pdf = Pdf::loadView('admin.members.joining_letter', compact('member', 'settings', 'template'));
        return $pdf->download('Joining_Letter_'.$member->user->name.'.pdf');
    }

    public function rejectMember(Member $member)
    {
        $member->update(['status' => 'rejected']);
        return back()->with('success', 'Member rejected.');
    }

    // Donation Management
    public function donations()
    {
        $donations = Donation::latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function approveDonation(Donation $donation)
    {
        $donation->update(['status' => 'approved']);
        
        // Send Email Receipt
        $settings = Setting::all()->pluck('value', 'key');
        Mail::to($donation->email)->send(new DonationReceiptMail($donation, $settings));

        return back()->with('success', 'Donation approved and receipt sent to donor.');
    }

    public function downloadReceipt(Donation $donation)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $pdf = Pdf::loadView('admin.donations.receipt', compact('donation', 'settings'));
        return $pdf->download('Donation_Receipt_'.$donation->transaction_id.'.pdf');
    }

    // Event Management
    public function eventsIndex()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function eventsCreate()
    {
        return view('admin.events.create');
    }

    public function eventsStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->only(['title', 'event_date', 'description']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function eventsEdit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function eventsUpdate(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'description' => 'required',
        ]);

        $data = $request->only(['title', 'event_date', 'description']);
        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function eventsDestroy(Event $event)
    {
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    // Gallery Management
    public function galleryIndex()
    {
        $albums = GalleryAlbum::with('media')->get();
        return view('admin.gallery.index', compact('albums'));
    }

    public function galleryStoreAlbum(Request $request)
    {
        GalleryAlbum::create($request->validate(['name' => 'required']));
        return back()->with('success', 'Album created.');
    }

    public function galleryStoreMedia(Request $request)
    {
        $request->validate([
            'gallery_album_id' => 'required',
            'file' => 'required|file',
            'type' => 'required|in:image,video',
        ]);

        $path = $request->file('file')->store('gallery', 'public');
        GalleryMedia::create([
            'gallery_album_id' => $request->gallery_album_id,
            'file_path' => $path,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Media uploaded.');
    }

    public function galleryDestroyAlbum(GalleryAlbum $album)
    {
        foreach ($album->media as $media) {
            Storage::disk('public')->delete($media->file_path);
            $media->delete();
        }
        $album->delete();
        return back()->with('success', 'Album and its media deleted.');
    }

    public function galleryDestroyMedia(GalleryMedia $media)
    {
        Storage::disk('public')->delete($media->file_path);
        $media->delete();
        return back()->with('success', 'Media deleted.');
    }

    // Designations
    public function designationsIndex()
    {
        $designations = Designation::all();
        return view('admin.designations.index', compact('designations'));
    }

    public function designationsStore(Request $request)
    {
        Designation::create($request->validate(['name' => 'required']));
        return back()->with('success', 'Designation added.');
    }

    public function designationsDestroy(Designation $designation)
    {
        $designation->delete();
        return back()->with('success', 'Designation deleted.');
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Settings updated.');
    }

    public function templates()
    {
        $idCard = DocumentTemplate::where('type', 'id_card')->first();
        $joiningLetter = DocumentTemplate::where('type', 'joining_letter')->first();
        return view('admin.templates', compact('idCard', 'joiningLetter'));
    }

    public function updateTemplates(Request $request)
    {
        $request->validate([
            'type' => 'required|in:id_card,joining_letter',
            'header' => 'nullable|image',
            'footer' => 'nullable|image',
            'watermark' => 'nullable|image',
        ]);

        $template = DocumentTemplate::updateOrCreate(['type' => $request->type]);

        if ($request->hasFile('header')) {
            $template->header = $request->file('header')->store('templates', 'public');
        }
        if ($request->hasFile('footer')) {
            $template->footer = $request->file('footer')->store('templates', 'public');
        }
        if ($request->hasFile('watermark')) {
            $template->watermark = $request->file('watermark')->store('templates', 'public');
        }

        $template->save();
        return back()->with('success', 'Template updated.');
    }

    // Slider Management
    public function slidersIndex()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function slidersStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        return back()->with('success', 'Slider image added successfully.');
    }

    public function slidersDestroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return back()->with('success', 'Slider image removed.');
    }

    // Export Management
    public function membersExport()
    {
        $fileName = 'members_export_' . date('Y-m-d') . '.csv';
        $members = Member::with('user', 'designation')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Name', 'Email', 'Father Name', 'Mobile', 'Designation', 'Status', 'Joined Date'];

        $callback = function() use($members, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($members as $member) {
                fputcsv($file, [
                    $member->id,
                    $member->user->name,
                    $member->user->email,
                    $member->father_name,
                    $member->mobile,
                    $member->designation->name ?? 'N/A',
                    $member->status,
                    $member->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function donationsExport()
    {
        $fileName = 'donations_export_' . date('Y-m-d') . '.csv';
        $donations = Donation::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Donor Name', 'Email', 'Mobile', 'Amount', 'TXN ID', 'PAN', 'Status', 'Date'];

        $callback = function() use($donations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->name,
                    $donation->email,
                    $donation->mobile,
                    $donation->amount,
                    $donation->transaction_id,
                    $donation->pan_number,
                    $donation->status,
                    $donation->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function teamIndex()
    {
        $team = \App\Models\Team::orderBy('sort_order')->get();
        return view('admin.team.index', compact('team'));
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'photo' => 'required|image|max:2048',
            'sort_order' => 'nullable|integer'
        ]);

        $path = $request->file('photo')->store('team', 'public');

        \App\Models\Team::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'photo' => $path,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return back()->with('success', 'Team member added successfully.');
    }

    public function teamDestroy(\App\Models\Team $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();
        return back()->with('success', 'Team member removed.');
    }
}
