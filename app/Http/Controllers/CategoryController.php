<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Carbon\Carbon;




class CategoryController extends Controller
{
    function __construct() {
        $this->middleware('verified');
    }



    function category(){
        return view('backend.category'); 
    }
    
    
           function categoryPost(Request $request)
//    from validation 
   {    
        $request->validate([
           'category_name' => ['required', 'min:2', 'max:15', 'unique:categories']
        ]);
        
//        Category insert to database  
       $cat = new Category;
       $cat->category_name = $request->category_name;
       $cat->save();
       
       return back()->with('success','Category Added Successfully');
      }
      
                  function categoryView()
      {
          $category = Category::orderBy('category_name','asc')->simplepaginate(3);
          return view('backend.view_category', compact('category'));
      }
    
           function categoryDelete($id)
      {
          Category::findOrFail($id)->delete();
          return back()->with('delete','Category Deleted Successfully');
      }
            function categoryEdit($id)
      {
          $category = Category::findOrFail($id);
          
          return view('backend.edit_category', compact('category'));
      }
      
      function categoryUpdate(Request $request)
      {
          $request->validate([
           'category_name' => ['required', 'min:3', 'max:15', 'unique:categories']
        ]);
          
          $id = $request->category_id;
          Category::findOrFail($id)->update([
              'category_name' =>$request->category_name,
              ]);
      
              return redirect('/view-category-list')->with('update','Category Updated Successfully');
      }
}
