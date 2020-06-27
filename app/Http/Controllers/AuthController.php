<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class AuthController extends BaseController
{
    // Api routes with jwt
    // public function register(Request $request){

    //     $validator  = Validator::make($request->all(),[
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'name' => 'required',
    //         'password' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors());
    //     }

    //     User::create([
    //         'name' => $request->get('name'),
    //         'email' => $request->get('email'),
    //         'password' => bcrypt($request->get('password'))
    //     ]);

    //     $user = User::first();
    //     $token = JWTAuth::fromUser($user);

    //     return Response::json(compact('token'));
    // }

    // public function login(Request $request) {
    //     $validator  = Validator::make($request->all(),[
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors());
    //     }

    //     $credentials = $request->only('email', 'password');

    //     try {
    //         if(!$token=JWTAuth::attempt($credentials)){
    //             return response()->json(['error'=>'Invalid Credntials'], [401]);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['error'=>'No token'], [500]);
    //     }
    //     return response()->json(compact('token'));
    // }

    // Api routes with passport
    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if($validator->fails()){
            return $this->sendError('error in validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'Register with success');
    }

    public function login()
    {

    }
}
