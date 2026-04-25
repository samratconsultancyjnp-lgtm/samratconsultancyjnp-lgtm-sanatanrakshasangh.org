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
        
        return view('member.dashboard', compact('member'));
    }

    public function downloadIdCard()
    {
        $member = Member::where('user_id', auth()->id())->with('user', 'designation')->first();
        $template = DocumentTemplate::where('type', 'id_card')->first();
        
        $pdf = Pdf::loadView('member.pdf.id-card', compact('member', 'template'));
        return $pdf->download('ID_Card_'.$member->user->name.'.pdf');
    }

    public function downloadJoiningLetter()
    {
        $member = Member::where('user_id', auth()->id())->with('user', 'designation')->first();
        $template = DocumentTemplate::where('type', 'joining_letter')->first();
        
        $pdf = Pdf::loadView('member.pdf.joining-letter', compact('member', 'template'));
        return $pdf->download('Joining_Letter_'.$member->user->name.'.pdf');
    }
}
