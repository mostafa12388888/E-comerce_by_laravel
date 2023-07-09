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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('mobile',100);
            $table->text('address');
            $table->string('email',100)->nullable();
            $table->foreignId('catagory_id')->references('id')->on('main_catagories')->cascadeOnDelete();
           $table->tinyInteger('active')->default(0);
           $table->string('logo');
           $table->string('password');
           $table->string('latitude')->nullable();
           $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
