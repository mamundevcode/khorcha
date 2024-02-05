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
        Schema::create('social_media', function (Blueprint $table) {
            $table->bigIncrements('sm_id');
            $table->string('sm_facebook',100)->nullable();
            $table->string('sm_github',100)->nullable();
            $table->string('sm_twitter',100)->nullable();
            $table->string('sm_whatsapp',100)->nullable();
            $table->string('sm_instagram',100)->nullable();
            $table->string('sm_linkedin',100)->nullable();
            $table->string('sm_pinterest',100)->nullable();
            $table->string('sm_youtube',100)->nullable();
            $table->string('sm_reddit',100)->nullable();
            $table->string('sm_weixin',100)->nullable();
            $table->integer('sm_creator')->nullable();
            $table->integer('sm_editor')->nullable();
            $table->string('sm_slug',30)->nullable();
            $table->integer('sm_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
