<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->paginate(6);
        $categories = Category::all();
        return view('admin.dashboard.Products',compact('products','categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|numeric|min:0',
            'product_category' => 'required|string|max:255',
            'product_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Create a new Product instance
        $product = new Product();
        $product->name = $validatedData['product_name'];
        $product->description = $validatedData['product_description'];
        $product->price = $validatedData['product_price'];
        $product->stock_quantity = $validatedData['product_stock'];
    
        $category = Category::where('name', $request->product_category)->first();
        $product->category_id = $category->id;

        if ($request->hasFile('product_picture')) {

            $image = $request->file('product_picture');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/'), $imageName);
            $product->picture_path = 'images/'.$imageName;
        }

        $product->save();

        return redirect()->back()->with('success', "Your new product was added successfully");
    }

    public function edit($id){

        $product = Product::with('category')->find($id);
        $categories = Category::all();
        return view('admin.dashboard.update_product',compact('product','categories'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric|min:0',
            'productDescription' => 'required|string',
            'productStock' => 'required|integer|min:0',
            'productCategory' => 'required|string|max:255',
            'productPicture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->productName;
        $product->description = $request->productDescription;
        $product->price = $request->productPrice;
        $product->stock_quantity = $request->productStock;
    
        $category = Category::where('name', $request->productCategory)->first();
        if ($category) {
            $product->category_id = $category->id;
        } else {
            return redirect()->back()->withErrors(['category' => 'The selected category does not exist.']);
        }
    

        if ($request->hasFile('productPicture')) {
            $oldPicturePath = public_path($product->picture_path);
            if (File::exists($oldPicturePath)) {
                File::delete($oldPicturePath);
            }
        }


        if ($request->hasFile('productPicture')) {

            $image = $request->file('productPicture');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/'), $imageName);
            $product->picture_path = 'images/'.$imageName;

            $product->save();
            return redirect()->back()->with('success', "Your product was updated successfully");
        }
        return redirect()->back()->withErrors('error', "Your product was not updated");
    }

    public function destroy(Product $product){
        Product::destroy($product->id);
        return redirect()->back();
    }
}
