<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Offer;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = new Course();
        $course1->name = "Webarchitektur";
        $course1->description = "Webarchitekuren und Frameworks";
        $course1->photo = "https://99designs-blog.imgix.net/blog/wp-content/uploads/2018/09/WHAT-IS-WEB-DESIGN.jpg?auto=format&q=60&w=1860&h=1395&fit=crop&crop=faces";
        $course1->save();


        $course2 = new Course();
        $course2->name = "Lernpsychologie";
        $course2->description = "Behaviorismus, Konstruktivismus, Kognitivismus";
        $course2->photo = "https://www.mindful-jugendhilfe.de/tl_files/bilder/jugend.haus/Lernpsychologische%20Lernunterstuetzung.jpg";
        $course2->save();

        $course3 = new Course();
        $course3->name = "Personalentwicklung";
        $course3->description = "HR Development, Personlichkeitsentwicklung";
        $course3->photo = "https://www.landsiedel-seminare.de/wissen/images/personalentwicklung.jpg";
        $course3->save();
    }
}
