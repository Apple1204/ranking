<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Leagues;
use App\Models\Division;
use App\Models\Points;
use App\Models\Competitors;

class MainController extends Controller
{
    //
    public function index() {
        $category = Category::select('id', 'name')->get();
        $leagues = Leagues::select('id', 'name', 'short_name')->get();
        return view('pages.main', compact('category', 'leagues'));
    }

    public function showWeight(Request $request) {
        $category = Division::where('categoryId', $request->categoryId)
                        ->select('id', 'gender', 'weight')
                        ->get();
        return ['success', compact('category')];
    }

    public function showRanking(Request $request) {
        $date = date('Y-m-d');
        $pDate = date("Y-m-d",strtotime ( '-1 year' , strtotime ( $date ) ));
        $bDate = date("Y-m-d",strtotime ( '-1 year' , strtotime ( $pDate ) ));
        $bpDate = date("Y-m-d",strtotime ( '-1 year' , strtotime ( $bDate ) ));
        $event = Points::select('event.id', 'name')
                        ->leftJoin('event', 'event.id', 'eventId')
                        ->groupBy('event.id')
                        ->orderBy('order', 'asc')
                        ->orderBy('date', 'desc')
                        ->get();
        $point = Competitors::leftJoin("points", function($join) use($bpDate) {
                                    $join->on('competitors.id', '=', 'points.competitorId')
                                        ->where('points.date', '>=', $bpDate);
                                })
                            ->join('leagues', 'leagues.id', '=', 'competitors.leagueId')
                            ->join('division', 'competitors.divisionId', '=', 'division.id')
                            ->where('division.categoryId', '=', $request->cId);
        if($request->dId > 0)
            $point->where('divisionId', '=', $request->dId);
        else if($request->dId < 0)
            $point->where('competitors.gender', '=', abs($request->dId));
        if($request->lId > 0)
            $point->where('competitors.leagueId', '=', $request->lId);
        $eventPoint = clone $point;
        $point = $point->leftJoin('event_out', 'event_out.competitorId', '=', 'competitors.id')
                        ->selectRaw('competitors.id as id, competitors.first_name, competitors.last_name, competitors.photo as avatar, leagues.short_name as league, leagues.photo, SUM(IF(points.date < "'.$bDate.'", point/4, IF(points.date >= "'.$pDate.'", point, point/2))) as point, division.weight')
                        ->groupBy('competitors.id')
                        ->orderBy('point', 'desc')
                        ->orderBy('new_point', 'desc')
                        ->get();
        $ePoint = $eventPoint->selectRaw('eventId, points.competitorId as id, IF(points.date < "'.$pDate.'", point/4, IF(points.date >= "'.$pDate.'", point, point/2)) as point')
                            ->get();
        return ["success", compact('event', 'point', 'ePoint')];
    }
}
