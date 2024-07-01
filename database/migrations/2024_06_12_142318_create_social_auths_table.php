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
        Schema::create('social_auths', function (Blueprint $table) {
            $table->id();           
            $table->string('twitter_screen_name')->nullable();
            $table->string('twitter_oauth_token')->nullable();
            $table->string('twitter_oauth_token_secret')->nullable();
                      $table->timestamps();
                      $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_auths');
    }
};
