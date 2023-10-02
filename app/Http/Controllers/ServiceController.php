<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Notifications\NewServiceAdded;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create()
    {
        return view('serviceProviders.create-service');
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
        $service = Service::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image_path' => $imageName,

        ]);
        $admin = User::find(1);

        $admin->notify(new NewServiceAdded($service));
        return redirect()->back()->with('message', 'Service Added Successfully');
    }
}
