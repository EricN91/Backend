<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Course;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer1 = new Offer();
        $offer1->users()->associate(User::all()->first());
        //$offer1->courses()->associate(Course::all()->first());
        $course1 = Course::all()->first();
        $offer1->courses()->associate($course1);
        $offer1->name = "Nachhilfe Webarchitektur";
        $offer1->description = "Nachhilfe Webarchitektur von Michael";
        $offer1->photo = "https://www.mindful-jugendhilfe.de/tl_files/bilder/jugend.haus/Lernpsychologische%20Lernunterstuetzung.jpg";
        $offer1->save();
    }
}
