<?php
namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Role;
use Illuminate\Http\Request;

class CentersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCenter(Request $request)
    {
        $this->validate($request, Center::$rules);

        if ($request->auth->role !== Role::ADMIN) {
            return response()->json([
                'error' => 'You are not authorized to perform this action'
            ], 401);
        }
        $response = Center::create(
            [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'capacity' => $request->input('capacity'),
                'owner_id' => $request->auth->id
            ]
        );
        return response()->json([
            'message' => 'Center created successfully',
            'center' => $response
        ], 201);
    }
}
