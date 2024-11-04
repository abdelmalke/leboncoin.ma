<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up()
    // {
    //     Schema::create('posts', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('title');
    //         $table->text('description');
    //         $table->decimal('price', 10, 2);
    //         $table->string('location');
    //         $table->float('area');
    //         $table->enum('type', ['Residential', 'Agricultural']);
    //         $table->string('image_url')->nullable();
    //         $table->foreignId('user_id')->constrained()->onDelete('cascade');
    //         $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Added category_id
    //         $table->enum('status', ['active', 'inactive', 'sold'])->default('active');
    //         $table->timestamps();
    //     });
    // }
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->float('area');
            $table->enum('type', ['Residential', 'Agricultural']);
            $table->string('image_url')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'sold'])->default('active');
            $table->string('type_of_property'); // 
            $table->float('habitable_area');    // 
            $table->boolean('in_city');         // 
            $table->boolean('fees_included');   // 
            $table->string('reference_number'); // 
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};