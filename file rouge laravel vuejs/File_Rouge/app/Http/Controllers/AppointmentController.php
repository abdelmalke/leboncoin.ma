<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    public function index()
    {
        // Return all appointments for the authenticated user
        return auth()->user()->appointments;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'appointment_time' => 'required|date|after:now',
        ]);

        $data['user_id'] = auth()->id();

        $appointment = Appointment::create($data);

        return response()->json($appointment, 201);
    }

    public function show(Appointment $appointment)
    {
        // Ensure the authenticated user is either the appointment owner or the post owner
        if (auth()->id() !== $appointment->user_id && auth()->id() !== $appointment->post->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $appointment;
    }


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
    public function createAppointment(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'appointment_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Logic to create an appointment
        $appointment = new Appointment();
        $appointment->post_id = $request->input('post_id');
        $appointment->appointment_time = $request->input('appointment_time');
        $appointment->status = 'pending';
        $appointment->user_id = auth()->id(); // Assuming you're using Laravel's authentication system to get the current user's ID.
        $appointment->save();

        // Return a response
        return response()->json(['message' => 'Appointment created successfully!', 'appointment' => $appointment], 201);
    }
//     public function accept($id)
// {
//     $appointment = Appointment::findOrFail($id);
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
//     $appointment->status = 'declined';
//     $appointment->save();

//     return response()->json([
//         'message' => 'Appointment declined successfully',
//         'appointment' => $appointment
//     ], 200);
// }
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
public function accept($id)
{
    $appointment = Appointment::findOrFail($id);

    // Ensure the authenticated user is the post owner
    if (auth()->id() !== $appointment->post->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $appointment->status = 'accepted';
    $appointment->save();

    return response()->json([
        'message' => 'Appointment accepted successfully',
        'appointment' => $appointment
    ], 200);
}

public function decline($id)
{
    $appointment = Appointment::findOrFail($id);

    // Ensure the authenticated user is the post owner
    if (auth()->id() !== $appointment->post->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $appointment->status = 'declined';
    $appointment->save();

    return response()->json([
        'message' => 'Appointment declined successfully',
        'appointment' => $appointment
    ], 200);
}

}
