<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\NewProductAdded;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('shops.create-product');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image',
        ]);
        // image upload
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
        }
        // Create a new product
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image_path' => $imageName,

        ]);

        // Trigger the notification to notify the admin
        $admin = User::find(1);
        $admin->notify(new NewProductAdded($product));

        return redirect()->back()->with('message', 'Product Added Successfully');
    }
}
