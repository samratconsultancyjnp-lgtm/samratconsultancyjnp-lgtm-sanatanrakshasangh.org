@extends('layouts.admin')

@section('title', 'Event Management')

@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 2rem;">
    <a href="{{ route('admin.events.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Create New Event</a>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$event->image) }}" style="width: 80px; height: 50px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                </td>
                <td style="font-weight: 700; color: var(--text-main);">{{ $event->title }}</td>
                <td>
                    <span style="color: var(--text-muted);"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}</span>
                </td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn-admin" style="background: #ebf8ff; color: #3182ce; text-decoration: none; padding: 0.5rem 1rem;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-admin btn-reject" style="padding: 0.5rem 1rem;" onclick="return confirm('Delete event?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 2rem;">
        {{ $events->links() }}
    </div>
</div>
@endsection
