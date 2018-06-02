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
     */
    public function getAllCenters(Request $request)
    {
        $limit = $request->input("limit") ?
            intval($request->input("limit")) : 10;
        $centers = Center::paginate($limit);
       $pagination =[
           "total_count" => $centers->total(),
           "page_size" => $centers->perPage()
       ];
        return response()->json([
            'message' => 'centers fetched successfully',
            'centers' => $centers->items(),
            'pagination' => $pagination
        ], '200');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCenterById($id)
    {
        $center = Center::find(intval($id));
        if ( !$center) {
            return response()->json([
                'error' => 'This center does not exist'
            ], '404');
        }
        return response()->json([
            'message' => 'fetched successfully',
            'center' => $center
        ], '200');

    }
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

    public function editCenter(Request $request)
    {
        $centerId = $request->input("id");
        $center = Center::find(intval($centerId));
        if (!$center) {
            return response()->json([
                'error' => 'Sorry this center does not exist.'
            ], "404");
        }
        if ($request->auth->id !== $center->id) {
            return response()->json([
                'error' => 'You do not have permission to edit this center'
            ], '401');
        }
        $center->update($request->input());

        return response()->json([
            'message' => 'center edited successfully',
            'center' => $center
        ], '200');
    }
}
