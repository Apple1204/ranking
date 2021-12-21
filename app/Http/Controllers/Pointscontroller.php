<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\Competitors;
use App\Models\Event;
use App\Models\Category;
use App\Models\division;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{
    //
    public function index() {
        
        $category = Category::select('id', 'name')->get();
        $division = Division::select('id', 'categoryId', 'gender', 'weight')->get();
        $event = Event::select('id', 'name')->get();

        return view('pages.points', compact('event', 'category', 'division'));
    }

    public function index_edit() {
        $points = Points::join('competitors', 'competitors.id', '=', 'competitorId')
                        ->join('event', 'event.id', '=', 'eventId')
                        ->join('leagues', 'leagues.id', '=', 'leagueId')
                        ->join('division', 'divisionId', '=', 'division.id')
                        ->join('category', 'category.id', '=', 'division.categoryId')
                        ->selectRaw('points.id, competitors.first_name, competitors.last_name, competitors.photo, date, category.name as category, leagues.name as leauge, division.weight, event.name as event, eventId, point, ranking')
                        ->orderBy('ranking')
                        ->orderBy('date', 'desc')
                        ->get();
        $events = Event::select('id', 'name')->get();

        return view('pages.pointsedit', compact('points', 'events'));
    }

    public function search(Request $request) {
        $name = $request->name;
        $divisionId = $request->divisionId;
        $competitors = Competitors::where('divisionId', $divisionId)
                                    ->where(function($q) use($name) {
                                        $q->where('first_name', 'like', '%'.$name.'%')
                                          ->orWhere('last_name', 'like', '%'.$name.'%');
                                    })
                                    ->selectRaw('competitors.id, first_name, last_name, photo')
                                    ->get();
        return ["success", compact('competitors')];
    }

    public function destroy(Points $id) {

        $id->delete();

        return "success";
    }

    public function insert(Request $request) {
        $request->validate([
            "ranking"=>"required",
        ]);
        Points::create(['competitorId'=>$request->id, 'point'=>$request->point, 'eventId'=>$request->eventId, 'date'=>$request->date, 'ranking'=>$request->ranking]);
        //$point->save();
        
        return "success";
    }

    public function update(Request $request) {
        $request->validate([
            "ranking"=>"required",
        ]);

        Points::whereId($request->id)->update(['point'=>$request->point, 'ranking'=>$request->ranking, 'eventId'=>$request->eventId, 'date'=>$request->date]);

        return "success";
    }

    public function get(Points $id) {

        $id->select('ranking', 'point')->get();

        return ["success", compact('id')];
    }
}
