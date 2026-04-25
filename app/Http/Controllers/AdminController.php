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

    public function rejectMember(Member $member)
    {
        $member->update(['status' => 'rejected']);
        return back()->with('success', 'Member rejected.');
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
}
