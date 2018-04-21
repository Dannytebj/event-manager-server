<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, User::$rules);
        $userEmail = $request->input('email');
        $userExist = User::where('email', $userEmail)->first();

        if($userExist) {
            return response()->json([
                'error' => 'This user already exist'
            ], 409);
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone_number' => $request->input('phoneNumber')
        ]);
        $token = AuthController::jwt($user);
        $newUser = (object)[
            'name' => $user->name,
            'email' => $user->email
        ];

        return response()->json([
            'message' => 'User successfully created',
            'token' => $token,
            'user' => $newUser
        ], 201);
    }
}