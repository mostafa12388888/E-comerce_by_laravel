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
        Schema::create('main_catagories', function (Blueprint $table) {
            $table->id();
            $table->string('Translation_lang',10);
            $table->unsignedInteger('Translation_of');
            $table->string('name',150);
            $table->string('slug',150)->nullable();
            $table->string('photo',150)->nullable();
            $table->tinyInteger('active')->default(1)->comment('1=>active,0->NOT active');
            $table->timestamps();
            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_catagories');
    }
};
