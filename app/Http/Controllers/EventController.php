<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{

    public function list(): View
    {
        return view('events.list', [
            'events' => Event::all()
        ]);
    }

    public function details($id): View
    {
        $event = Event::query()->findOrFail($id);
        return view('events.details', [
            'event' => $event,
            'user' => $event->user,
        ]);
    }

    public function addEventForm(): View
    {
        return view('events.create', [
            'users' => User::all(),
        ]);
    }

    public function addEvent(Request $request): RedirectResponse
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'notes' => $request->input('notes'),
            'dt_start' => $request->input('dt_start'),
            'dt_end' => $request->input('dt_end'),
        ]);
        $event->save();
        return to_route('events');
    }

    public function editEventForm($id): View
    {
        return view('events.create', [
            'event' => Event::query()->findOrFail($id),
            'users' => User::all(),
        ]);
    }

    public function editEvent($id, Request $request): RedirectResponse
    {
        $event = Event::query()->findOrFail($id);
        $event->update([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'notes' => $request->input('notes'),
            'dt_start' => $request->input('dt_start'),
            'dt_end' => $request->input('dt_end'),
        ]);
        return to_route('events');
    }

    public function deleteEvent($id): RedirectResponse
    {
        $event = Event::query()->findOrFail($id);
        $event->delete();
        return to_route('events');
    }

}
