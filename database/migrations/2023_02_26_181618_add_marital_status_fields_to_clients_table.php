<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('date_of_marriage')->nullable();
            $table->string('date_of_divorce')->nullable();
            $table->string('place_of_marriage')->nullable();
            $table->string('marriage_cert')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['date_of_marriage', 'date_of_divorce', 'place_of_marriage', 'marriage_cert']);
        });
    }
};
