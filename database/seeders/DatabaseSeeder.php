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
            'description' => 'First One',
        ]);
        DB::table('institutions')->insert([
            'id' => '2',
            'description' => 'Second One',
        ]);
        DB::table('institution_user')->insert([
            'id' => '1',
            'institution_id' => '1',
            'user_id' => '1',
        ]);
        DB::table('user_permissions')->insert([
            'id' => '1',
            'permission_object' => 'user',
            'permission_action' => 'edit',
        ]);
        DB::table('user_permissions')->insert([
            'id' => '2',
            'permission_object' => 'user',
            'permission_action' => 'create',
        ]);
        DB::table('user_permission_user')->insert([
            'id' => '1',
            'user_permission_id' => '1',
            'user_id' => '1',
        ]);
        DB::table('user_permission_user')->insert([
            'id' => '2',
            'user_permission_id' => '2',
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


    }
}
