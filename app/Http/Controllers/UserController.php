<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $participant=User->get();
        return $participant;
    }
    public function store(Request $request)
    {
        $participant = new User([
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'role' => $request->input('role'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            ]);
            $participant->save();
            
            return response()->json($participant, 201);
    }
    public function nbreElement(){
        $nbre=User::where('role','user')->count();
        return $nbre;
    }
}
