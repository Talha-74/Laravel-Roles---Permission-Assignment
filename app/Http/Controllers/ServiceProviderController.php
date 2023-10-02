<?php

namespace App\Http\Controllers;

use App\Jobs\SendServiceProviderAccountCreatedEmail;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    public function index()
    {
        return view('serviceProviders.create');
    }
    public function login_index()
    {
        return view('serviceProviders.loginAsServiceProvider');
    }
public function dashboard_index(){
    $services = Service::all();
    return view('serviceProviders.serviceProvidersDashboard', ['services' => $services]);
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:serviceProviders',
            'password' => 'required|string|min:4',
        ]);

        $data = new ServiceProvider();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = $request->input('password');
        $data->user_id = auth()->user()->id;
        // dd($data);
        $data->save();

        $serviceProviderEmail = $data->email;
        $serviceProviderPassword = $request->input('password');


        dispatch(new SendServiceProviderAccountCreatedEmail(auth()->user(), $serviceProviderEmail, $serviceProviderPassword));

        return redirect()->back()->with('message', 'Service Provider Created Successfully');

    }

    public function login_serviceProvider(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Find the shop by email
        $serviceProvider = ServiceProvider::where('email', $request->email)->first();
    
        // Check if the shop exists and the password matches
        if ($serviceProvider && $serviceProvider->password === $request->password) {
            // Log in the shop
            Auth::login($serviceProvider);
            return redirect()->route('serviceProviders.dashboard');
        }
    
        // Authentication failed, return to the login form with an error
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
