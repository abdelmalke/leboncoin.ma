<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;    
// use Spatie\Permission\Models\Role;

// class UserController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('auth');

//     }

//     public function index()
//     {
//         return User::all();
//     }
//     public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:8|confirmed',
//         'role' => 'required|string|in:user,admin,editor', // Ensure all roles are included
//     ]);

//     $user = User::create([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         'password' => bcrypt($validated['password']),
//     ]);

    
//     $user->assignRole($validated['role']);

//     return response()->json(['user' => $user], 201);
// }


    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //         'role' => 'required|string|exists:roles,name'
    //     ]);

    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);

    //     $user->assignRole($data['role']);

    //     return response()->json($user, 201);
    // }
    // public function update(Request $request, User $user)
    // {
    //     $data = $request->validate([
    //         'name' => 'string|max:255',
    //         'email' => 'string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'string|min:8|nullable',
    //         'role' => 'string|exists:roles,name'
    //     ]);

    //     if (isset($data['password'])) {
    //         $data['password'] = bcrypt($data['password']);
    //     }

    //     $user->update($data);

    //     if (isset($data['role'])) {
    //         $user->syncRoles($data['role']);
    //     }

    //     return response()->json($user);
    // }

    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return response()->json(['message' => 'User deleted']);
    // }

    // public function update(Request $request, User $user)
    // {
    //     $data = $request->validate([
    //         'name' => 'string|max:255',
    //         'email' => 'string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'string|min:8|nullable',
    //         'role' => 'string|exists:roles,name'
    //     ]);

    //     $user->update($data);

    //     if (isset($data['role'])) {
    //         $user->syncRoles($data['role']);
    //     }

    //     return response()->json($user);
    // }

    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return response()->json(['message' => 'User deleted']);
    // }
//}


namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // Apply middleware to all methods in this controller
    //     $this->middleware('auth');

    //     // Or apply middleware only to specific methods
    //     $this->middleware('auth')->only(['edit', 'update']);

    //     // Or exclude middleware from specific methods
    //     $this->middleware('auth')->except(['index', 'show']);
    // }
//     public function __construct()
//     {
//         // Only allow admins to manage users
//         $this->middleware(function ($request, $next) {
//             if (!auth()->user()->hasRole('admin')) {
//                 return response()->json(['message' => 'Unauthorized'], 403);
//             }
//             return $next($request);
//         });
//     }

//     // Existing methods (index, store, update, destroy)
// }


    public function index()
    {
        // $users = User::with('roles')->get(); // Make sure you're eager loading the roles
        // dd($users); // Dump the response to check its format
        // return response()->json($users, 200);
        return User::all();

    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin,editor',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request, User $user)
    {
        // $validated = $request->validate([
        //     'name' => 'string|max:255',
        //     'email' => 'string|email|max:255|unique:users,email,' . $user->id,
        //     'password' => 'string|min:8|confirmed|nullable',
        //     'role' => 'string|in:user,admin,editor'
        // ]);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin,editor',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        if (isset($validated['role'])) {
            $user->syncRoles($validated['role']);
        }

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }
}

