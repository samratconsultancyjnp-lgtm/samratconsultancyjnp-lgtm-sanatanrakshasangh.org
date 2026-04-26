@extends('layouts.admin')

@section('title', isset($event) ? 'Edit Event' : 'Create New Event')

@section('content')
<div class="card" style="padding: 3rem; max-width: 800px; margin: 0 auto;">
    <form action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($event)) @method('POST') @endif
        
        <div class="form-group">
            <label>Event Title</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title ?? old('title') }}" required>
        </div>

        <div class="form-group">
            <label>Event Date</label>
            <input type="date" name="event_date" class="form-control" value="{{ isset($event) ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : old('event_date') }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $event->description ?? old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Event Image</label>
            @if(isset($event) && $event->image)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/'.$event->image) }}" style="width: 200px; border-radius: 10px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control" {{ isset($event) ? '' : 'required' }}>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn-primary" style="width: 100%;">{{ isset($event) ? 'Update Event' : 'Create Event' }}</button>
        </div>
    </form>
</div>
@endsection
