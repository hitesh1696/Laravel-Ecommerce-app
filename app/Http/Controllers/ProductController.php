<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $perPage = 12;
        $categories = Category::all();

        //Fetch By Category
        if (request()->category) {
            $productQuery = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            }); 
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } 
        else {
            $productQuery = Product::where('featured', true);
            $categoryName = 'Featured';
        }

        // Fetch By Category + price Low to High / High to Low
        if (request()->sort == 'low_high') {
            $productQuery =  $productQuery->orderBy('price');
        } 
        elseif (request()->sort == 'high_low') {
            $productQuery =  $productQuery->orderByDesc('price');
        } 

        $products = $productQuery->paginate($perPage);
        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    public function show($slug){
        $product = Product::where('slug', $slug)->first();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();
        $stockLevel = getStockLevel($product->quantity);

        return view('product')->with([
            'product' => $product,
            'stockLevel' => $stockLevel,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }
    
    public function search(Request $request)
    {
        $products = Product::where('name', 'like','%'.$request->search.'%')->get();
        // dd($products);
        return view('search-results')->with(['products'=> $products, 'result' => $request->search]);
    }
}
