<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductGallery;
use Carbon\Carbon;
use Image;


class ProductController extends Controller {

        public function __construct()
    {
        $this->middleware('verified');
    }
    public function product() {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategory = SubCategory::orderBy('subcategory_name', 'asc')->get();
        return view('backend.product.product', ['categories' => $categories, 'subcategory' => $subcategory]);
    }

    public function productPost(Request $request) {
        $slug = strtolower(str_replace(' ', '-', $request->product_name));
        $slug_check = Product::where('slug', $slug)->count();

        if ($slug_check > 0) {
            $slug = $slug . '-' . time();
        }

        if ($request->hasFile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $ext = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 622)->save(public_path('/img/thumbnail/' . $ext));

            $product_id = Product::insertGetId([
                        'category_id' => $request->category_id,
                        'subcategory_id' => $request->subcategory_id,
                        'product_name' => $request->product_name,
                        'slug' => $slug,
                        'product_summary' => $request->product_summary,
                        'product_description' => $request->product_description,
                        'product_price' => $request->product_price,
                        'product_quantity' => $request->product_quantity,
                        'product_thumbnail' => $ext,
                        'created_at' => Carbon::now(),
                
            ]);
                        if ($request->hasFile('product_gallery')) {
                $img = $request->file('product_gallery');
                foreach ($img as $key => $item) {
                    $ext2 = time(). $key . '.' . $item->getClientOriginalExtension();
                    Image::make($item)->resize(600, 622)->save(public_path('/img/gallery/' . $ext2));
                    
                    ProductGallery::insert([
                        'product_id' => $product_id,
                        'product_gallery' => $ext2,
                    'created_at' => Carbon::now()
                    ]);
                }
            };
        } else {
            $product_id = Product::insertGetId([
                        'category_id' => $request->category_id,
                        'subcategory_id' => $request->subcategory_id,
                        'product_name' => $request->product_name,
                        'slug' => $slug,
                        'product_summary' => $request->product_summary,
                        'product_description' => $request->product_description,
                        'product_price' => $request->product_price,
                        'product_quantity' => $request->product_quantity,
                        'created_at' => Carbon::now(),
            ]);

            if ($request->hasFile('product_gallery')) {
                $img = $request->file('product_gallery');
                foreach ($img as $items) {
                    $ext3 = time() . '.' . $items->getClientOriginalExtension();
                    Image::make($items)->resize(600, 622)->save(public_path('/img/gallery/'. $ext3));
                                        ProductGallery::insert([
                        'product_id' => $product_id,
                                            'product_gallery' => $ext3,
                    'created_at' => Carbon::now()
                    ]);
                }
            };
        }
        return back()->with('success','Product Added Successfully');
    }

    function productView() {
        $products = Product::simplepaginate(5);
        return view('backend.product.view_product', compact('products'));
    }

    function productEdit($pro_id) {

        $categories = Category::all();
        $subcategory = SubCategory::all();
        $product = Product::findOrFail($pro_id);
        session(['pro_id' => $pro_id]);
        return view('backend.product.edit_product', compact('product', 'categories', 'subcategory'));
    }

        function productUpdate(Request $request) {

        $id = $request->session()->get('pro_id');

        $old_product = Product::findOrFail($id);
        $slug = $old_product->slug;
        $old_img = $old_product->product_thumbnail;

        if ($request->hasFile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $ext = $slug . '.' . $image->getClientOriginalExtension();
            if (file_exists( $old_img)) {
                unlink( $old_img);
            }
            Image::make($image)->resize(600, 622)->save(public_path('/img/thumbnail/' . $ext));

            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_thumbnail' => $ext,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect('/view-product-list');
    }


    function productDelete($id) {

        Product::findOrFail($id)->delete();
        return back();
    }

}
