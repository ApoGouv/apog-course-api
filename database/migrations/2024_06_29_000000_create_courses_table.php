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
        /**
         * Course database table should have:
         *  id
         *  title
         *  description
         *  status (Published,Pending)
         *  is_premium
         *  created_at
         *  deleted_at
         */
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Size defaults to 255
            $table->longText('description');
            $table->enum('status', ['Published', 'Pending']);
            $table->boolean('is_premium'); // TINYINT(1)
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
