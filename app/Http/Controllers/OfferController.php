<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index()
    {
        //Offer mit infos zu User und kurs
        return Offer::with(['users', 'courses'])->get();
    }

    public function getById($id){
        return Offer::with(['users', 'courses'] )->where('id', $id)->first();
    }

    public function delete(int $id): JsonResponse
    {
        //offer-Model mit datenbankabfrage
        $offer = Offer::where('id', $id)->first();
        //tatsächliches Löschen aus datenbank
        if ($offer != null) {
            $offer->delete();
        } else {
            throw Exception('Offer could not be deleted - it doesn\'t exist');
        }
        //response wird an frontend zurückgegeben
        return response()->json('Offer succesfully deleted', 200);
    }

    public function save(Request $request): JsonResponse
    {
        /**
         * usa a transaction for saving model including relations
         */
        DB::beginTransaction();
        try {
            $offer = Offer::create($request->all());
            $offer->save();
            if (isset($request['appointments']) && is_array($request['appointments'])) {
                foreach ($request['appointments'] as $appointment) {
                    $newAppointment = Appointment::firstOrNew([
                        'offers_id' => $offer->id,
                        'tutors_id' => $request->users_id,
                        'students_id' => null,
                        'accepted' => false,
                        'date_time' => $appointment['date_time']
                    ]);
                    $newAppointment->save();
                }
            }
            DB::commit();
            return response()->json($offer, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving offer failed ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['users', 'courses' ])->where('id', $id)->first();
            if ($offer != null) {
                $offer->update($request->all());
                $offer->save();
                if (isset($request['appointments']) && is_array($request['appointments'])) {
                    $existingDate = Appointment::with('offer')->where("offers_id", $offer->id)->delete();
                    foreach ($request['appointments'] as $appointment) {
                        $newAppointment = Appointment::firstOrNew([
                            'offers_id' => $offer->id,
                            'tutors_id' => $request->users_id,
                            'students_id' => null,
                            'accepted' => false,
                            'date_time' => $appointment['date_time']
                        ]);
                        $newAppointment->save();
                    }
                }
            }
            DB::commit();
            $offer1 = Offer::with(['users', 'courses'])->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        } catch (Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

}
