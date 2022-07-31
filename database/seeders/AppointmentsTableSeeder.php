<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Course;
use App\Models\Offer;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $appointment1= new Appointment();
       $appointment1->date_time =  new DateTime();
       $appointment1->tutors()->associate( User::all()->skip(1)->first());
       $appointment1->offers()->associate( Offer::all()->first());
       $appointment1->save();

    }
}
