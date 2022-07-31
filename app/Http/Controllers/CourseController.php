<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        //Tabelle zurückgegeben
        return DB::table('courses')->get();
    }

    public function getById($id)
    {
        return DB::table('courses')->where('id',$id)->first();
    }

    public function delete(int $id): JsonResponse
    {
        $course = Course::where('id', $id)->first();
        if ($course != null) {
            $course->delete();
        } else {
            throw Exception('Course could not be deleted - it doesn\'t exist');
        }
        return response()->json('Course succesfully deleted', 200);
    }
}
