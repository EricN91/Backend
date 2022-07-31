<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->name= "Michael Eder";
        $user1->email= "Nachhilfe@gmx.at";
        $user1->password=bcrypt("asdf");
        $user1->photo= "https://www.mindful-jugendhilfe.de/tl_files/bilder/jugend.haus/Lernpsychologische%20Lernunterstuetzung.jpg";
        $user1->role= 0;
        $user1->save();
        //0 = Tutor
        //1 = Student

        $user2 = new User();
        $user2->name= "Eric Nagl";
        $user2->email= "NachhilfeSucher@gmx.at";
        $user2->password=bcrypt("asdf");
        $user2->photo= "https://www.mindful-jugendhilfe.de/tl_files/bilder/jugend.haus/Lernpsychologische%20Lernunterstuetzung.jpg";
        $user2->role= 1;
        $user2->save();
        //0 = Tutor
        //1 = Student
    }
}
