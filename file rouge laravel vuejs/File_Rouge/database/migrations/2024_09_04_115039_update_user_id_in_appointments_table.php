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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->default(null)->change(); // Adjust as needed
        });
    }
    
};
