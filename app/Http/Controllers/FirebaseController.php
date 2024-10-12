<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

use Illuminate\Http\Request;

class FirebaseController extends Controller
{

    // Views Controller
    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function loaders(){
        return view('loaders');
    }

    public function logout(){
        session()->flush(); // Clear all session data
        return redirect(route('view.login'));
    }




    



    // Firebase CRUD Controller

    // Fetch Data of All Income,Expenses,Active Users
    public function fetchExpenses(Database $database)
    {
        $fetchExpense = $database->getReference(path: 'financialRecords')->getValue();
        $users = $database->getReference(path: 'userCrendential')->getValue();

         // If fetchData is null, assign it an empty array
        if(is_null(value: $fetchExpense) && is_null($users)){
            $fetchExpense = [];
            $users = [];
        }

        return view('layout.dashboard', 
        compact('fetchExpense','users',));
    }

    // Fetch Data of All Users
    public function user(Database $database)
    {
        $fetchData = $database->getReference(path: 'userCrendential')->getValue();

         // If fetchData is null, assign it an empty array
        if(is_null($fetchData)){
            $fetchData = [];
        }

        return view('layout.customer', data: compact(var_name: 'fetchData'));
    }

    // Fetch Data using key of the user
    public function customerInfo(Database $database, $id){
        $key = $id;
        $fetchData = $database->getReference('userCrendential')
        ->getChild($key)->getValue();

        // Fetch the all amount of the specific user
        $fetchAmount = $database->getReference('financialRecords')
        ->orderByChild('userID')
        ->equalTo($key)
        ->getValue();
        
        if(is_null($fetchData) || is_null($fetchAmount)){
             // If the key doesn't exist throw an error to index view
            return redirect(route('view.user'))
            ->with('error','No Data Key ID exist!');
            
        }else{
           return view('layout.updateProfile', 
            compact('fetchData','fetchAmount' ,'key'));
        }
    }

    // FetchData of Specific User
    public function editProfile(Database $database, $id){
        $key = $id;

        $userData = $database->getReference('userCrendential')
        ->getChild($key)->getValue();

        if(is_null($userData)){
            $userData = [];
        }

        return view('layout.editProfile',
        compact('userData','key'));
    }


    // Edit Firebase Controller
    public function edit(Request $request, Database $database, $key){
        $user_Key = $key;

        $updateData = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname
        ];

        $updateRef = $database->getReference('userCrendential/'.$user_Key)->update($updateData);

        if($updateRef){
            return redirect(route('view.customerInfo',['key' => $user_Key]))
            ->with('update-success','Profile Info Update Successfully.');

        }else{
            return redirect(route('view.editProfile',['key' => $user_Key]))
            ->with('update-error','Failed to Update!');
        }
    }


    // Store Data in Firebase Controller
public function store(Request $request, Database $database)
{
    // Hash the password before storing it
    $hashedPassword = Hash::make($request->password);

    // Create a reference to the 'admin' node and generate a unique key
    $ref = $database->getReference('admin');
    $newUserRef = $ref->push(); // Generate a new reference with a unique ID

    $postData = [
        'ID' => $newUserRef->getKey(), // Include the auto-generated ID
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => $hashedPassword, // Store the hashed password
    ];

    // Check if the email already exists
    $email_Duplicate = $ref->orderByChild('email')->equalTo($request->email)->getValue();

    if ($email_Duplicate) {
        return redirect(route('view.register'))
            ->with('duplicate', 'This email already exists.');
    } else {
        // Store the data with the auto-generated ID
        $storeRef = $newUserRef->set($postData); // Use set() to store the data at the new reference

        if ($storeRef) {
            // Retrieve user data from the database
            $user = $database->getReference('admin')->orderByChild('email')->equalTo($request->email)->getValue();

            $userData = reset($user);// Get the first result

             // Set the user data in session
            session([
                'user_id' => $userData['ID'], // Assuming 'id' is the key for the user ID
                'email' => $userData['email'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
            ]);

            return redirect(route('view.loaders'));
        } else {
            return redirect(route('view.register'))
                ->with('error', 'Registration failed.');
        }
    }
}



// Check Login Data
public function checkLogin(Request $request, Database $database)
{
    $email = $request->email;
    $password = $request->password;

    // Retrieve user data from the database
    $user = $database->getReference('admin')->orderByChild('email')->equalTo($email)->getValue();

    if ($user) {
        $userData = reset($user); // Get the first result
        
        // Check if the entered password matches the stored hashed password
        if (Hash::check($password, $userData['password'])) {
            // Set the user data in session
            session([
                'user_id' => $userData['ID'], // Assuming 'id' is the key for the user ID
                'email' => $userData['email'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
            ]);

            return view('loaders');
            
        } else {
            return redirect(route('view.login'))->with('error', 'Incorrect email or password.');
        }
    } else {
        // No user found with this email
        return redirect(route('view.login'))->with('no_data', 'User not found.');
    }
}

}