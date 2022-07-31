<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Comment;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with(['students', 'tutors', 'offers'])->get();
    }

    public function getById($id){
        return Comment::with(['students', 'tutors', 'offers'])->where('id', $id)->first();
    }

    public function save(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $comment = Comment::create($request->all());
            $comment->save();
            DB::commit();
            return response()->json($comment, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json('saving comment failed ' . $e->getMessage(), 420);
        }
    }


    public function delete(int $id): JsonResponse
    {
        $comment = Comment::where('id', $id)->first();
        if ($comment != null) {
            $comment->delete();
        } else {
            throw Exception('Comment could not be deleted - it doesn\'t exist');
        }
        return response()->json('Comment succesfully deleted', 200);
    }


}
