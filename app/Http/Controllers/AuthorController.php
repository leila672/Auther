<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;







class AuthorController extends Controller
{

    public function register(Request $request)
    {
        $rules=[

            'first_name' => 'required|max: 255',
            'last_name' => 'required|max: 255',
            'email' => 'required|email|unique:authors,email',
            'password' => 'required|min:6|max:20',
        ];

        $validator =Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors());
        }


        $author = Author::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        $authToken = $author->createToken('auth-token')->plainTextToken;

        return response()->json([
            'author_token' => $authToken,
        ]);

    }

    public function login(Request $request){
        if(!Auth::guard('author')->attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'success' => false,
                'status' => 200
            ]);
        }

        $user = Auth::guard('author')->user();

        $token = $user->createToken('user');

        return response()->json([
            'author_token' => $token->plainTextToken,
        ]);
    }


}
