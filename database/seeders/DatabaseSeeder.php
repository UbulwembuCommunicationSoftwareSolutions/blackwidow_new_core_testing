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

        DB::table('people')->insert([
            'id' => '1',
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
        DB::table('people')->insert([
            'id' => '2',
            'profile_picture' => '',
            'first_name' => 'Gerrie',
            'surname' => 'Tredoux',
            'maiden_name' => 'Tredoux',
            'nickname' => 'G',
            'gender' => 'male',
            'race' => 'caucasian',
            'marital_status' => 'single',
            'weight' => '200',
            'length' => '185',
            'birth_place' => 'Gauteng',
            'date_of_birth' => '1961-07-28',
            'age' => '61',
            'nationality' => 'ZA',
            'language_spoken' => 'English',
            'religion' => 'Christian',
            'uid' => '12312313',
        ]);
        DB::table('people')->insert([
            'id' => '3',
            'profile_picture' => '',
            'first_name' => 'Kosie',
            'surname' => 'Tredoux',
            'maiden_name' => 'Tredoux',
            'nickname' => 'G',
            'gender' => 'male',
            'race' => 'caucasian',
            'marital_status' => 'single',
            'weight' => '200',
            'length' => '185',
            'birth_place' => 'Gauteng',
            'date_of_birth' => '1961-07-28',
            'age' => '61',
            'nationality' => 'ZA',
            'language_spoken' => 'English',
            'religion' => 'Christian',
            'uid' => '12312315',
        ]);
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
        for ($x = 0; $x <= 10000; $x++) {
            $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $number = $f->format($x);
            DB::table('incidents')->insert([
                'description' => $number.'th Testing Incident',
                'user_id' => '1',
                'department_id' => '1',
                'category_id' => '1',
                'sub_category_id' => '1',
                'sub_sub_category_id' => '1',
                'priority_id' => '1',
                'status_id' => '1',
                'gps_lat' => '1',
                'gps_lng' => '1',
                'source_id' => '1',
                'active' => '1',
                'accepted_at' => '1',
                'allocated_at' => '1',
                'referred_at' => '1',
                'escalated_at' => '1',
                'resolved_at' => '1',
                'closed_at' => '1',
                'created_at' => '1',
                'updated_at' => '1',
                'due_date' => '1',
                'occurred_at' => '1',
                'geoFenceCoords' => '1',
                'case_reference' => '1',
                'client_reference_number' => '1',
                'saps_case_number' => '1',
                'saps_station'  => '1',
                'investigation_officer_id' => '1',
                'unique_id' => '1',
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
}
