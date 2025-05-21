<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('senior_citizens', function (Blueprint $table) {
            if (Schema::hasColumn('senior_citizens', 'blood_type')) {
                $table->dropColumn('blood_type');
            }
            if (Schema::hasColumn('senior_citizens', 'emergency_name')) {
                $table->dropColumn('emergency_name');
            }
            if (Schema::hasColumn('senior_citizens', 'emergency_relationship')) {
                $table->dropColumn('emergency_relationship');
            }
            if (Schema::hasColumn('senior_citizens', 'emergency_contact')) {
                $table->dropColumn('emergency_contact');
            }
        });
    }

    public function down(): void
    {
        Schema::table('senior_citizens', function (Blueprint $table) {
            $table->string('blood_type')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->string('emergency_contact')->nullable();
        });
    }
};
