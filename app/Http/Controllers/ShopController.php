<?php

namespace App\Http\Controllers;

use App\Jobs\SendShopAccountCreatedEmail;
use App\Models\Product;
use App\Models\ServiceProvider;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function index()
    {
        return view('shops.create');
    }
    public function login_index()
    {
        return view('shops.loginAsShop');
    }

    public function dashboard_index()
    {
        $products = Product::all();
        return view('shops.shopDashboard', ['products' => $products]);
    }
    // Diplaying list of created shops
    public function display()
    {
        $shops = Shop::all();
        $services = ServiceProvider::all();
        return view('display', ['shops' => $shops], ['services' => $services]);
    }

    public function createShop(Request $request)
    {
        // Validate and store shop information
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:shops',
            'password' => 'required|string|min:4',
        ]);

        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->email = $request->input('email');
        $shop->password = $request->input('password');
        $shop->user_id = auth()->user()->id;

        $shop->save();

        $shopEmail = $shop->email;
        $shopPassword = $request->input('password');

        // Dispatch the notification job when a shop is created
        dispatch(new SendShopAccountCreatedEmail(auth()->user(), $shopEmail, $shopPassword));

        return redirect()->back()->with('message', 'Shop Created Successfully');
    }

    public function login_shop(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the shop by email
        $shop = Shop::where('email', $request->email)->first();

        // Check if the shop exists and the password matches
        if ($shop && $shop->password === $request->password) {
            // Log in the shop
            Auth::login($shop);
            return redirect()->route('shops.dashboard');
        }

        // Authentication failed, return to the login form with an error
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
