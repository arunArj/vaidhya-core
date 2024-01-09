<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(Request $request) {
        $searchParams = $request->input('search');
        $patientsQuery = Patients::query();

        if ($searchParams) {
            foreach ($searchParams as $key => $value) {
                if ($value) {
                    $patientsQuery->where($key, 'like', '%' . $value . '%');
                }
            }
        }

        $patients = $patientsQuery->paginate(10)->appends(['search' => $searchParams]);
        return view('patients.patients_list',compact('patients'));
       // return response()->json(['patients' => $patients], 200);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'sex' => 'required|in:0,1,2', // Restrict sex field to values 0, 1, 2
            'user_type' => 'required|in:0,1,2', // Restrict user_type field to values 0, 1, 2
            'phone' => 'required|string',
            'mrd_no' => 'required|string|unique:patients',
            'address' => 'required|string',

        ]);
        $patient = Patients::create($validatedData);
        // Optionally, you can return a response or redirect
        return response()->json(['message' => 'Patient data saved successfully', 'patient' => $patient], 201);

    }
    public function show( $patient) {
        $patient = Patients::find($patient);
        if(!$patient){
            return response()->json(['message' => 'Patient Not found'], 404);
        }
        return response()->json(['patient' => $patient], 200);
    }

    public function update(Request $request, $patient){

        $patient = Patients::find($patient);
        if(!$patient){
            return response()->json(['message' => 'Patient Not found'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'sex' => 'required|in:0,1,2', // Restrict sex field to values 0, 1, 2
            'user_type' => 'required|in:0,1,2', // Restrict user_type field to values 0, 1, 2
            'phone' => 'required|string',
            'mrd_no' => 'required|string|unique:patients,mrd_no,'.$patient->id,
            'address' => 'required|string',
            // Add other validation rules as needed
        ]);

        $patient->update($validatedData); // Fill the patient model with validated data
        return response()->json(['message' => 'Patient data updated successfully', 'patient' => $patient], 200);
    }
    public function destroy($patient){
        $patient = Patients::find($patient);
        if(!$patient){
            return response()->json(['message' => 'Patient Not found'], 404);
        }
        $patient->delete();
        return response()->json(['message' => 'Patient data deleted successfully'], 200);
    }
}
