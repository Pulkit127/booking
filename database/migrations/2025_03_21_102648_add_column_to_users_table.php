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
        Schema::table('users', function (Blueprint $table) {
            $table->string('display_name')->nullable()->after('id');
            $table->string('nationality')->nullable()->after('remember_token');
            $table->string('address')->nullable()->after('nationality');
            $table->date('dob')->nullable()->after('address');
            $table->string('gender')->nullable()->after('dob');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['display_name', 'nationality', 'address', 'dob','gender']);      
        });
    }
};
