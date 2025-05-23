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
    Schema::table('senior_citizens', function (Blueprint $table) {
        $table->integer('age')->after('birth_date')->nullable();
        $table->dropColumn('gender');
    });
}

public function down()
{
    Schema::table('senior_citizens', function (Blueprint $table) {
        $table->dropColumn('age');
        $table->string('gender')->nullable(); // rollback support
    });
}
};
