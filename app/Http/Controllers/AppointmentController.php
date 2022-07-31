<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['students', 'tutors', 'offers'])->get();
    }

    public function getById($id){
        return Appointment::with(['students', 'tutors', 'offers'])->where('id', $id)->first();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::with(['students', 'tutors', 'offers'])->where('id', $id)->first();
            if ($appointment != null) {
                $appointment->update($request->all());
                $appointment->save();
            }
            DB::commit();
            $appointment1 = Appointment::with(['students', 'tutors', 'offers'])->where('id', $id)->first();
            // return a vaild http response
            return response()->json($appointment1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating appointment failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $appointment = Appointment::where('id', $id)->first();
        if ($appointment != null) {
            $appointment->delete();
        } else {
            throw Exception('Appointment could not be deleted - it doesn\'t exist');
        }
        return response()->json('Appointment succesfully deleted', 200);
    }

    public function getByOffer($id){
        return Appointment::with(['students', 'tutors', 'offers'])->where('offers_id', $id)->get();
    }

}
