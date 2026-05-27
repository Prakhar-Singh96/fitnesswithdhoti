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
        Schema::create('calculator_pages', function (Blueprint $table) {
            $table->id();
            // कैट और सब-कैट की ID मैपिंग के लिए
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->string('sub_category_slug')->unique(); // rudraksha, gemstone, bracelet

            // Core Content Fields
            $table->string('page_title')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_short_desc')->nullable();
            $table->string('hero_banner')->nullable();

            $table->string('about_title')->nullable();
            $table->longText('about_desc')->nullable();
            $table->string('about_banner')->nullable();

            $table->string('content_title')->nullable();
            $table->longText('content_body')->nullable();

            // New Content Sections Added By You
            $table->string('product_recommendation_title')->nullable();

            $table->string('spiritual_title')->nullable();
            $table->longText('spiritual_desc')->nullable();
            $table->string('spiritual_image')->nullable();

            $table->string('benefits_title')->nullable();
            $table->longText('benefits_desc')->nullable();

            $table->string('how_to_wear_title')->nullable();
            $table->longText('how_to_wear_desc')->nullable();
            $table->string('how_to_wear_image')->nullable();

            $table->string('what_is_calculator_title')->nullable();
            $table->longText('what_is_calculator_desc')->nullable();

            $table->string('how_to_use_title')->nullable();
            $table->longText('how_to_use_desc')->nullable();

            // Arrays/JSON Fields for Repeater Types
            $table->json('testimonials')->nullable();
            $table->json('faqs')->nullable();
            $table->longText('conclusion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_pages');
    }
};
