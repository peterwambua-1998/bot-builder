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
        Schema::create('node_options_ais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('node_id');
            $table->boolean('option_type')->default(2); // 1. button 2. ai
            $table->boolean('type')->default(1); // 1. conversational, 2. link
            $table->longText('instructions'); // alias prompt
            $table->string('out_of_context_msg');
            $table->string('website_link')->nullable();
            $table->double('temperature');
            $table->integer('tokens');
            $table->longText('workflow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_options_ais');
    }
};
