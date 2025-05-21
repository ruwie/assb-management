<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('senior_citizens', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('middle_name')->nullable();
        $table->string('last_name');
        $table->string('gender');
        $table->string('status')->default('pending'); // pending or complete
        $table->string('contact_number');
        $table->string('profile_picture')->nullable();
        $table->string('qr_code')->nullable();
        $table->string('senior_id')->unique();
        $table->date('birth_date');
        $table->string('place_of_birth');
        $table->string('civil_status');
        $table->string('blood_type')->nullable();
        $table->string('educational_attainment');
        $table->string('occupation')->nullable();
        $table->string('emergency_name');
        $table->string('emergency_relationship');
        $table->string('emergency_contact');
        $table->string('address'); // Assume fixed: Abucay, Bataan
        $table->json('attachments')->nullable(); // for uploaded requirements
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senior_citizens');
    }
};
