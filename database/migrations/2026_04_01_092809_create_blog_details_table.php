<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('blog_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
        $table->string('title')->nullable();
        $table->longText('description')->nullable();
        $table->string('image')->nullable();
        $table->string('preview_image')->nullable();
        $table->string('alignment')->default('left');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_details');
    }
};
