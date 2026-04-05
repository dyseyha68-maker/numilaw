<?php

namespace Database\Seeders;

use App\Models\HeroSettings;
use Illuminate\Database\Seeder;

class HeroImageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'page_key' => 'faculty',
                'title' => 'Faculty',
                'default_image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'partners',
                'title' => 'Partner Universities',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'leadership',
                'title' => 'Leadership Team',
                'default_image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'programs',
                'title' => 'Academic Programs',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'program_detail',
                'title' => 'Program Detail',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'projects',
                'title' => 'Projects',
                'default_image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'events',
                'title' => 'Events',
                'default_image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'event_detail',
                'title' => 'Event Detail',
                'default_image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'about',
                'title' => 'About Us',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'about_overview',
                'title' => 'About - Overview',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'about_mission',
                'title' => 'About - Mission',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'about_vision',
                'title' => 'About - Vision',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'admission',
                'title' => 'Admission',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'admission_requirements',
                'title' => 'Admission Requirements',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'calendar',
                'title' => 'Academic Calendar',
                'default_image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'calendar_detail',
                'title' => 'Calendar Detail',
                'default_image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'alumni',
                'title' => 'Alumni',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'alumni_stories',
                'title' => 'Alumni Stories',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'alumni_register',
                'title' => 'Alumni Register',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'alumni_events',
                'title' => 'Alumni Events',
                'default_image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'jobs',
                'title' => 'Jobs',
                'default_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'articles',
                'title' => 'Articles / News',
                'default_image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200&q=80',
                'is_active' => true,
            ],
            [
                'page_key' => 'moot_courts',
                'title' => 'Moot Courts',
                'default_image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1200&q=80',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            HeroSettings::updateOrCreate(
                ['page_key' => $page['page_key']],
                $page
            );
        }
    }
}
