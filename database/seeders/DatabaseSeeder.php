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
        // \App\Models\User::factory(10)->create();
     \App\Models\User::factory()->create([
         'email' => 'jacques.trdx@gmail.com',
         'profile_picture' => '',
         'first_name' => 'Jacques',
         'surname' => 'Tredoux',
         'maiden_name' => 'Tredoux',
         'nickname' => 'JQ',
         'gender' => 'male',
         'race' => 'caucasian',
         'marital_status' => 'single',
         'weight' => '200',
         'length' => '185',
         'birth_place' => 'Gauteng',
         'date_of_birth' => '1991-07-28',
         'age' => '31',
         'nationality' => 'ZA',
         'language_spoken' => 'English',
         'religion' => 'Atheist',
         'uid' => '12312312',
     ]);
    \App\Models\User::factory()->create([
        'first_name' => 'Test User',
        'status' => 'Not-Active',
        'email' => 'jacques.trdx@example.com',
    ]);
        DB::table('user_roles')->insert([
            'id' => '1',
            'description' => "verified_user",
        ]);

        DB::table('user_roles')->insert([
            'id' => '2',
            'description' => "system_administrator",
        ]);

        DB::table('user_roles')->insert([
            'id' => '3',
            'description' => "interviewer",
        ]);

        DB::table('user_role_user')->insert([
            'id' => '1',
            'user_role_id' => '1',
            'user_id' => '1',
        ]);
        DB::table('user_role_user')->insert([
            'id' => '2',
            'user_role_id' => '2',
            'user_id' => '1',
        ]);
        DB::table('institutions')->insert([
            'id' => '1',
            'description' => 'First institute',
        ]);
        DB::table('institutions')->insert([
            'id' => '2',
            'description' => 'Second institute',
        ]);
        DB::table('department_user')->insert([
            'id' => '1',
            'department_id' => '1',
            'user_id' => '1',
        ]);
        DB::table('department_user')->insert([
            'id' => '2',
            'department_id' => '2',
            'user_id' => '1',
        ]);
        $genders = array();
        $genders[1] = 'Male';
        $genders[2] = 'Female';
        for ($x = 1; $x <= 30000; $x++) {
            DB::table('people')->insert([
                'id' => $x,
                'profile_picture' => '',
                'first_name' => fake()->name,
                'surname' => fake()->lastName,
                'maiden_name' => fake()->lastName,
                'nickname' => fake()->name,
                'gender' => $genders[rand(1,2)],
                'race' => 'caucasian',
                'marital_status' => 'single',
                'weight' => '200',
                'length' => '185',
                'birth_place' => 'Gauteng',
                'date_of_birth' => fake()->date,
                'age' => '31',
                'nationality' => 'ZA',
                'language_spoken' => 'English',
                'religion' => 'Atheist',
                'uid' => fake()->uuid,
            ]);
        }

        DB::table('institution_people')->insert([
            'id' => '1',
            'person_id' => '1',
            'institution_id' => '1',
        ]);
        DB::table('institution_people')->insert([
            'id' => '2',
            'person_id' => '2',
            'institution_id' => '1',
        ]);
        DB::table('institution_people')->insert([
            'id' => '3',
            'person_id' => '3',
            'institution_id' => '2',
        ]);
        DB::table('institution_people')->insert([
            'id' => '4',
            'person_id' => '2',
            'institution_id' => '2',
        ]);
        DB::table('departments')->insert([
            'id' => '1',
            "institution_id" => '1',
            'description' => 'First Department',
        ]);
        DB::table('departments')->insert([
            'id' => '2',
            "institution_id" => '1',
            'description' => 'Second Department',
        ]);
        DB::table('departments')->insert([
            'id' => '3',
            "institution_id" => '2',
            'description' => 'Third Department',
        ]);
        for ($x = 0; $x <= 30000; $x++) {
            $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $number = $f->format($x);
            $start = new \DateTime('2017-01-01 00:00:00');
            $end = new \DateTime('2022-12-31 23:59:59');
            $random_department  = rand(1,3);
            $randomTimestamp = new \DateTime(date('Y-m-d H:i:s', rand($start->getTimestamp(), $end->getTimestamp())));
            $randomTimestamp->format('Y-m-d H:i:s');
            DB::table('incidents')->insert([
                'description' => 'Testing Incident nr: '.$number,
                'user_id' => '1',
                'department_id' => $random_department,
                'category_id' => '1',
                'sub_category_id' => '1',
                'sub_sub_category_id' => '1',
                'priority_id' => '1',
                'status_id' => rand(1,3),
                'gps_lat' => DatabaseSeeder::generateRandomLat('-28','-24'),
                'gps_lng' => DatabaseSeeder::generateRandomLng('27','30'),
                'source_id' => '1',
                'active' => '1',
                'accepted_at' => $randomTimestamp,
                'allocated_at' => $randomTimestamp,
                'referred_at' => $randomTimestamp,
                'escalated_at' => $randomTimestamp,
                'resolved_at' => $randomTimestamp,
                'closed_at' => $randomTimestamp,
                'created_at' => $randomTimestamp,
                'updated_at' => $randomTimestamp,
                'due_date' => $randomTimestamp,
                'occurred_at' => $randomTimestamp,
                'geoFenceCoords' => '1',
                'case_reference' => '1',
                'client_reference_number' => '1',
                'saps_case_number' => '1',
                'saps_station'  => '1',
                'investigation_officer_id' => '1',
                'unique_id' => '1',
            ]);
            DB::table('incident_people')->insert([
                'person_id' => $x,
                'incident_id' => rand(1,30000),
            ]);
        }





        DB::table('user_permissions')->insert([
            'permission_object' => 'user',
            'permission_action' => 'edit',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'user',
            'permission_action' => 'create',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'user',
            'permission_action' => 'delete',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'user',
            'permission_action' => 'view',
        ]);

        DB::table('user_permissions')->insert([
            'permission_object' => 'department',
            'permission_action' => 'edit',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'department',
            'permission_action' => 'create',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'department',
            'permission_action' => 'delete',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'department',
            'permission_action' => 'view',
        ]);

        DB::table('user_permissions')->insert([
            'permission_object' => 'person',
            'permission_action' => 'edit',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'person',
            'permission_action' => 'create',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'person',
            'permission_action' => 'delete',
        ]);
        DB::table('user_permissions')->insert([
            'permission_object' => 'person',
            'permission_action' => 'view',
        ]);

        for ($x = 1; $x <= 12; $x++) {
            DB::table('user_permission_user')->insert([
                'user_permission_id' => $x,
                'user_id' => '1',
            ]);
        }


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
