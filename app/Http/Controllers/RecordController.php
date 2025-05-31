<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function aics()
    {
        // Fetch and pass AICS records to the view
        return view('records.aics');
    }

    public function senior()
    {
        // Fetch and pass Senior Citizen records
        return view('records.senior');
    }

    public function solo()
    {
        // Fetch and pass Solo Parent records
        return view('records.solo');
    }

    public function pwd()
    {
        // Fetch and pass PWD records
        return view('records.pwd');
    }

    public function allRecords()
    {
        // Fetch all records for admin
        return view('records.all');
    }
}
