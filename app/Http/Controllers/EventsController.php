<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Models\Center;
use App\Models\Events;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllEvents()
    {
        $events = Events::with('center', 'user')->get();
        return response()->json([
            'message' => 'events fetched successfully',
            'events' => $events
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCenterEvents($id)
    {
        $events = Events::where('center_id', $id)->get();
        if (!$events) {
            return response()->json([
                'error' => 'No events for that center'
            ], 422);
        }
        return response()->json([
            'message' => 'events fetched successfully',
            'events' => $events
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createEvent(Request $request)
    {
        $this->validate($request, Events::$rules);
        $centerId = $request->input('center_id');
        $center = Center::where('id', $centerId )->first();

        if (!$center) {
            return response()->json([
                'error' => 'the center id provided was not found'
            ], 404);
        }

        $eventDetails = Events::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'center_id' => $centerId,
                'date' => Carbon::now(), // will update this later
                'user_id' => $request->auth->id
            ]
        );
        return response()->json([
            'message' => 'event successfully created',
            'event' => $eventDetails
        ], 201);

    }

}