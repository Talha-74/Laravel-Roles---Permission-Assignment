<?php

namespace App\Http\Controllers;

use App\Models\BookService;
use Illuminate\Http\Request;

class BookServiceController extends Controller
{
    public function bookService(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required|string',
            'service_description' => 'required|string'
        ]);

        $bookservice = BookService::create([
            'user_id' => Auth()->user()->id,
            'service_name' => $validatedData['service_name'],
            'service_description' => $validatedData['service_description'],
        ]);
        return response()->json(['message' => 'Service created successfully', 'bookservice' => $bookservice]);
    }

    public function getServiceHistory()
    {
        $servicesBookingHistory = BookService::where('user_id', auth()->user()->id)->get();
        return response()->json(['Services Booked List' => $servicesBookingHistory]);
    }

    public function getServiceDetails($id)
    {
        $service = BookService::where('user_id', auth()->user()->id)->find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        return response()->json(['Service By ID'=>$service], 200);
    }
}
