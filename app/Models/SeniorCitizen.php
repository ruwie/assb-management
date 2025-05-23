<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    

    protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'age',
    'status',
    'contact_number',
    'profile_picture',
    'qr_code',
    'senior_id',
    'birth_date',
    'place_of_birth',
    'civil_status',
    'educational_attainment',
    'occupation',
    'income',
    'emergency_name',
    'emergency_relationship',
    'emergency_contact',
    'address',
    'attachments',
    'family_composition'
];

}
