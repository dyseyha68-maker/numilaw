<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'News & Announcements',
                'name_km' => 'ព័ត៌មាន និងប្រកាស់',
                'description_en' => 'Official news and announcements from the university',
                'description_km' => 'ព័ត៌មាន និងប្រកាស់ផ្លូវការពីសាកលវិទ្យាល័យ',
                'is_active' => true,
            ],
            [
                'name_en' => 'Research & Publications',
                'name_km' => 'ការស្រាវជ្រាវ និងការបោះពុម្ពិត',
                'description_en' => 'Research papers and academic publications',
                'description_km' => 'ក្រដីស្រាវជ្រាវ និងការបោះពុម្ពិតវិទ្យាសាស្ត្រ',
                'is_active' => true,
            ],
            [
                'name_en' => 'Events & Seminars',
                'name_km' => 'ព្រឹត្តិការណ៍ និងសិក្ខាសាល',
                'description_en' => 'Upcoming events, seminars, and workshops',
                'description_km' => 'ព្រឹត្តិការណ៍ដែលកំពុងមកដល់ សិក្ខាសាល និងវគ្គសិក្សា',
                'is_active' => true,
            ],
            [
                'name_en' => 'Student Life',
                'name_km' => 'ជីវិតនិស្សិត',
                'description_en' => 'Student activities, clubs, and campus life',
                'description_km' => 'សកម្មភាពនិស្សិត ក្លឹប និងជីវិតសាសនាវិតុ',
                'is_active' => true,
            ],
            [
                'name_en' => 'Academic Programs',
                'name_km' => 'កម្មវិធីសិក្សា',
                'description_en' => 'Information about academic programs and courses',
                'description_km' => 'ព័ត៌មានអំពីកម្មវិធីសិក្សា និងវគ្គជន',
                'is_active' => true,
            ],
            [
                'name_en' => 'Faculty Achievements',
                'name_km' => 'សមិទ្ធិផលរបស់បណ្ឌិត',
                'description_en' => 'Recognitions and achievements of faculty members',
                'description_km' => 'ការទទួលស្គាល់ និងសមិទ្ធិផលរបស់សមាជន្តបណ្ឌិត',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create(array_merge($category, ['slug' => Str::slug($category['name_en'])]));
        }
    }
}
