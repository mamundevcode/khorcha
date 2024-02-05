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
        Schema::create('contact_information', function (Blueprint $table) {
            $table->bigIncrements('ci_id');
            $table->string('ci_phone1',20)->nullable();
            $table->string('ci_phone2',20)->nullable();
            $table->string('ci_phone3',20)->nullable();
            $table->string('ci_phone4',20)->nullable();
            $table->string('ci_email1',40)->nullable();
            $table->string('ci_email2',40)->nullable();
            $table->string('ci_email3',40)->nullable();
            $table->string('ci_email4',40)->nullable();
            $table->text('ci_address1')->nullable();
            $table->text('ci_address2')->nullable();
            $table->text('ci_address3')->nullable();
            $table->text('ci_address4')->nullable();
            $table->integer('ci_creator')->nullable();
            $table->integer('ci_editor')->nullable();
            $table->string('ci_slug',30)->nullable();
            $table->integer('ci_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_information');
    }
};
