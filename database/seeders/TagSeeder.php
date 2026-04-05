<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name_en' => 'Law',
                'name_km' => 'ច្បាប់',
                'description_en' => 'Legal studies and law-related content',
                'description_km' => 'ការសិក្សាពាក់ព្រឹត្តន៍ និងមាតិកាដែលទាក់ទងនឹងច្បាប់',
                'color' => '#dc3545',
                'is_active' => true,
            ],
            [
                'name_en' => 'Research',
                'name_km' => 'ការស្រាវជ្រាវ',
                'description_en' => 'Research activities and findings',
                'description_km' => 'សកម្មភាពស្រាវជ្រាវ និងលទ្ធផល',
                'color' => '#0d6efd',
                'is_active' => true,
            ],
            [
                'name_en' => 'Student Activity',
                'name_km' => 'សកម្មភាពនិស្សិត',
                'description_en' => 'Student-related activities and events',
                'description_km' => 'សកម្មភាព និងព្រឹត្តិការណ៍ដែលទាក់ទងនឹងនិស្សិត',
                'color' => '#198754',
                'is_active' => true,
            ],
            [
                'name_en' => 'Conference',
                'name_km' => 'សន្និសីទ',
                'description_en' => 'Academic conferences and symposiums',
                'description_km' => 'សន្និសីទវិទ្យាសាស្ត្រ និងសន្និដ្ឋាន',
                'color' => '#6f42c1',
                'is_active' => true,
            ],
            [
                'name_en' => 'Workshop',
                'name_km' => 'វគ្គសិក្សា',
                'description_en' => 'Workshops and training sessions',
                'description_km' => '�គ្គសិក្សា និងវគ្គសិក្សាការបណ្តុះបណ្តាល',
                'color' => '#fd7e14',
                'is_active' => true,
            ],
            [
                'name_en' => 'Moot Court',
                'name_km' => 'តុលាការមិនពិត',
                'description_en' => 'Moot court competitions and activities',
                'description_km' => 'ការប្រកួតប្រជួនតុលាការមិនពិត និងសកម្មភាព',
                'color' => '#20c997',
                'is_active' => true,
            ],
            [
                'name_en' => 'Alumni',
                'name_km' => 'និស្សិតចាស់',
                'description_en' => 'Alumni news and achievements',
                'description_km' => 'ព័ត៌មាន និងសមិទ្ធិផលរបស់និស្សិតចាស់',
                'color' => '#6c757d',
                'is_active' => true,
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create(array_merge($tag, ['slug' => Str::slug($tag['name_en'])]));
        }
    }
}
