<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 13/08/2018
 * Time: 5:55 PM
 */

namespace App\Repositories;

use App\Event;

class EventsRepository
{
    public function __construct()
    {
    }

    public function getEvents()
    {
        return Event::all();
    }

    public function getEvent($id)
    {
        return Event::all()->where('id', '=', $id)->first();
    }

    public function postNewEvent()
    {
        $event = new Event();

        $event->name = request('name');
        $event->frequency = request('frequency');
        $event->start_date = request('start_date');
        $event->start_time = request('start_time');
        $event->lead_start_date = request('lead_start_date');
        $event->location = request('location');
        $event->team_id = 7;
        $event->category_id = 1;
        $event->activity_id = 2;

        return $event->save();
    }

    public function editEvent($request, $event, $id)
    {
        $event = Event::find($id);
        if ($event->count()) {
            $event->update($request->all());
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent(Event $event, $id)
    {
        $event = Event::find($id);
        if ($event->count()) {
            $event->delete();
            return true;
        } else {
            return false;
        }
    }
}