<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        return DB::table('users')->get();
    }

    public function getById($id)
    {
        $user = User::where('id', $id)->first();
        return $user != null ? response()->json($user, 200) : response()->json(null, 200);
    }

    public function delete(int $id): JsonResponse
    {
        $user = User::where('id', $id)->first();
        if ($user != null) {
            $user->delete();
        } else {
            throw Exception('User could not be deleted - it doesn\'t exist');
        }
        return response()->json('User succesfully deleted', 200);
    }
}
