<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Shop;
use Illuminate\Http\Request;

class PublicApiController extends Controller
{
    function getAllData() {
        $data = [
            'List of Shops' => Shop::all(),
            'List of Products' => Product::all(), 
            'List of Service Providers' => ServiceProvider::all(),
            'List of Services' => Service::all()
        ];
        return response()->json($data);
    }

    
}
