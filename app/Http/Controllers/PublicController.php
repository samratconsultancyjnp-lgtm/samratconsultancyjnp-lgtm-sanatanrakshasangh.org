<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Member;
use App\Models\Event;
use App\Models\Donation;
use App\Models\GalleryAlbum;
use App\Models\Designation;
use App\Models\Setting;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        $sliders = Slider::orderBy('order')->get();
        $totalMembers = Member::where('status', 'approved')->count();
        $totalProjects = Setting::where('key', 'total_projects')->first()->value ?? 0;
        $totalEvents = Event::count();
        $events = Event::latest()->take(3)->get();
        
        return view('public.home', compact('sliders', 'totalMembers', 'totalProjects', 'totalEvents', 'events'));
    }

    public function about()
    {
        $aboutText = Setting::where('key', 'about_content')->first()->value ?? 'About our NGO...';
        $team = \App\Models\Team::orderBy('sort_order')->get();
        return view('public.about', compact('aboutText', 'team'));
    }

    public function events()
    {
        $events = Event::latest()->paginate(9);
        return view('public.events', compact('events'));
    }

    public function gallery()
    {
        $albums = GalleryAlbum::with('media')->get();
        return view('public.gallery', compact('albums'));
    }

    public function joinUs()
    {
        $designations = Designation::all();
        return view('public.join-us', compact('designations'));
    }

    public function donation()
    {
        return view('public.donation');
    }

    public function showEvent(Event $event)
    {
        return view('public.event-details', compact('event'));
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'father_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
            'state' => 'required|string',
            'district' => 'required|string',
            'designation_id' => 'required|exists:designations,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'member',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members/photos', 'public');
        }

        Member::create([
            'user_id' => $user->id,
            'father_name' => $request->father_name,
            'dob' => $request->dob,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'state' => $request->state,
            'district' => $request->district,
            'designation_id' => $request->designation_id,
            'photo' => $photoPath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Registration submitted successfully. Please wait for admin approval.');
    }

    public function storeDonation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'pan_number' => 'nullable|string|max:10',
            'message' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'mobile', 'email', 'amount', 'pan_number', 'message']);
        $data['transaction_id'] = 'TXN' . strtoupper(Str::random(10));
        $data['status'] = 'pending';
        $data['user_id'] = auth()->id();

        $donation = Donation::create($data);

        return back()->with('donation_success', [
            'id' => $donation->id,
            'name' => $donation->name,
            'amount' => $donation->amount,
            'transaction_id' => $donation->transaction_id,
            'upi_id' => Setting::where('key', 'upi_id')->first()->value ?? 'ngo@upi',
            'bank_name' => Setting::where('key', 'bank_name')->first()->value ?? 'N/A',
            'account_number' => Setting::where('key', 'account_number')->first()->value ?? 'N/A',
            'ifsc_code' => Setting::where('key', 'ifsc_code')->first()->value ?? 'N/A',
        ]);
    }

    public function submitPayment(Request $request)
    {
        $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'transaction_id' => 'required|string|max:255',
        ]);

        $donation = Donation::findOrFail($request->donation_id);

        // Security Check: Only allow updating pending donations that haven't been submitted yet (TXN prefix)
        // or allow updating if it belongs to the logged-in user and is pending.
        $isOwner = auth()->check() && $donation->user_id == auth()->id();
        $isPendingRecord = $donation->status === 'pending' && str_starts_with($donation->transaction_id, 'TXN');

        if (!$isOwner && !$isPendingRecord) {
            abort(403, 'This donation record cannot be updated.');
        }

        $donation->update([
            'transaction_id' => $request->transaction_id,
            'status' => 'pending'
        ]);

        return redirect()->route('donation')->with('final_success', 'Thank you! Your payment record has been submitted and is pending for approval. You will receive the receipt on your email once approved.');
    }
}
