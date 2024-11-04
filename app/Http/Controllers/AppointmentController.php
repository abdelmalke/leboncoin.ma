<?php

// namespace App\Http\Controllers;

// use App\Models\Appointment;
// use App\Models\Post;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Gate;

// class AppointmentController extends Controller
// {
//     public function index()
//     {
//         // Return all appointments for the authenticated user
//         return auth()->user()->appointments;
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'post_id' => 'required|exists:posts,id',
//             'appointment_time' => 'required|date|after:now',
//         ]);

//         $data['user_id'] = auth()->id();

//         $appointment = Appointment::create($data);

//         return response()->json($appointment, 201);
//     }

//     public function show(Appointment $appointment)
//     {
//         // Ensure the authenticated user is either the appointment owner or the post owner
//         if (auth()->id() !== $appointment->user_id && auth()->id() !== $appointment->post->user_id) {
//             return response()->json(['message' => 'Unauthorized'], 403);
//         }

//         return $appointment;
//     }


//     public function update(Request $request, Appointment $appointment)
//     {
//         Gate::authorize('modify-appointment', $appointment);

//         $data = $request->validate([
//             'status' => 'required|in:accepted,rejected',
//         ]);

//         $appointment->update($data);

//         return response()->json($appointment, 200);
//     }

//     public function destroy(Appointment $appointment)
//     {
//         Gate::authorize('modify-appointment', $appointment);

//         $appointment->delete();

//         return response()->json(['message' => 'Appointment deleted'], 200);
//     }
//     public function createAppointment(Request $request)
//     {
//         // Validate the request data
//         $validatedData = $request->validate([
//             'post_id' => 'required|exists:posts,id',
//             'appointment_time' => 'required|date_format:Y-m-d H:i:s',
//         ]);

//         // Logic to create an appointment
//         $appointment = new Appointment();
//         $appointment->post_id = $request->input('post_id');
//         $appointment->appointment_time = $request->input('appointment_time');
//         $appointment->status = 'pending';
//         $appointment->user_id = auth()->id(); // Assuming you're using Laravel's authentication system to get the current user's ID.
//         $appointment->save();

//         // Return a response
//         return response()->json(['message' => 'Appointment created successfully!', 'appointment' => $appointment], 201);
//     }

// public function accept($id)
// {
//     $appointment = Appointment::findOrFail($id);

//     // Ensure the authenticated user is the post owner
//     if (auth()->id() !== $appointment->post->user_id) {
//         return response()->json(['message' => 'Unauthorized'], 403);
//     }

//     $appointment->status = 'accepted';
//     $appointment->save();

//     return response()->json([
//         'message' => 'Appointment accepted successfully',
//         'appointment' => $appointment
//     ], 200);
// }

// public function decline($id)
// {
//     $appointment = Appointment::findOrFail($id);

//     // Ensure the authenticated user is the post owner
//     if (auth()->id() !== $appointment->post->user_id) {
//         return response()->json(['message' => 'Unauthorized'], 403);
//     }

//     $appointment->status = 'declined';
//     $appointment->save();

//     return response()->json([
//         'message' => 'Appointment declined successfully',
//         'appointment' => $appointment
//     ], 200);
// }

// }

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{

    public function index() {
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments]);
    }
    
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'post_id' => 'required|exists:posts,id',
    //         'appointment_time' => 'required|date|after:now',
    //     ]);

    //     $data['user_id'] = auth()->id();
    //     $appointment = Appointment::create($data);

    //     return response()->json($appointment, 201);
    // }
   
    
    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'post_id' => 'required|exists:posts,id',
        'appointment_time' => 'required|date_format:Y-m-d\TH:i',
    ]);

    // Create a new appointment and set the user_id
    $appointment = new Appointment();
    $appointment->post_id = $validated['post_id'];
    $appointment->user_id = auth()->id(); // Assign the authenticated user's ID
    $appointment->appointment_time = $validated['appointment_time'];
    $appointment->status = 'pending'; // Default status
    $appointment->save();

    return response()->json(['message' => 'Appointment booked successfully!']);
}
public function show($id)
{
    
    
    $appointment = Appointment::with('user')->find($id);
    if (!$appointment) {
        return response()->json(['message' => 'Appointment not found'], 404);
    }

    return response()->json(['appointment' => $appointment], 200);
}

// public function show(Appointment $appointment)
// {
//     // Ensure the current user is authorized to view the appointment
//     if (auth()->id() !== $appointment->user_id && auth()->id() !== $appointment->post->user_id) {
//         return response()->json(['message' => 'Unauthorized'], 403);
//     }

//     // Fetch the appointment with the requester (user) details
//     $appointment->load('user'); // Load the related user data
//     return response()->json([
//         'appointment' => $appointment,
//         'requester_name' => $appointment->user->name,
//         'requester_email' => $appointment->user->email,
//         'requested_date' => $appointment->created_at,
//     ]);
// }


    // public function show(Appointment $appointment)
    // {

    //     if (auth()->id() !== $appointment->user_id && auth()->id() !== $appointment->post->user_id) {
    //         return response()->json(['message' => 'Unauthorized'], 403);
    //     }

    //     $appointment = Appointment::with('user')->find($id); // Assuming the appointment is linked to the user who created it
    //     return response()->json([
    //         'appointment' => $appointment,
    //         'requester_name' => $appointment->user->name,
    //         'requester_email' => $appointment->user->email,
    //         'requested_date' => $appointment->created_at,
    //     ]);
    // }

    public function update(Request $request, Appointment $appointment)
    {
        Gate::authorize('modify-appointment', $appointment);

        $data = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $appointment->update($data);

        return response()->json($appointment, 200);
    }

    public function destroy(Appointment $appointment)
    {
        Gate::authorize('modify-appointment', $appointment);

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted'], 200);
    }



    public function decline($id)
    {
        $appointment = Appointment::findOrFail($id);

        if (auth()->id() !== $appointment->post->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $appointment->status = 'declined';
        $appointment->save();

        return response()->json(['message' => 'Appointment declined successfully', 'appointment' => $appointment], 200);
    }
    public function indexByPostOwner()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch posts created by the authenticated user
        $appointments = Appointment::whereHas('post', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('user')->get();

        return response()->json(['appointments' => $appointments], 200);
    }

    // Accept an appointment
    public function accept($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        // Ensure the authenticated user is the owner of the post associated with the appointment
        if (auth()->user()->id !== $appointment->post->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $appointment->status = 'accepted';
        $appointment->save();

        return response()->json(['message' => 'Appointment accepted successfully']);
        
    }

    // Reject an appointment
    public function reject($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        // Ensure the authenticated user is the owner of the post associated with the appointment
        if (auth()->user()->id !== $appointment->post->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $appointment->status = 'rejected';
        $appointment->save();

        return response()->json(['message' => 'Appointment rejected successfully']);
    }
}
    

