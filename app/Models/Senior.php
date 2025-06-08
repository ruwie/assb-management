<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senior extends Model
{
    use HasFactory;

    protected $fillable = [
        'senior_id',
        'photo',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'age',
        'occupation',
        'house_no',
        'barangay',
    ];
}
