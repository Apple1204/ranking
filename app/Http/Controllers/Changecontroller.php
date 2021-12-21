<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competitors;
use App\Models\Leagues;
use App\Models\EventOut;
Use App\Models\Leaguehistory;
Use App\Models\Points;
Use App\Models\Category;
Use App\Models\Division;
Use App\Models\Weighthistory;
Use App\Models\Categoryhistory;

class ChangeController extends Controller
{
    //
    public function index() {
        $leagues = Leagues::select('id', 'name')->get();
        $category = Category::select('id', 'name')->get();
        $division = Division::select('id', 'gender', 'categoryId', 'weight')
                            ->get();
        return view('pages.change', compact('leagues', 'category', 'division'));
    }

    public function search(Request $request) {
        $competitors = Competitors::selectRaw('competitors.id as id, first_name, last_name, photo, event_out.id as eId, event_out.new_point')
                    ->leftJoin('event_out', 'competitorId', '=', 'competitors.id')
                    ->where('leagueId', '=', $request->league)
                    ->where(function($q) use($request) {
                        $q->where('first_name', 'like', '%'.$request->name.'%')
                          ->orWhere('last_name', 'like', '%'.$request->name.'%');
                    })
                    ->get();
        return ['success', compact('competitors')];
    }

    public function create(Request $request) {
        EventOut::create(['competitorId'=>$request->id, 'new_point'=>$request->new_point]);
        return "success";
    }

    public function update(Request $request) {
        EventOut::whereId($request->eId)->update(['new_point'=>$request->new_point]);
        return "success";
    }

    public function searchLeague(Request $request) {
        $competitors = Competitors::selectRaw('competitors.id as id, first_name, last_name, competitors.photo, league_history.id as eId, a.photo as oImage, a.short_name as oShort')
                    ->leftJoin('league_history', 'competitors.id', '=', 'competitorId')
                    ->leftJoin('leagues AS a', 'competitors.leagueId', '=', 'a.id')
                    ->where('leagueId', '=', $request->league)
                    ->where(function($q) use($request) {
                        $q->where('first_name', 'like', '%'.$request->name.'%')
                          ->orWhere('last_name', 'like', '%'.$request->name.'%');
                    })
                    ->orderBy('league_history.id', 'desc')->groupBy('competitors.id')
                    ->get();
        return ['success', compact('competitors')];
    }

    public function change(Request $request) {
        Leaguehistory::whereId($request->eId)->update(['change_leagueId'=>$request->cLeague]);

        Competitors::whereId($request->id)->update(['leagueId'=>$request->cLeague]);

        Points::where('competitorId', $request->id)->delete();
        
        return "success";
    }

    public function createLeague(Request $request) {
        Leaguehistory::create(['competitorId'=>$request->id, 'orginal_leagueId'=>$request->oLeague, 'change_leagueId'=>$request->cLeague]);
        Competitors::whereId($request->id)->update(['leagueId'=>$request->cLeague]);
        Points::where('competitorId', $request->id)->delete();
        return "success";
    }

    public function showList(Request $request) {
        $league = Leaguehistory::selectRaw('first_name, last_name, competitors.photo, a.photo as oImage, a.short_name as oShort, b.photo as cImage, b.short_name as cShort')
                    ->join('competitors', 'competitors.id', '=', 'league_history.competitorId')
                    ->join('leagues AS a', 'orginal_leagueId', '=', 'a.id')
                    ->join('leagues AS b', 'change_leagueId', '=', 'b.id')
                    ->where('competitorId', '=', $request->id)
                    ->get();
        return ["success", compact('league')];
    }

    public function searchWeight(Request $request) {
        $competitors = Competitors::selectRaw('competitors.id, first_name, last_name, photo, competitors.gender, category.name, weight, weight_history.id as wId')
                                    ->leftJoin('division', 'division.id', '=', 'competitors.divisionId')
                                    ->leftJoin('category', 'division.categoryId', '=', 'category.id')
                                    ->leftJoin('weight_history', 'weight_history.competitorId', '=', 'competitors.id')
                                    ->where('divisionId', '=', $request->id)
                                    ->where(function($q) use($request) {
                                        $q->where('first_name', 'like', '%'.$request->name.'%')
                                          ->orWhere('last_name', 'like', '%'.$request->name.'%');
                                    })
                                    ->orderBy('weight_history.id', 'desc')->groupBy('competitors.id')
                                    ->get();
        return ['success', compact('competitors')];
    }

    public function createWeight(Request $request) {
        Weighthistory::create(['competitorId'=>$request->id, 'orginal_weight'=>$request->dId, 'change_weight'=>$request->c_dId]);
        Competitors::whereId($request->id)->update(['divisionId'=>$request->c_dId]);
        // Points::where('competitorId', $request->id)->delete();
        return "success";
    }

    public function showWeight(Request $request) {
        $weight = Weighthistory::selectRaw('first_name, last_name, competitors.photo, a.weight as oWeight, b.weight as cWeight')
                    ->join('competitors', 'competitors.id', '=', 'weight_history.competitorId')
                    ->join('division AS a', 'orginal_weight', '=', 'a.id')
                    ->join('division AS b', 'change_weight', '=', 'b.id')
                    ->where('competitorId', '=', $request->id)
                    ->orderBy('weight_history.id')
                    ->get();
        return ["success", compact('weight')];
    }


    public function searchCategory(Request $request) {
        $competitors = Competitors::selectRaw('competitors.id, first_name, last_name, photo, competitors.gender, category.name, weight, category_history.id as wId')
                                    ->leftJoin('division', 'division.id', '=', 'competitors.divisionId')
                                    ->leftJoin('category', 'division.categoryId', '=', 'category.id')
                                    ->leftJoin('category_history', 'category_history.competitorId', '=', 'competitors.id')
                                    ->where('divisionId', '=', $request->id)
                                    ->where(function($q) use($request) {
                                        $q->where('first_name', 'like', '%'.$request->name.'%')
                                          ->orWhere('last_name', 'like', '%'.$request->name.'%');
                                    })
                                    ->orderBy('category_history.id', 'desc')->groupBy('competitors.id')
                                    ->get();
        return ['success', compact('competitors')];
    }

    public function createCategory(Request $request) {
        Categoryhistory::create(['competitorId'=>$request->id, 'orginal_category'=>$request->dId, 'change_category'=>$request->c_dId]);
        Competitors::whereId($request->id)->update(['divisionId'=>$request->c_dId]);
        Points::where('competitorId', $request->id)->delete();
        return "success";
    }

    public function showCategory(Request $request) {
        $category = Categoryhistory::selectRaw('first_name, last_name, competitors.photo, c.name as oName, a.weight as oWeight, d.name as cName, b.weight as cWeight')
                    ->join('competitors', 'competitors.id', '=', 'category_history.competitorId')
                    ->join('division AS a', 'orginal_category', '=', 'a.id')
                    ->join('division AS b', 'change_category', '=', 'b.id')
                    ->join('category AS c', 'c.id', '=', 'a.categoryId')
                    ->join('category AS d', 'd.id', '=', 'b.categoryId')
                    ->where('competitorId', '=', $request->id)
                    ->orderBy('category_history.id')
                    ->get();
        return ["success", compact('category')];
    }
}
