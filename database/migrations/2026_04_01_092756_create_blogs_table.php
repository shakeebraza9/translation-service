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
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('image')->nullable();
        $table->longText('description')->nullable();
        $table->date('date')->nullable();
        
        // Foreign Keys
        $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('category_id')->constrained('blog_categories')->onDelete('cascade');
        
        $table->string('tag')->nullable();
        $table->string('status')->default('draft');
        
        // SEO
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keyword')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
