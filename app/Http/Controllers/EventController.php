<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();

//        $events = Event::with('activities')->get();

        return response()->json( $events );
    }

    public function getEvent( $id ){
        $event = Event::where('id', '=', $id)
            ->with('activities')
            ->first();

//        $event = Event::all()->where('id', '=', $id)->first();

        return response()->json( $event );
    }

    public function postNewEvent(){
        $event = new Event();

        $event->name = request('name');
        $event->frequency  = request('frequency');
        $event->start_date_and_time = request('start_date_and_time');
        $event->lead_start_date = request('lead_start_date');
        $event->lead_duration =request('lead_duration');
        $event->owner_id = auth()->id();
        $event->category_id = 7;
        $event->team_id = 7;

        $event->save();

        return response()->json($event, 201);
    }



//    public function edit($id)
//    {
//        return Event::find($id);
//    }
//
//    public function update(Request $request, Event $event, $id)
//    {
//        $this->validate($request, [
//            'name' => 'required',
//            'frequency' => 'required',
//            'start_date_and_time' => 'required',
//            'lead_start_date' => 'required',
//            'lead_duration' => 'required',
//        ]);
//
//        $event = Event::find($id);
//        if ($event->count()){
//            $event->update($request->all());
//            return response()->json(['status'=>'success','msg'=>'Event updated successfully']);
//        }
//            else {
//                return response()->json(['status'=>'error','msg'=>'Error in updating event']);
//            }
//    }
//
//    public function destroy(Event $event, $id)
//    {
//        $event = Event::find($id);
//        if ($event->count()){
//            $event->delete();
//            return response()->json(['status'=>'success','msg'=>'Event deleted successfully']);
//        }
//        else {
//            return response()->json(['status'=>'error','msg'=>'Error in deleting event']);
//        }
//    }
}
