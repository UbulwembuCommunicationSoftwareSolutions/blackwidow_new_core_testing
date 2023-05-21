<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importer extends Model
{

    public static function Import($url){

        $token = Importer::Login($url);
        $case_activities = Importer::getCaseActivities($url,$token);
        Self::processCaseActivites($case_activities);
        $departments = Importer::getDepartments($url,$token);
        $users = Importer::getUsers($url,$token);
        $cases = Importer::getCases($url,$token);
        $categories = Importer::getCategories($url,$token);
        $sub_categories = Importer::getSubCategories($url,$token);
        $sub_sub_categories = Importer::getSubSubCategories($url,$token);
        $people = Importer::getPeople($url,$token);
        $people_contacts = Importer::getPeopleContacts($url,$token);
        $people_cases = Importer::getPeopleCases($url,$token);
        $case_notes = Importer::getCaseNotes($url,$token);
        Self::processCaseNotes($case_notes);
        Self::processPeopleCases($people_cases);
        Self::processPeople($people);
        Self::processCases($cases);
        Self::processSubSubCategories($sub_sub_categories);
        Self::processSubCategories($sub_categories);
        Self::processCategories($categories);
        Self::processDepartments($departments);
        Self::processUsers($users);
    }

    public static function processCaseActivites($case_activies){
        foreach ($case_activies as $case_activy){
            $incident_activity = new IncidentActivity([
                'id' => $case_activy->id,
                'note' => $case_activy->note,
                'user_id' => $case_activy->user,
                'incident_id' => $case_activy->case_id,
                'to_user_id' => $case_activy->to,
                'from_user_id' => $case_activy->from,
                'message' => $case_activy->message,
                'description' => $case_activy->description,
                'created_at' => $case_activy->created_at,
                'updated_at' => $case_activy->updated_at,
                'incident_category_id' => $case_activy->category,
                'incident_sub_category_id' => $case_activy->sub_category,
            ]);
            $incident_activity->save();
        }
    }
    public static function processCaseNotes($case_notes){
        foreach($case_notes as $import_note){
            $incident_note = new IncidentNote([
                'id' => $import_note->id,
                'incident_id' => $import_note->case_id,
                'created_at' => $import_note->created_at,
                'updated_at' => $import_note->updated_at,
                'user_id' => $import_note->user,
                'note' => $import_note->note,
            ]);
            $incident_note->save();
        }
    }

    public static function processPeopleCases($people_cases){
        foreach($people_cases as $person_case){
            \DB::table('incident_people')->insert([
                'incident_id' => $person_case->case_id,
                'person_id' => $person_case->poi_id
            ]);
        }
    }
    public static function processPeople($people){
        foreach($people as $import_person){
            $person = new Person();
            $person->id = $import_person->id;
            $person->profile_picture= null;
            $person->first_name= $import_person->name;
            $person->surname= $import_person->surname ;
            $person->id_number= $import_person->id_number ;
            $person->nickname= $import_person->nickname ;
            $person->gender_id= $import_person->gender ;
            $person->ethnic_group_id= $import_person->ethnic_group_id ;
            $person->marital_status_id= $import_person->marital_status_id ;
            $person->weight= $import_person->weight ;
            $person->height= $import_person->height ;
            $person->birth_place= $import_person->birth_place ;
            $person->date_of_birth= $import_person->date_of_birth ;
            $person->home_address = $import_person->address_home;
            $person->work_address = $import_person->address_work;
            $person->active = $import_person->active;
            $person->nationality_id= $import_person->nationality ;
            $person->language_spoken= $import_person->language ;
            $person->religion_id = $import_person->religion ;
            $person->updated_at = $import_person->updated_at;
            $person->created_at = $import_person->created_at;
            $person->uid= Self::generate_uuid() ;
            $person->save();
        }
    }
    public static function processDepartments($departments){
        foreach($departments as $import_department){
            $department = new Department();
            $department->id = $import_department->id;
            $department->name = $import_department->name;
            $department->institution_id = $import_department->company;
            $department->save();
        }
    }
    public static function processUsers($users){
        foreach($users as $import_user){
            $user = new User();
            $user->id = $import_user->id;
            $user->email = $import_user->email;
            $user->cellphone = $import_user->cellphone;
            $user->password = $import_user->password;
            $user->profile_picture = null;
            $user->first_name = $import_user->name;
            $user->surname = $import_user->surname;
            $user->nickname = $import_user->name;
            $user->gender_id = $import_user->gender;
            $user->language_id = $import_user->language;
            $user->date_of_birth =$import_user->dob;
            $user->uid = self::generate_uuid();
            $user->save();

        }
    }

    public static function generate_uuid() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        }
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }

    public static function processCases($cases){
        foreach($cases as $import_case){
            $incident = new Incident();
            $incident->id = $import_case->id ;
            $incident->description = $import_case->description;
            $incident->user_id = $import_case->user;
            $incident->department_id = $import_case->department;
            $incident->incident_category_id = $import_case->case_type;
            $incident->incident_sub_category_id = $import_case->case_sub_type;
            $incident->incident_sub_sub_category_id = $import_case->case_sub_sub_type;
            $incident->priority_id = $import_case->priority;
            $incident->incident_status_id = $import_case->status;
            $incident->gps_lat = $import_case->gps_lat;
            $incident->gps_lng = $import_case->gps_lng;
            $incident->source_id = $import_case->source;
            $incident->active = $import_case->active;
            $incident->accepted_at = $import_case->accepted_at;
            $incident->allocated_at = $import_case->allocated_at;
            $incident->referred_at = $import_case->referred_at;
            $incident->escalated_at = $import_case->escalated_at;
            $incident->resolved_at = $import_case->resolved_at;
            $incident->closed_at = $import_case->closed_at;
            $incident->created_at = $import_case->created_at;
            $incident->updated_at = $import_case->updated_at;
            $incident->due_date = $import_case->due_date;
            $incident->occurred_at = $import_case->occured_at;
            $incident->geoFenceCoords = $import_case->geoFenceCoords;
            $incident->case_reference = $import_case->case_reference;
            $incident->client_reference_number = $import_case->client_reference_number;
            $incident->saps_case_number = $import_case->saps_case_number;
            $incident->saps_station = $import_case->saps_station;
            $incident->investigation_officer_id = $import_case->investigation_officer;
            $incident->unique_id = self::generate_uuid();
            $incident->save();

        }
    }

    public static function processCategories($categories){
        foreach($categories as $category){
            $incident_category = new IncidentCategory();
            $incident_category->id = $category->id;
            $incident_category->name = $category->name ;
            $incident_category->department_id = $category->department;
            $incident_category->save();
        }
    }

    public static function processSubCategories($sub_categories){
        foreach($sub_categories as $category){
            $incident_category = new IncidentSubCategory();
            $incident_category->id = $category->id;
            $incident_category->name = $category->name ;
            $incident_category->incident_category_id = $category->case_type;
            $incident_category->save();
        }
    }

    public static function processSubSubCategories($sub_sub_categories){
        foreach($sub_sub_categories as $category){
            $incident_category = new IncidentSubSubCategory();
            $incident_category->id = $category->id;
            $incident_category->name = $category->name ;
            $incident_category->incident_sub_category_id = $category->sub_category;
            $incident_category->save();
        }
    }


    public static function Login($url){
        echo "Loggin into $url \n";
        $curl = curl_init();
        $url .= '/api/authorize';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => 'richard@mshtarii.com','password' => 'ittxle4K00m'),
        ));

        $response = curl_exec($curl);
        var_dump($response);
        curl_close($curl);

        $new_response = json_decode($response);
        return $new_response->token;
    }

    public static function getDepartments($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/departments';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;

    }

    public static function getUsers($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/admin_users';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }

    public static function getCases($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/new-cases';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }
    public static function getCaseNotes($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/notes';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }

    public static function getCaseActivities($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/activities';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }

    public static function getCategories($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/case-types';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }

    public static function getSubCategories($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/case-sub-types';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }
    public static function getSubSubCategories($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/case-sub-sub-types';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }

    public static function getPeople($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/people';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }
    public static function getPeopleContacts($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/people-contacts';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }
    public static function getPeopleCases($url,$token){

        $curl = curl_init();
        $url .= '/api/cases/people-cases';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $new_response = json_decode($response);
        return $new_response->data;
    }


}
