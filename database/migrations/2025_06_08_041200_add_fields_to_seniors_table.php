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
    Schema::table('seniors', function (Blueprint $table) {
        $table->date('dob')->nullable();
        $table->integer('age')->nullable();
        $table->string('occupation')->nullable();
        $table->string('house_no')->nullable();
        $table->string('barangay')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seniors', function (Blueprint $table) {
            //
        });
    }
};
