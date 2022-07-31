<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Comment;
use App\Models\Offer;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1= new Comment();
        $comment1->date_time =  new DateTime();
        $comment1->textarea = "Lorem";
        $comment1->tutors()->associate( User::all()->first());
        $comment1->students()->associate( User::all()->skip(1)->first());
        $comment1->offers()->associate( Offer::all()->first());
        $comment1->save();
    }
}
