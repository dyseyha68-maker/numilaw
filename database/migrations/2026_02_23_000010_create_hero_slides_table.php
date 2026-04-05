<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('slide_key')->index(); // e.g., 'home', 'about', 'programs'
            $table->integer('order')->default(0);
            $table->string('title_en');
            $table->string('title_km');
            $table->text('subtitle_en')->nullable();
            $table->text('subtitle_km')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_km')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_text_km')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_icon')->nullable();
            $table->string('secondary_button_text_en')->nullable();
            $table->string('secondary_button_text_km')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->string('theme')->default('burgundy'); // burgundy, gold, cream, dark
            $table->string('overlay_opacity')->default('medium'); // light, medium, heavy
            $table->boolean('show_animation')->default(true);
            $table->string('animation_type')->default('fade'); // fade, slide, zoom
            $table->boolean('is_active')->default(true);
            $table->datetime('publish_at')->nullable();
            $table->datetime('expire_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_km')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_km')->nullable();
            $table->timestamps();
        });

        // Rename existing hero_images to hero_settings for page-level settings
        Schema::rename('hero_images', 'hero_settings');
        
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->string('section_type')->default('single')->after('page_key');
            $table->boolean('enable_slideshow')->default(false)->after('section_type');
            $table->integer('slideshow_interval')->default(5000)->after('enable_slideshow');
            $table->boolean('slideshow_autoplay')->default(true)->after('slideshow_interval');
            $table->boolean('slideshow_navigation')->default(true)->after('slideshow_autoplay');
            $table->boolean('slideshow_pagination')->default(true)->after('slideshow_navigation');
            $table->string('height')->default('85vh')->after('slideshow_pagination');
            $table->string('content_position')->default('center')->after('height');
        });
    }

    public function down(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->dropColumn([
                'section_type',
                'enable_slideshow',
                'slideshow_interval',
                'slideshow_autoplay',
                'slideshow_navigation',
                'slideshow_pagination',
                'height',
                'content_position',
            ]);
        });
        
        Schema::rename('hero_settings', 'hero_images');
        
        Schema::dropIfExists('hero_slides');
    }
};
