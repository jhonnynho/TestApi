<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function createUser(Request $request) {
        $user_logged = $this->jwt->user();
        if($user_logged->role->role==="Administrator"){
            $user = new User;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($request->has('role'))
            {
                $user->role_id = ($request->role === "Administrator") ? 1 : ($request->role === "Employee" ? 2 : 2);
            }
            else{
                $user->role_id = 2;
            }
            $user->save();
            return response ()->json ( "Usuario Registrado" , 200 );
        }
        else{
            return response ()->json ( "Necesita ser Administrador" , 401 );
        } 
    }

    public function getMyUserInfo(Request $request) {
        $user = $this->jwt->user();
        $res = User::with('role','task')->where('id','=',$user->id)->get();
        return response()->json($res);
    }

    public function getAllUser(Request $request) {
        $user = User::with('role')->get();
        return response()->json($user);
    }

    public function getUserInfo($email) {
        $user = User::where('email','=',$email)->get();
        return response()->json($user);
    }

    public function updateUser(Request $request) {
        $user = $this->jwt->user();
        if ($request->has('firstname')){
            $firstname = $request->firstname;
        }
        else{
            $firstname = $user->firstname;
        }
        if ($request->has('lastname')){
            $lastname = $request->lastname;
        }
        else{
            $lastname = $user->lastname;
        }
        if (!$request->has('firstname') && !$request->has('lastname')){
            return response ()->json ( "No se ha recibido datos a actualizar" , 401 );
        }
        User::where('email', '=', $user->email)
        ->update(['firstname' => $firstname , 'lastname' => $lastname]);
        return response ()->json ( "Updated" , 200 );
    }

    public function manageRoles(Request $request){
        $user_logged = $this->jwt->user();
        if($user_logged->role->role==="Administrator"){
            if ($request->has('email') && $request->has('role')){
                $email = $request->email;
                $role_id = ($request->role === "Administrator") ? 1 : ($request->role === "Employee" ? 2 : 2);
            }
            else{
                return response ()->json ( "No se ha recibido datos a actualizar" , 401 );
            }

            User::where('email', '=', $email)
            ->update(['role_id' => $role_id]);
            return response ()->json ( "Updated" , 200 );
        }
        else{
            return response ()->json ( "Necesita ser Administrador" , 401 );
        } 
    }

}