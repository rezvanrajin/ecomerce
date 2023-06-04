<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Carbon\Carbon;


class SubCategoryController extends Controller
{
        function __construct() {
        $this->middleware('verified');
    }

    
function SubCategory()
{
    
   $categories =  Category::orderBy('category_name', 'asc')->get();
    return view('backend.subcategory.subcategory', compact('categories'));
}


function SubCategoryPost(Request $request)
{
    SubCategory::insert([
        'subcategory_name' =>$request->subcategory_name,
        'category_id' => $request->category_id,
        'created_at' =>Carbon::now(),
        'updated_at' =>Carbon::now(),
        ]);
               
//       $subcategory = new SubCategory;
//       $subcategory->subcategory_name = $request->subcategory_name;
//       $category->$category_name = $request->category_name;
//       $subcategory->save();
    
    return back()->with('success', 'Sub Category Added Successfully');
}


function SubCategoryView()
{
    $scount = SubCategory::count();
////    Show the category id name to use get_category
////    subcategory->category write the code on subcategory_controller->subcategory model->view page
    $subcategories = SubCategory::with('get_category')->simplepaginate(3);
//   
    return view('backend.subcategory.view_subcategory' , compact('subcategories', 'scount'));
}


function SubCategoryDelete($id)
{
    SubCategory::findOrFail($id)->delete();
    return back();
}


function SubCategoryEdit()
{
    SubCategory::all();
    return view('backend.subcategory');
}


function SubCategoryUpdate()
{
    SubCategory::all();
    return view('backend.subcategory');
}


function SubCategoryDeleted()
{
    $scount = SubCategory::onlyTrashed()->count();
    $subcategories = SubCategory::onlyTrashed()->paginate(3);
    return view('backend.subcategory.deleted_subcategory', compact('subcategories', 'scount'));
}


function SubCategoryRestore($id)
{
 
    SubCategory::withTrashed()->findOrFail($id)->restore();
    return back()->with('delete','Data Restored Successfully');
    }
function SubCategoryPDeleted($id)
{
        SubCategory::withTrashed()->findOrFail($id)->forceDelete();
    return back()->with('delete','Data Deleted Permanently');
    
}

}
