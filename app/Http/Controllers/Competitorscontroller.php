<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competitors;
use App\Models\Leagues;
use App\Models\Category;
use App\Models\Division;
use App\Models\Points;

class CompetitorsController extends Controller
{
    //
    public function index() {
        $competitors = Competitors::join('leagues', 'leagueId', '=', 'leagues.id')
                                        ->join('division', 'division.id', '=', 'divisionId')
                                        ->join('category', 'category.id', '=', 'division.categoryId')
                                        ->selectRaw('competitors.id, first_name, last_name, divisionId, competitors.photo, competitors.gender, leagueId, leagues.photo as image, leagues.short_name, 
                                        category.name as cname, division.weight')
                                        ->get();
        $league = Leagues::select('id', 'name', 'short_name')->get();
        $category = Category::select('id', 'name')->get();
        $division = Division::select('id', 'categoryId', 'gender', 'weight')->get();
        return view('pages.competitors', compact('competitors', 'league', 'category', 'division'));
    }

    public function create(Request $request) {

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender'=>'required',
            'leagueId'=>'required',
            'divisionId'=>'required'
        ]);
        
        $input = $request->all();

        if($request->hasFile('photo'))
        {
            $imageName = time(). "." .$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('upload/competitors', $imageName);
            $input['photo'] = "$imageName";
        }

        Competitors::create($input);
     
        return back()->with('success','competitors created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender'=>'required',
            'leagueId'=>'required',
            'divisionId'=>'required',
        ]);
        
        $input = $request->except(['_token']);

        if($request->hasFile('photo'))
        {
            $imageName = time(). "." .$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('upload/competitors', $imageName);
            $input['photo'] = "$imageName";
        }

        Competitors::where('id', $id)->update($input);
     
        return back()->with('success','competitors updated successfully.');
    }

    public function destroy($id) {
        Competitors::whereId($id)->delete();
        Points::where('competitorId', '=', $id)->delete();
        return "success";
    }
}
