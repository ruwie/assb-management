<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Senior;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;

class SeniorController extends Controller
{
    public function index()
    {
        $seniors = Senior::all();
        return view('records.senior', compact('seniors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'first_name' => 'required|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'required|string',
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');

        $cleanName = Str::slug($request->last_name . '_' . $request->first_name . '_' . $request->middle_name);
        $extension = $image->getClientOriginalExtension();
        $filename = $cleanName . '_' . time() . '.' . $extension;

        $resizedImage = Image::make($image)->resize(192, 192)->encode();

        \Storage::disk('public')->put('seniors/' . $filename, $resizedImage);

        $photoPath = $filename;
    } else {    
        $photoPath = null;
    }

    // Generate Senior ID (you can customize your ID generation logic)
    $latestSenior = Senior::orderBy('id', 'desc')->first();
    $newSeniorId = $latestSenior ? 'SC' . str_pad($latestSenior->id + 1, 6, '0', STR_PAD_LEFT) : 'SC000001';

    Senior::create([
        'senior_id' => $newSeniorId,
        'photo' => $photoPath,
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
    ]);

    return redirect()->route('records.senior')->with('success', 'Senior citizen added successfully.');
}

public function update(Request $request, $id)
{
    $senior = Senior::findOrFail($id);
    $senior->first_name = $request->first_name;
    $senior->middle_name = $request->middle_name;
    $senior->last_name = $request->last_name;
    $senior->save();

    return redirect()->back()->with('success', 'Senior information updated successfully.');
}

public function destroy($id)
{
    $senior = Senior::findOrFail($id);

    // Delete photo if exists
    if ($senior->photo) {
        Storage::disk('public')->delete('seniors/' . $senior->photo);
    }

    $senior->delete();

    return redirect()->route('records.senior')->with('success', 'Senior record deleted successfully.');
}

}


