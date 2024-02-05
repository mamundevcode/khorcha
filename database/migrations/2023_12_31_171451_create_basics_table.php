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
        Schema::create('basics', function (Blueprint $table) {
            $table->bigIncrements('basic_id');
            $table->string('basic_company',100)->nullable();
            $table->string('basic_title',100)->nullable();
            $table->string('basic_logo',50)->nullable();
            $table->string('basic_favicon',50)->nullable();
            $table->string('basic_flogo',50)->nullable();
            $table->integer('basic_creator')->nullable();
            $table->integer('basic_editor')->nullable();
            $table->string('basic_slug',30)->nullable();
            $table->integer('basic_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basics');
    }
};
