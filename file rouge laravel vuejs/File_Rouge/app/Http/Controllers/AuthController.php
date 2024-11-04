<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
//     public function register (Request $request){

//  $fields = $request->validate([
//             'name' => 'required|max:255',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|confirmed'
//         ]);
//         $user = User::create($fields);
//         $user->assignRole('admin');
        
//         $token = $user->createToken($request->name);
        

//         return [
//             'user' => $user,
//             'token' => $token->plainTextToken,

//         ];
// }
public function register(Request $request)
{
    $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password']),
    ]);

    $user->assignRole('admin'); // Assign the admin role
    $user->load('roles'); // Load roles relationship

    $token = $user->createToken($request->name)->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
        'role' => $user->roles->pluck('name')->first() // Get the role name
    ], 201);
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'errors' => [
                'email' => ['The provided credentials are incorrect.']
            ]
        ], 401);
    }

    $user->load('roles'); // Load roles relationship
    $token = $user->createToken($user->name)->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
        'role' => $user->roles->pluck('name')->first() // Get the role name
    ], 200);
}


//     public function login (Request $request){

//         $request->validate([
//             'email' => 'required|email|exists:users',
//             'password' => 'required'
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return [
//                 'errors' => [
//                     'email' => ['The provided credentials are incorrect.']
//                 ]
//             ];
//         }

//         $token = $user->createToken($user->name);
//         $user->load('roles'); // Eager load roles relationship


//         return [
//             'user' => $user,
//             'token' => $token->plainTextToken,
//             'role' => $user->roles->pluck('name')->first() 

//         ];
// }
    public function logout (Request $request){
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.' 
        ];
} 
public function createUser(Request $request)
{
    $this->authorize('create', User::class); // Authorization check
    
    $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => Hash::make($fields['password']),
    ]);
    $user->assignRole('user'); // Assign default role

    return response()->json(['user' => $user], 201);
}

public function updateUser(Request $request, User $user)
{
    $this->authorize('update', $user); // Authorization check

    $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|confirmed'
    ]);

    $user->update([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => $fields['password'] ? Hash::make($fields['password']) : $user->password,
    ]);

    return response()->json(['user' => $user], 200);
}

public function deleteUser(User $user)
{
    $this->authorize('delete', $user); // Authorization check

    $user->delete();

    return response()->json(['message' => 'User deleted successfully'], 200);
}

}