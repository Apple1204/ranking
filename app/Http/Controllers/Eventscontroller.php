<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\EventOut;


class EventsController extends Controller
{
    //
    public function index() {
        $event = Event::select('id', 'name', 'order')->get();
        return view('pages.events.event', compact('event'));
    }

    public function index_out() {
        return view('pages.events.event_out');
    }

    public function create(Request $request) {
        $request->validate([
            "name"=>"required|unique:event,name",
        ]);

        $input = $request->all();

        Event::create($input);

        return back()->with("success", "Event created successfully");
    }

    public function update(Request $request, $id) {
        $request->validate([
            "name"=>"required|unique:event,name,".$id,
        ]);

        $input = $request->except(['_token']);

        Event::where('id', $id)->update($input);

        return back()->with("success", "event updated successfully");
    }

    public function destroy(Event $id) {

        $id->delete();
        return "success";
    }
}
