<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Division;


class CategoryController extends Controller
{
    //

    public function index() {
        $category = Category::select('id', 'name', 'age_min', 'age_max')->get();
        $division = Division::join('category', 'categoryId', '=', 'category.id')
                            ->selectRaw('division.id, category.id as caId, category.name, division.gender, division.weight')
                            ->get();
        return view('pages.category', compact('category'), compact('division'));
    }

    public function createDv(Request $request) {
        $request->validate([
            "gender"=>"required",
            "weight"=>"required|unique:division,categoryId,gender,weight",
        ]);

        $input = $request->all();

        Division::create($input);

        return redirect()->route("category")->with("success", "Division created successfully.");
    }

    public function create(Request $request) {
        $request->validate([
            "name"=>"required|unique:category,name",
            "age_min"=>"required",
            "age_max"=>"required"
        ]);
        $input = $request->all();

        Category::create($input);

        return back()->with("success", "Category created successfully.");
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            "name"=>"required|unique:category,name,".$id,
        ]);

        $input = $request->except(['_token']);

        Category::where('id', $id)->update($input);
        return back()->with("success", "category changed successfully.");
    }

    public function destroy($id) {
        Category::whereId($id)->delete();
        Division::where('categoryId', '=', $id)->delete();
        return "success";
    }

    public function editDv(Request $request, $id) {
        $request->validate([
            "gender"=>"required",
            "weight"=>"required",
        ]);

        $input = $request->except('_token');

        Division::whereId($id)->update($input);

        return back()->with("success", "division changed successfully.");
    }

    public function destroyDv(Division $id) {
        $id->delete();
        return "success";
    }
}
