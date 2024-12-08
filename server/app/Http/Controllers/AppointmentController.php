<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AppointmentController extends Controller
{
    public function create(Request $request) {
        $message = [
            'description.required' => 'É necessário descrever a sua consulta.',
            'description.min' => 'A descrição é necessário ter, pelo menos, 10 caracteres.',
            'description.max' => 'A descrição é, no máximo, 255 caracteres.',
        ];

        $user = User::where('id', Auth::id())->first();

        if ($user->role === 2) {
            return response(['message' => 'Apenas pacientes podem criar consultas.']);
        }

        $validatedData = $request->validate([
            'description' => 'required|string|min:10|max:255',
        ], $message);

        $validatedData['user_id'] = Auth::id();

        return Appointment::create($validatedData);
    }

    public function indexAllDoctorAppointments() {
        $user = User::where('id', Auth::id())->first();

        if ($user->role === 1) {
            return response(['message' => 'Apenas especialistas podem ver todas as consultas.']);
        }

        return Appointment::all()->where('doctor', null);
    }

    public function indexAllPatientAppointments() {
        $user = User::where('id', Auth::id())->first();

        return Appointment::all()->where('user_id', $user->id);
    }
}
