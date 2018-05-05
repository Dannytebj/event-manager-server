<?php
namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public static function jwt(User $user)
    {
        $payload = [
            'iss' => "event-manager",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 3600*60
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * @param User $user
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $this->request->input('email'))->first();
        if( !$user) {
            return response()->json([
                'error' => 'Email does not exist'
            ], 404);
        }
        if (Hash::check($this->request->input('password'), $user->password)) {
            $userDetails = (object) [
                'name' => $user->name,
                'email' => $user->email
            ];
            return response()->json([
                'message' => 'Login successful',
                'token' => $this->jwt($user),
                'user' => $userDetails
            ], 200);
        }
        return response()->json([
            'error' => 'Email or password is wrong'
        ], 400);
    }
}