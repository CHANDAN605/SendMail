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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('certificate_number');
            $table->string('event_name');
            $table->string('date_of_event');
            $table->string('organizer_name');
            $table->string('organizer_email')->unique();
            $table->string('website_url');
            $table->string('head_name');
            $table->string('mentor_nam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
