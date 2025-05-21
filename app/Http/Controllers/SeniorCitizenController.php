<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SeniorCitizen;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SeniorCitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
public function index()
{
    $seniors = SeniorCitizen::all(); // ✅ Make sure this fetches data
    return view('dashboards.senior.records.index', compact('seniors'));
}



public function create()
{
    return view('dashboards.senior.records.create');
}

public function store(Request $request)
{
    dd($request->all());
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
        'birth_date' => 'required',
        'place_of_birth' => 'required',
        'civil_status' => 'required',
        'educational_attainment' => 'required',
        'contact_number' => 'required',
        'profile_picture' => 'nullable|image',
        'attachments.*' => 'nullable|file',
        'family' => 'nullable|array',
        'family.*.name' => 'required|string',
        'family.*.relationship' => 'required|string',
        'family.*.age' => 'required|numeric',
        'family.*.civil_status' => 'required|string',
        'family.*.occupation' => 'nullable|string',
        'family.*.income' => 'nullable|string',
    ]);

    $seniorId = 'SC-' . now()->timestamp;
    $path = null;

    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    $attachmentPaths = [];
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $attachmentPaths[] = $file->store('attachments', 'public');
        }
    }

    // Save QR code image
    $qrPath = 'qrcodes/' . $seniorId . '.png';
    \QrCode::format('png')->size(200)->generate($seniorId, public_path('storage/' . $qrPath));

    // Save Family Data
    $familyData = $request->family ? json_encode($request->family) : null;

    // Store record
    SeniorCitizen::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'gender' => $request->gender,
        'status' => 'pending',
        'contact_number' => $request->contact_number,
        'profile_picture' => $path,
        'qr_code' => $qrPath,
        'senior_id' => $seniorId,
        'birth_date' => $request->birth_date,
        'place_of_birth' => $request->place_of_birth,
        'civil_status' => $request->civil_status,
        'blood_type' => $request->blood_type ?? null,
        'educational_attainment' => $request->educational_attainment,
        'occupation' => $request->occupation,
        'income' => $request->income,
        'emergency_name' => $request->emergency_name ?? '',
        'emergency_relationship' => $request->emergency_relationship ?? '',
        'emergency_contact' => $request->emergency_contact ?? '',
        'address' => $request->address ?? 'Abucay, Bataan',
        'attachments' => json_encode($attachmentPaths),
        'family_composition' => $familyData, // Store as JSON
    ]);

    return redirect()->route('senior.records.index')->with('success', 'Senior added successfully!');
}

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
