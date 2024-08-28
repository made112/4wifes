<?php

namespace App\Http\Controllers\API;

use App\Events\ListCreated;
use App\Events\UpdateListEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Models\House;
use App\Models\Lists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $filter = Lists::with('houses')->FilterColumn([
            'code' => $request->code,
            'house_id' => $request->house_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ])->get();

        return response()->json([
            'data' => $filter,
            'status' => 'true',
            'code' => 200,
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */


    public function store(ListRequest $request)
    {
        $list = Lists::create([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'save_status_weakly' => $request->post('save_status_weakly'),
            'code' => $request->post('code'),
            'date' => $request->post('date'),
            'house_id' => $request->post('house_id'),
            'reminder_day' => $request->post('reminder_day'),
            'reminder_hour' => $request->post('reminder_hour'),
            'status' => $request->post('status'),
        ]);
        $message = '';
        switch ($list->code) {
            case 'needs':
                $message = __('messages.list_add_needs');
                break;
            case 'calendar':
                $message = __('messages.list_add_calendar');
                break;
            case 'tasks':
                $message = __('messages.list_add_tasks');
                break;
            case 'wishlist':
                $message = __('messages.list_add_wishlist');
                break;
            default:
                $message = __('messages.list_add_default');
                break;
        }
        event(new ListCreated($list));
        return response()->json([
            'object' => $list,
            'status' => 'true',
            'code' => 201,
            'message' => $message
        ], 201);
    }

    public function show(string $id)
    {
        $list = Lists::findOrFail($id);
        return response()->json([
            'object' => $list,
            'status' => 'true',
            'code' => 200,
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListRequest $request, string $id)
    {
        $list = Lists::findOrFail($id);
        $list->update($request->all()); // Update all other fields except 'image'

        // Additional logic based on code
        switch ($list->code) {
            case 'needs':
                $message = __('messages.list_update_needs');
                break;
            case 'calendar':
                $message = __('messages.list_update_calendar');
                break;
            case 'tasks':
                $message = __('messages.list_update_tasks');
                break;
            case 'wishlist':
                $message = __('messages.list_update_wishlist');
                break;
            default:
                $message = __('messages.list_update_default');
                break;
        }
        event(new UpdateListEvent($list, true));
        return response()->json([
            'object' => $list,
            'status' => 'true',
            'code' => 200,
            'message' => __('messages.list_update')
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $list = Lists::findOrFail($id);
            $list->delete();
            // Call the scope method on the list instance
            return response()->json([
                'status' => 'true',
                'code' => 200,
                'message' => __('messages.list_delete')
            ], 200);

    }

    public function updateStatus($id, Request $request)
    {
        $validator=  Validator::make($request->all(), [
            'status' => ['required', 'in:pending,completed'],
        ], [
            'status.required' => 'يجب ادخال الحالة',
            'status.in' => 'يجب ادخال حالة مدرجة',
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json([
                'message' => $firstError,
                'status' => 'false',
                'code' => 400, // 422 Unprocessable Entity status code
            ],400);
        }
        $list = Lists::findOrFail($id);
        $list->update([
            'status' => $request->status
        ]);
        return response()->json([
            'object' => $list,
            'status' => 'true',
            'code' => 200,
            'message' => __('messages.list_update_status')
        ], 200);
    }
    public function getUpcomingReminders (Request $request)
    {
        $reminders  = Lists::where('house_id',$request->house_id)->OrderBy('date','asc')->get();
        $reminders->transform(function ($reminder) {
            $codeMapping = [
                'wishlist' => 'الامنيات',
                'tasks' => 'المهام',
                'needs' => 'المقاضي',
                'calendar' => 'التقويم',
                // Add more mappings as needed
            ];
            // Check if the code exists in the mapping, and update it if found
            if (isset($codeMapping[$reminder->code])) {
                $reminder->code = $codeMapping[$reminder->code];
            }
            return $reminder;
        });
        return response()->json([
            'data' => $reminders,
            'status' => 'true',
            'code' => 200,
        ], 200);
    }

    public function getEventsByArrange(Request $request)
    {
        $user = auth()->user();
        $dateFrom = $request->input('date_from');
        $end_date = $request->input('date_to');

        $carbonStartDate = Carbon::parse($dateFrom);
        $carbonEndDate = Carbon::parse($end_date);
        $houses = House::with('lists')->orderBy('arrange', 'asc')->get();
        $divisor = $user->divisor_type === 'daily' ? 1 : ($user->divisor_type === 'two_day' ? 2 : 7);
        $houseIndex = 0;
        $response = [];
        $dayCounter = 0; // Initialize a day counter

        while ($carbonStartDate <= $carbonEndDate) {
            $house = $houses[$houseIndex];
            $date = $carbonStartDate->format('Y-m-d');
            $lists = $house->lists()->where('date', $date)->get(); // Retrieve lists for the current date

            $response[] = [
                'house' => $house,
                'date' => $date,
                'lists' => $lists, // Include the lists for this date

            ];

            $carbonStartDate->addDay(); // Increase the date by 1 day
            $dayCounter++;

            if ($dayCounter % $divisor === 0) {
                // Move to the next house if the day counter is a multiple of the divisor
                $houseIndex = ($houseIndex + 1) % count($houses);
            }
        }

        return response()->json([
            'data' => $response,
            'status' => 'true',
            'code' => 200,
        ], 200);
    }


}
