<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'name_en' => 'Legal Aid Clinic',
                'name_km' => 'គ្រឹះស្ថានជំនួយច្បាប់',
                'description_en' => 'A community outreach program providing free legal assistance to underserved populations in Cambodia.',
                'description_km' => 'កម្មវិធីចេញទៅសហគមន៍ផ្តល់ជំនួយច្បាប់ឥតគិតថ្លៃដល់ប្រជាជនក្រីក្រនៅកម្ពុជា។',
                'objectives_en' => 'Provide free legal aid to low-income communities, educate citizens about their legal rights, and train law students in practical legal skills.',
                'objectives_km' => 'ផ្តល់ជំនួយច្បាប់ឥតគិតថ្លៃដល់សហគមន៍មានប្រាក់ចំណូលទាប បង្រៀនប្រជាជនអំពីសិទ្ធិច្បាប់របស់ពួកគេ និងហ្វឹកហ្វឺននិស្សិតច្បាប់ក្នុងជំនាញច្បាប់ប្រើប្រាស់។',
                'type' => 'research_project',
                'status' => 'active',
                'start_date' => '2025-01-15',
                'end_date' => '2026-12-31',
            ],
            [
                'name_en' => 'Human Rights Watch',
                'name_km' => 'ការតាមដានសិទ្ធិមនុស្ស',
                'description_en' => 'A research initiative monitoring human rights conditions and advocating for policy changes in Cambodia.',
                'description_km' => 'កម្មវិធីស្រាវជ្រាវតាមដានស្ថានភាពសិទ្ធិមនុស្ស និងទាមទារកំណែទម្រង់គោលនយោបាយនៅកម្ពុជា។',
                'objectives_en' => 'Monitor human rights violations, document cases, and advocate for legal reforms to protect citizen rights.',
                'objectives_km' => 'តាមដានការរំលំសិទ្ធិមនុស្ស កត់ត្រាករណី និងទាមទារកំណែទម្រង់ច្បាប់ដើម្បីការពារសិទ្ធិពលរដ្ឋ។',
                'type' => 'research_project',
                'status' => 'active',
                'start_date' => '2025-03-01',
                'end_date' => '2026-02-28',
            ],
            [
                'name_en' => 'Debate Club',
                'name_km' => 'ក្រុមជជែក',
                'description_en' => 'A student-led club promoting critical thinking and public speaking skills through legal debates.',
                'description_km' => 'ក្រុមនិស្សិតលើការលើក និងជំនាញនិយាយសាធ តាមរយៈការជជែកច្បាប់។',
                'objectives_en' => 'Develop students debate and argumentation skills, organize inter-university debate competitions.',
                'objectives_km' => 'អភិវឌ្ឍជំនាញជជែក និងការទាយយល់របស់និស្សិត រៀបចំការប្រកួតជជែកbetweenuniversities.',
                'type' => 'club',
                'status' => 'active',
                'start_date' => '2024-09-01',
                'end_date' => null,
            ],
            [
                'name_en' => 'Environmental Law Research',
                'name_km' => 'ស្រាវជ្រាវច្បាប់បរិស្ថាន',
                'description_en' => 'Research project examining Cambodian environmental laws and their effectiveness in protecting natural resources.',
                'description_km' => 'កម្មវិធីស្រាវជ្រាវសង្កេតច្បាប់បរិស្ថានកម្ពុជា និងប្រសិទ្ធភាពរបស់វាក្នុងការការពារធនធានធម្មជាតិ។',
                'objectives_en' => 'Analyze existing environmental legislation, identify gaps, and propose recommendations for stronger environmental protection.',
                'objectives_km' => 'វិភាគច្បាប់បរិស្ថានដែលមាន រកចេញកន្លែងទទេ និងផ្តល់អនុសាសន៍សម្រាប់ការពារបរិស្ថាន។',
                'type' => 'research_project',
                'status' => 'active',
                'start_date' => '2025-06-01',
                'end_date' => '2026-05-31',
            ],
            [
                'name_en' => 'Legal Writing Center',
                'name_km' => 'មជ្ឈមណ្ឌលសរសេរច្បាប់',
                'description_en' => 'A center dedicated to improving legal writing skills among law students and practitioners.',
                'description_km' => 'មជ្ឈមណ្ឌលលើកកម្ពស់ជំនាញសរសេរច្បាប់សម្រាប់និស្សិតច្បាប់និងអ្នកប្រតិបត្តិច្បាប់។',
                'objectives_en' => 'Provide workshops and resources for legal document drafting, contract writing, and academic legal writing.',
                'objectives_km' => 'ផ្តល់សិក្ខារកិច្ច និងធនធានសម្រាប់ការសរសេរឯកសារច្បាប់ ការសរសេរកិច្ចសន្យា និងការសរសេរច្បាប់សាកល។',
                'type' => 'academic_project',
                'status' => 'active',
                'start_date' => '2025-02-15',
                'end_date' => null,
            ],
            [
                'name_en' => 'Moot Court Club',
                'name_km' => 'ក្រុមតុលាការមិនពិត',
                'description_en' => 'A club preparing students for moot court competitions and developing advocacy skills.',
                'description_km' => 'ក្រុមរៀបចំនិស្សិតសម្រាប់ការប្រកួតតុលាការមិនពិត និងអភិវឌ្ឍជំនាញការពារ។',
                'objectives_en' => 'Train students in courtroom advocacy, organize internal moot court competitions, and select teams for international competitions.',
                'objectives_km' => 'ហ្វឹកហ្វឺននិស្សិតក្នុងការពារតុលាការ រៀបចំការប្រកួតតុលាការមិនពិតផ្ទៃក្នុង និងជ្រើសរើសក្រុមសម្រាប់ការប្រកួតអន្តរជាតិ។',
                'type' => 'club',
                'status' => 'active',
                'start_date' => '2024-01-01',
                'end_date' => null,
            ],
            [
                'name_en' => 'Legal Technology Lab',
                'name_km' => 'បច្ចេកវិទ្យាច្បាប់',
                'description_en' => 'An innovative project exploring the intersection of law and technology in legal practice.',
                'description_km' => 'គ្រប់គ្រងការស្រាវជ្រាវ និងអភិវឌ្ឍបច្ចេកវិទ្យាក្នុងវិស័យច្បាប់។',
                'objectives_en' => 'Research legal tech solutions, develop tools for legal research, and train students in law firm technology.',
                'objectives_km' => 'ស្រាវជ្រាវដំណោះស្រាយបច្ចេកវិទ្យាច្បាប់ អភិវឌ្ឍឧបករណ៍សម្រាប់ការស្រាវជ្រាវច្បាប់ និងហ្វឹកហ្វឺននិស្សិតក្នុងបច្ចេកវិទ្យាច្បាប់។',
                'type' => 'academic_project',
                'status' => 'active',
                'start_date' => '2025-09-01',
                'end_date' => '2027-08-31',
            ],
            [
                'name_en' => 'Community Outreach Program',
                'name_km' => 'កម្មវិធីចេញទៅសហគមន៍',
                'description_en' => 'A program bringing law students to rural communities to provide legal education and assistance.',
                'description_km' => 'កម្មវិធីនេះនាំយកនិស្សិតច្បាប់ទៅសហគមន៍ជនបទដើម្បីផ្តល់ការអប់រំច្បាប់ និងជំនួយ។',
                'objectives_en' => 'Educate rural communities about legal rights, provide basic legal advice, and develop students civic engagement.',
                'objectives_km' => 'បង្រៀនសហគមន៍ជនបទអំពីសិទ្ធិច្បាប់ ផ្តល់ដេីមច្បាប់ និងអភិវឌ្ឍចូលរួមរបស់និស្សិត។',
                'type' => 'research_project',
                'status' => 'completed',
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
            ],
            [
                'name_en' => 'International Law Symposium',
                'name_km' => 'សន្និសីទច្បាប់អន្តរជាតិ',
                'description_en' => 'An annual symposium bringing together international legal scholars to discuss contemporary issues.',
                'description_km' => 'សន្និសីទប្រចាំឆ្នាំដែលប្រមូលផ្តុំអ្នកស្រាវជ្រាវច្បាប់អន្តរជាតិដើម្បីពិភាក្សាអំពីបញ្ហាសព្វថ្ងៃ។',
                'objectives_en' => 'Foster international academic exchange, publish research findings, and build networks with foreign universities.',
                'objectives_km' => 'លើកកម្ពស់ការផ្លាស់ប្តូរបទពិសេសអន្តរជាតិ បោះពុម្ពលទ្ធផលស្រាវជ្រាវ និងកសាងប�្តាញជាមួយសាកលវិទ្យាល័យបរទេស។',
                'type' => 'academic_project',
                'status' => 'completed',
                'start_date' => '2024-03-15',
                'end_date' => '2024-03-17',
            ],
        ];

        $supervisor = User::first();
        $leader = User::skip(1)->first();

        foreach ($projects as $project) {
            Project::create(array_merge($project, [
                'slug' => Str::slug($project['name_en']),
                'supervisor_id' => $supervisor?->id,
                'leader_id' => $leader?->id,
            ]));
        }
    }
}
