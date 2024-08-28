<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\UserSettingRequest;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::get();;
        return response()->json([
            'status' => 'true',
            'code' => 200,
            'data' => $houses,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HouseRequest $request)
    {
        try {
            $house = new House();
            if ($request->hasFile('image')) {
                $file = $request->image;
                $house->image = $file->store('uploads/', 'public');
            }
            // Store the house
            $house->name = $request->name;
            $house->color = $request->color;
            $house->arrange = $request->arrange;
            $house->address = $request->address;
             $house->user_id = auth()->user()->id;
            $house->save();
            return response()->json([
                'object' => $house->withoutRelations(),
                'status' => 'true',
                'message' => __('messages.house_add'),
                'code' => 201,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => __('messages.error_500'),
                'code' => 500,
                'status' => 'false'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $house = House::findOrFail($id);
        return response()->json([
            'status' => 'true',
            'code' => 200,
            'object' => $house,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HouseRequest $request, string $id)
    {
            $house = House::findOrFail($id);

            // Update image if a new image is provided
            if ($request->hasFile('image')) {
                $file = $request->image;
                $newImagePath = $file->store('uploads/', 'public');
                $house->image = $newImagePath;
            }
            // Update other fields
            $house->update($request->except('image')); // Update all other fields except 'image'
            return response()->json([
                'status' => 'true',
                'object' => $house,
                'code' => 200,
                'message' => __('messages.house_update')
            ]);
    }
    public function updateHouseStart(Request $request)
    {
        $user = Auth::user();

        // Update the user's start_house_id
        $user->update([
            'start_house_id' => $request->house_id
        ]);

        // Fetch the associated house
        $house = $user->houses()->find($request->house_id);

        if (!$house) {
            // Handle the case where the associated house is not found
            return response()->json([
                'status' => 'false',
                'code' => 400,
                'message' => __('messages.house_not_found')
            ], 400);
        }

        return response()->json([
            'status' => 'true',
            'code' => 200,
            'object' => $house, // Return the associated house
            'message' => __('messages.update_house_start')
        ]);
    }
    public function updateHouseSetting(UserSettingRequest $request, $id)
    {
        $house = House::findOrFail($id);
        $house_first = House::where('arrange', 1)->firstOrFail();

        // Swap the 'arrange' values between the two houses
        $temp = $house_first->arrange;
        $house_first->update(['arrange' => $house->arrange]);
        $house->update(['arrange' => $temp]);

        return response()->json([
            'status' => 'true',
            'object' => $house,
            'code' => 200,
            'message' => __('messages.user_update_info')
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $house = House::findOrFail($id);
        $house->delete(); // Call the scope method on the list instance
        return response()->json([
            'status' => 'true',
            'code' => 200,
            'message' => __('messages.home_delete')
        ], 200);
    }


}
