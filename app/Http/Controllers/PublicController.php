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
        return view('public.about', compact('aboutText'));
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
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'member',
        ]);

        Member::create([
            'user_id' => $user->id,
            'father_name' => $request->father_name,
            'dob' => $request->dob,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'state' => $request->state,
            'district' => $request->district,
            'designation_id' => $request->designation_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Registration submitted successfully. Please wait for admin approval.');
    }

    public function storeDonation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        Donation::create($request->all());

        return back()->with('success', 'Donation submitted. Our team will contact you soon.');
    }
}
