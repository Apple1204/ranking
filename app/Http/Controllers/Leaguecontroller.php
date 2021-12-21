<?php

namespace App\Http\Controllers;
use App\Models\Leagues;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    //

    public function index()
    {
        $leagues = Leagues::select('id', 'name', 'short_name', 'photo')->get();;
        return view('pages.league',compact('leagues'));
    }

    public function create(Request $request) {
        
        $request->validate([
            'name' => 'unique:leagues,name',
            'short_name' => 'unique:leagues,short_name',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('photo')) {
            
            $imageName = time(). "." .$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('upload/league', $imageName);
            $input['photo'] = "$imageName";
        }

        Leagues::create($input);
     
        return back()->with('success','league created successfully.');
    }

    public function edit(Request $request, $id) {
        
        $request->validate([
            'name' => 'unique:leagues,name,'.$id,
            'short_name' => 'unique:leagues,short_name,' . $id,
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except(['_token']);
        
        if ($request->hasFile('photo')) {
            
            $imageName = time(). "." .$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('upload/league', $imageName);
            $input['photo'] = "$imageName";
        }
        Leagues::where('id', $id)->update($input);
     
        return redirect()->route('league')->with('success','league changed successfully.');
    }

    public function destroy(Leagues $id)
    {
        $id->delete();
        return "success";
    }
}
