<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Event;
use App\Http\Requests\EventRequest;
use App\Repositories\EventsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    protected $eventsRepository;

    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    public function index()
    {
        $events = $this->eventsRepository->getEvents();

        return response()->json($events);
    }

    public function store(EventRequest $eventRequest)
    {
        $eventRequest->all();

        $this->eventsRepository->postNewEvent($eventRequest);

        return redirect('/events_blade')->with('success', 'Event added successfully');
    }

    public function show($id)
    {
        $event = $this->eventsRepository->getEvent($id);

        $activities = $event->activities()->get(); //From activities repository?

        $data = [
            'event' => $event,
            'activities' => $activities
        ];

        return view('events.show')->with('data', $data);
    }

    public function create()
    {
        $activities = Activity::all(); //Try calling this from the activities repository when I create it

        return view ('events.create')->with('activities', $activities);
    }

    public function edit($id)
    {
        $event = $this->eventsRepository->getEvent($id);

        $activities = Activity::all(); //Try calling this from the activities repository when I create it

        $data = [
            'event' => $event,
            'activities' => $activities
        ];

        return view('events.edit')->with('data', $data);
    }

    public function update(EventRequest $request, Event $event)
    {

        $this->eventsRepository->updateEvent($request, $event);

        return redirect('/events_blade')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $this->eventsRepository->deleteEvent($id);

        return redirect('/events_blade')->with('success', 'Event deleted successfully');
    }
}
