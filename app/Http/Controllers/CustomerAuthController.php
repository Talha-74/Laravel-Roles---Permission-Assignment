<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
  function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'string|required',
      'email' => 'required|email',
      'password' => 'required|string|min:4',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);

    $user->assignRole('customer');

    return response()->json(['message' => 'Registration successful']);
  }
  public function login(Request $request)
  {

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      $token = $user->createToken('my_token')->accessToken;
      return response()->json(['token' => $token]);
    }

return response()->json(['error' =>'UnAuthorized'], 401);
  }
}
