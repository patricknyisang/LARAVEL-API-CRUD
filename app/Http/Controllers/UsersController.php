<?php

namespace App\Http\Controllers;

use App\Models\TBMaritalStatus;
use App\Models\TBGender;
use App\Models\TBMuteStatus;
use App\Models\TBUsers;
use App\Models\TBProducts;
use App\Models\TBCategories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class UsersController extends Controller
{



    public function loginApi(Request $request)
{     Log::info("Request data: ".json_encode($request->all()));
    try{

        $username = $request->input('Username');
        $password = $request->input('Password');
        
          if ($username == null){
                return response(['error'=>true,'message'=>'Username missing']);
            } 
            
              if ($password == null){
                return response(['error'=>true,'message'=>'Password missing']);
            } 
        if ( isset($username) && isset($password)){
            $records = TBUsers::getWhere(["email" => $username],true);
            Log::info("rec: ".json_encode($records));

            if (isset($records->{'pass1'})){
                if ($records->{'pass1'} == $password) {
                    $pid = $records->{"pid"};
                    $fname = @TBUsers::getWhere(['pid'=>$pid],true)->{"firstname"}?:"";
                    $lname = @TBUsers::getWhere(['pid'=>$pid],true)->{"secondname"}?:"";
                    $useremail = @TBUsers::getWhere(['pid'=>$pid],true)->{"email"}?:"";
                    $userole= @TBUsers::getWhere(['pid'=>$pid],true)->{"role"}?:"";

                    return response([
                        "error" => false,
                        "message" => "Success!",
                        "pid" => $pid,
                        "fname" => $fname,
                        "lname" => $lname,
                        "email" => $useremail,
                        "role" => $userole,
                   

                    ],200);
                }
                return response([
                    "error" => true,
                    "message" => "Invalid credentials try again!"
                ],401);
            }
            return response([
                "error" => true,
                "message" => "Credentials not found in our systems!"
            ],404);
        }
        return response([
            "error" => true,
            "message" => "Enter required details!"
        ]);
    }catch (Exception $e){
        return response([
            "error" => true,
            "message" => "Error! ".$e->getMessage(),"Line".$e->getLine()
        ],500);
    }
}
    public function Createuser(Request $request)
    {
        try {
            // Get current date and time
            $dateTime = Carbon::now();
    
            // Manually setting user ID by getting the last record
            $lastRec = TBUsers::orderBy('id', 'desc')->first();
            $pid = $lastRec ? (int)$lastRec->pid + 1 : 1; // If no record, start with 1
    
            // Retrieve user input from request
            $FirstName = $request->get('FirstName');
            $LastName = $request->get('LastName');
            $Gender = $request->get('Gender');
            $MaritalStatus = $request->get('Marital');
            $UserLocation = $request->get('Location');
            $UserAge = $request->get('Age');
            $UserEmail = $request->get('EmailAddress');
            $password1 = $request->get('Pass1');
            $password2 = $request->get('Pass2');
            $role = 1; // Assign a role
            $UnmuteStatus = 6; // 6 represents unmute in the database
    
            // Check if passwords match
            if ($password1 !== $password2) {
                return response()->json(['error' => 'Passwords do not match'], 400);
            }
    
            // Hash the password
            $hashedPassword = Hash::make($password1);
    
            // Inserting into categories/status table (assumed table)
            $CategoriesStatus = [
                'userid' => $pid,
                'videoid' => $UnmuteStatus,
                'musicid' => $UnmuteStatus,
                'ebookid' => $UnmuteStatus,
                'print_on_demand' => $UnmuteStatus,
                'electronicid' => $UnmuteStatus,
                'fashionid' => $UnmuteStatus,
            ];
    
            // Assuming there's another model for categories, e.g., TBUserCategories
            TBMuteStatus::create($CategoriesStatus);
    
            // Insert user data into TBUsers
            $MarketUsers = [
                'pid' => $pid,
                'firstname' => $FirstName,
                'secondname' => $LastName,
                'genderid' => $Gender,
                'maritalid' => $MaritalStatus,
                'location' => $UserLocation,
                'age' => $UserAge,
                'email' => $UserEmail,
                'date' => $dateTime,
                "pass1" => $password1, 
                "pass2" => $password2,
                'role' => $role,
            ];
    
            TBUsers::create($MarketUsers);
    
            // Return a JSON success response
            return response()->json(['message' => 'User created successfully'], 201);
    
        } catch (\Exception $e) {
            // Catch and return any exception as a JSON response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getgenders()
{   
    try {
    $genders = TBGender:: all();
    $genders2= [];
    foreach($genders as $gendeer) {
        $genders2[] = [
            "id" => $gendeer->{'genderid'},
            "gender" => $gendeer->{'gendername'},
        
        ];
        
     
    }
    return response()->json($genders2, 200);
} catch (\Exception $e) {
    return response()->json([
        'error' => true,
        'message' => $e->getMessage()
    ], 400);
}
}

public function getmaritalstatus(){   
    try {
    $maritalstatuses = TBMaritalStatus:: all();
    $mstatuses= [];
    foreach($maritalstatuses as $marital) {
        $mstatuses[] = [
            "id" => $marital->{'id'},
            "status" => $marital->{'maritalstatus'},
        
        ];
        
      
    }

    return response()->json($mstatuses, 200);
} catch (\Exception $e) {
    return response()->json([
        'error' => true,
        'message' => $e->getMessage()
    ], 400);
}
    
}


}