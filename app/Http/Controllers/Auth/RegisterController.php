<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:4'
    ]);

    $user = User::create([
        'name' => $request->name,
        'lastName' => $request->lastName,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'User Created Successfully',
        'token' => $token,
        'user_id' => $user->id
    ], 200);
}

}