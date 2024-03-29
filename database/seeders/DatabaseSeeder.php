<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'id' => '1',
            'name' => 'First institute',
        ]);
        DB::table('institutions')->insert([
            'id' => '2',
            'name' => 'Second institute',
        ]);
        DB::table('institutions')->insert([
            'id' => '3',
            'name' => 'Third institute',
        ]);
//        DB::table('department_user')->insert([
//            'department_id' => '1',
//            'user_id' => '1',
//        ]);
//        DB::table('department_user')->insert([
//            'department_id' => '2',
//            'user_id' => '1',
//        ]);
//        DB::table('department_user')->insert([
//            'department_id' => '3',
//            'user_id' => '1',
//        ]);
//        DB::table('department_user')->insert([
//            'department_id' => '4',
//            'user_id' => '1',
//        ]);
//        DB::table('department_user')->insert([
//            'department_id' => '5',
//            'user_id' => '1',
//        ]);
//        $genders = array();
//        $genders[1] = 'Male';
//        $genders[2] = 'Female';
//        for ($x = 1; $x <= 60000; $x++) {
//            $start = new \DateTime('2017-01-01 00:00:00');
//            $end = new \DateTime('2022-12-31 23:59:59');
//            $randomTimestamp = new \DateTime(date('Y-m-d H:i:s', rand($start->getTimestamp(), $end->getTimestamp())));
//            $randomTimestamp->format('Y-m-d H:i:s');
//            DB::table('people')->insert([
//                'id' => $x,
//                'profile_picture' => '',
//                'first_name' => fake()->name,
//                'surname' => fake()->lastName,
//                'maiden_name' => fake()->lastName,
//                'nickname' => fake()->name,
//                'gender' => $genders[rand(1,2)],
//                'race' => 'caucasian',
//                'marital_status' => 'single',
//                'weight' => '200',
//                'length' => '185',
//                'birth_place' => 'Gauteng',
//                'date_of_birth' => fake()->date,
//                'age' => '31',
//                'nationality' => 'ZA',
//                'language_spoken' => 'English',
//                'religion' => 'Atheist',
//                'uid' => fake()->uuid,
//                'created_at' => $randomTimestamp
//            ]);
//            DB::table('incident_people')->insert([
//                'person_id' => $x,
//                'incident_id' => rand(1,60000),
//            ]);
//            DB::table('institution_people')->insert([
//                'person_id' => $x,
//                'institution_id' => rand(1,3),
//            ]);
//        }


//        DB::table('departments')->insert([
//            "institution_id" => '1',
//            'name' => 'First Department',
//        ]);
//        DB::table('departments')->insert([
//            "institution_id" => '1',
//            'name' => 'Second Department',
//        ]);
//        DB::table('departments')->insert([
//            "institution_id" => '2',
//            'name' => 'Third Department',
//        ]);
//        DB::table('departments')->insert([
//            "institution_id" => '2',
//            'name' => 'Forth Department',
//        ]);
//        DB::table('departments')->insert([
//            "institution_id" => '2',
//            'name' => 'Fifth Department',
//        ]);
//        for ($x = 1; $x <= 60000; $x++) {
//            $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
//            $number = $f->format($x);
//            $start = new \DateTime('2017-01-01 00:00:00');
//            $end = new \DateTime('2022-12-31 23:59:59');
//            $random_department  = rand(1,5);
//            $randomTimestamp = new \DateTime(date('Y-m-d H:i:s', rand($start->getTimestamp(), $end->getTimestamp())));
//            $randomTimestamp->format('Y-m-d H:i:s');
//            DB::table('incidents')->insert([
//                'name' => 'Testing Incident nr: '.$number,
//                'user_id' => '1',
//                'department_id' => $random_department,
//                'category_id' => '1',
//                'sub_category_id' => '1',
//                'sub_sub_category_id' => '1',
//                'priority_id' => '1',
//                'status_id' => rand(1,3),
//                'gps_lat' => DatabaseSeeder::generateRandomLat('-34','-22'),
//                'gps_lng' => DatabaseSeeder::generateRandomLng('19','30'),
//                'source_id' => '1',
//                'active' => '1',
//                'accepted_at' => $randomTimestamp,
//                'allocated_at' => $randomTimestamp,
//                'referred_at' => $randomTimestamp,
//                'escalated_at' => $randomTimestamp,
//                'resolved_at' => $randomTimestamp,
//                'closed_at' => $randomTimestamp,
//                'created_at' => $randomTimestamp,
//                'updated_at' => $randomTimestamp,
//                'due_date' => $randomTimestamp,
//                'occurred_at' => $randomTimestamp,
//                'geoFenceCoords' => '1',
//                'case_reference' => '1',
//                'client_reference_number' => '1',
//                'saps_case_number' => '1',
//                'saps_station'  => '1',
//                'investigation_officer_id' => '1',
//                'unique_id' => '1',
//            ]);
//        }



    }

     public static function generateRandomLat($latitudeMin, $latitudeMax) {
        $latitude = mt_rand($latitudeMin * 1000000, $latitudeMax * 1000000) / 1000000;
        return $latitude;
    }
    public static function generateRandomLng($longitudeMin, $longitudeMax)
    {
        $longitude = mt_rand($longitudeMin * 1000000, $longitudeMax * 1000000) / 1000000;
        return $longitude;
    }

}
