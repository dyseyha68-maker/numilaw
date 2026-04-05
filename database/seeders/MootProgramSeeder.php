<?php

namespace Database\Seeders;

use App\Models\Moot;
use App\Models\MootParticipation;
use App\Models\MootActivity;
use App\Models\MootTeam;
use App\Models\MootTeamMember;
use Illuminate\Database\Seeder;

class MootProgramSeeder extends Seeder
{
    public function run(): void
    {
        $moots = [
            [
                'name_en' => 'Philip C. Jessup International Law Moot Court Competition',
                'name_km' => 'ការប្រកួតច្បាប់អន្9រជាតិ Jessup',
                'slug' => 'jessup',
                'short_name' => 'Jessup',
                'acronym' => 'ILSA',
                'description_en' => 'The Philip C. Jessup International Law Moot Court Competition is the world\'s largest moot court competition, attracting students from over 700 law schools in more than 100 countries.',
                'description_km' => 'ការប្រកួត Jessup គឺជាការប្រកួតច្បាប់ធំបំផុតលើពិភពលោក។',
                'official_url' => 'https://www.ilsa.org/jessup/',
                'organizing_body_en' => 'International Law Students Association (ILSA)',
                'organizing_body_km' => 'សមាគមនិស្9',
                'logo_path' => 'images/moots/jessup.png',
                'case_file_path' => 'files/moots/jessup-2024-case.pdf',
                'first_participation_year' => 2018,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'name_en' => 'Willem C. Vis International Commercial Arbitration Moot',
                'name_km' => 'Vis Moot វីយែន',
                'slug' => 'vis-moot',
                'short_name' => 'Vis Moot',
                'acronym' => 'CISG',
                'description_en' => 'One of the world\'s leading moot court competitions in international commercial arbitration and the UN Convention on Contracts for the International Sale of Goods.',
                'description_km' => 'ការប្រកួត moot ពាណិជ្ជកម្ម',
                'official_url' => 'https://www.cisgmoot.org/',
                'organizing_body_en' => 'Center for International Arbitration',
                'logo_path' => 'images/moots/vis-moot.png',
                'case_file_path' => 'files/moots/vis-2024-case.pdf',
                'first_participation_year' => 2020,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'name_en' => 'FDI International Arbitration Moot',
                'name_km' => 'FDI Moot',
                'slug' => 'fdi-moot',
                'short_name' => 'FDI Moot',
                'acronym' => 'CCI',
                'description_en' => 'Simulates an investor-state arbitration case under the UNCITRAL Arbitration Rules.',
                'description_km' => 'FDI Moot ស្របគំនិតវិវាទ',
                'official_url' => 'https://www.fdimoot.org/',
                'organizing_body_en' => 'Center for International Investment and Commercial Arbitration',
                'logo_path' => 'images/moots/fdi-moot.png',
                'case_file_path' => 'files/moots/fdi-2024-case.pdf',
                'first_participation_year' => 2022,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 3,
            ],
            [
                'name_en' => 'Jean-Pictet Competition',
                'name_km' => 'ការប្រកួត Jean-Pictet',
                'slug' => 'jean-pictet',
                'short_name' => 'Jean-Pictet',
                'acronym' => 'IHL',
                'description_en' => 'The Jean-Pictet Competition is the leading competition in international humanitarian law.',
                'description_km' => 'ការប្រកួត Jean-Pictet ជា',
                'official_url' => 'https://www.jeanpictet.com/',
                'organizing_body_en' => 'International Committee of the Red Cross',
                'logo_path' => 'images/moots/jean-pictet.png',
                'case_file_path' => 'files/moots/jean-pictet-2024-case.pdf',
                'first_participation_year' => 2019,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 4,
            ],
            [
                'name_en' => 'Telders International Law Moot Court Competition',
                'name_km' => 'Telders Moot',
                'slug' => 'telders-moot',
                'short_name' => 'Telders',
                'acronym' => 'Telders',
                'description_en' => 'Annual international law moot court competition organized by the Telders International Law Moot Court Competition.',
                'description_km' => 'ការប្រកួត Telders',
                'official_url' => 'https://www.telders.org/',
                'organizing_body_en' => 'Telders Foundation',
                'logo_path' => 'images/moots/telders.png',
                'case_file_path' => 'files/moots/telders-2024-case.pdf',
                'first_participation_year' => 2021,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 5,
            ],
            [
                'name_en' => 'Nelson Mandela World Human Rights Moot Court Competition',
                'name_km' => 'Nelson Mandela Moot',
                'slug' => 'nelson-mandela',
                'short_name' => 'Nelson Mandela',
                'acronym' => 'HR',
                'description_en' => 'The Nelson Mandela World Human Rights Moot Court Competition is an annual event that simulates a hypothetical case before the Human Rights Committee.',
                'description_km' => 'ការប្រកួត Nelson Mandela',
                'official_url' => 'https://www.nelsonmundel.com/',
                'organizing_body_en' => 'Center for Human Rights, University of Pretoria',
                'logo_path' => 'images/moots/nelson-mandela.png',
                'case_file_path' => 'files/moots/nelson-2024-case.pdf',
                'first_participation_year' => 2020,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 6,
            ],
            [
                'name_en' => 'Monroe E. Price Media Law Moot Court Competition',
                'name_km' => 'Price Media Law Moot',
                'slug' => 'price-media-law',
                'short_name' => 'Price Moot',
                'acronym' => 'Media',
                'description_en' => 'The Price Moot focuses on media law and freedom of expression issues.',
                'description_km' => 'Price Media Law Moot',
                'official_url' => 'https:// pricemooc.org/',
                'organizing_body_en' => 'Oxford University',
                'logo_path' => 'images/moots/price-moot.png',
                'case_file_path' => 'files/moots/price-2024-case.pdf',
                'first_participation_year' => 2021,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 7,
            ],
            [
                'name_en' => 'International Criminal Court Moot Court Competition',
                'name_km' => 'ICC Moot',
                'slug' => 'icc-moot',
                'short_name' => 'ICC Moot',
                'acronym' => 'ICC',
                'description_en' => 'The ICC Moot Court Competition simulates proceedings before the International Criminal Court.',
                'description_km' => 'ICC Moot',
                'official_url' => 'https://www.iccmoot.org/',
                'organizing_body_en' => 'Leiden University',
                'logo_path' => 'images/moots/icc-moot.png',
                'case_file_path' => 'files/moots/icc-2024-case.pdf',
                'first_participation_year' => 2020,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 8,
            ],
            [
                'name_en' => 'John H. Jackson WTO Moot Court Competition',
                'name_km' => 'WTO Moot',
                'slug' => 'wto-moot',
                'short_name' => 'WTO Moot',
                'acronym' => 'WTO',
                'description_en' => 'The John H. Jackson WTO Moot Court Competition simulates WTO dispute settlement proceedings.',
                'description_km' => 'WTO Moot',
                'official_url' => 'https://www.wto.org/',
                'organizing_body_en' => 'World Trade Organization',
                'logo_path' => 'images/moots/wto-moot.png',
                'case_file_path' => 'files/moots/wto-2024-case.pdf',
                'first_participation_year' => 2019,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 9,
            ],
            [
                'name_en' => 'International Maritime Law Arbitration Moot',
                'name_km' => 'IMLAM',
                'slug' => 'maritime-moot',
                'short_name' => 'IMLAM',
                'acronym' => 'IMLAM',
                'description_en' => 'The International Maritime Law Arbitration Moot is a competition focused on maritime law.',
                'description_km' => 'IMLAM',
                'official_url' => 'https://www.imlam.org/',
                'organizing_body_en' => 'International Maritime Law Arbitration',
                'logo_path' => 'images/moots/imlam.png',
                'case_file_path' => 'files/moots/imlam-2024-case.pdf',
                'first_participation_year' => 2021,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 10,
            ],
            [
                'name_en' => 'International Commercial Mediation Competition',
                'name_km' => 'Mediation Competition',
                'slug' => 'mediation-competition',
                'short_name' => 'Mediation',
                'acronym' => 'ICC',
                'description_en' => 'The International Commercial Mediation Competition is organized by the ICC.',
                'description_km' => 'ការប្រកួត',
                'official_url' => 'https://www.iccwbo.org/',
                'organizing_body_en' => 'International Chamber of Commerce',
                'logo_path' => 'images/moots/mediation.png',
                'case_file_path' => 'files/moots/mediation-2024-case.pdf',
                'first_participation_year' => 2022,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 11,
            ],
            [
                'name_en' => 'Asia Cup International Law Moot Court Competition',
                'name_km' => 'Asia Cup Moot',
                'slug' => 'asia-cup-moot',
                'short_name' => 'Asia Cup',
                'acronym' => 'AsiaCup',
                'description_en' => 'The Asia Cup is a regional moot court competition for Asian law schools.',
                'description_km' => 'Asia Cup',
                'official_url' => 'https://www.asiacupmoot.org/',
                'organizing_body_en' => 'Asia Pacific Law Association',
                'logo_path' => 'images/moots/asia-cup.png',
                'case_file_path' => 'files/moots/asia-cup-2024-case.pdf',
                'first_participation_year' => 2020,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 12,
            ],
            [
                'name_en' => 'Asian Law Students\' Association Moot Court Competition',
                'name_km' => 'ALSA Moot',
                'slug' => 'alsa-moot',
                'short_name' => 'ALSA Moot',
                'acronym' => 'ALSA',
                'description_en' => 'ALSA Moot Court Competition is organized by the Asian Law Students\' Association.',
                'description_km' => 'ALSA Moot',
                'official_url' => 'https://www.alsa.org/',
                'organizing_body_en' => 'Asian Law Students\' Association',
                'logo_path' => 'images/moots/alsa.png',
                'case_file_path' => 'files/moots/alsa-2024-case.pdf',
                'first_participation_year' => 2019,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 13,
            ],
            [
                'name_en' => 'Red Cross Asia-Pacific Moot Court Competition',
                'name_km' => 'Red Cross Moot',
                'slug' => 'red-cross-moot',
                'short_name' => 'Red Cross Moot',
                'acronym' => 'RC',
                'description_en' => 'The Red Cross Asia-Pacific Moot focuses on international humanitarian law.',
                'description_km' => 'Red Cross Moot',
                'official_url' => 'https://www.redcross.org/',
                'organizing_body_en' => 'International Committee of the Red Cross',
                'logo_path' => 'images/moots/red-cross.png',
                'case_file_path' => 'files/moots/red-cross-2024-case.pdf',
                'first_participation_year' => 2021,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 14,
            ],
            [
                'name_en' => 'ASEAN Law Moot Court Competition',
                'name_km' => 'ASEAN Moot',
                'slug' => 'asean-moot',
                'short_name' => 'ASEAN Moot',
                'acronym' => 'ASEAN',
                'description_en' => 'The ASEAN Law Moot Court Competition focuses on ASEAN legal frameworks.',
                'description_km' => 'ASEAN Moot',
                'official_url' => 'https://www.asean.org/',
                'organizing_body_en' => 'ASEAN Law Initiative',
                'logo_path' => 'images/moots/asean.png',
                'case_file_path' => 'files/moots/asean-2024-case.pdf',
                'first_participation_year' => 2020,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 15,
            ],
            [
                'name_en' => 'Space Law Moot Court Competition',
                'name_km' => 'Space Law Moot',
                'slug' => 'space-law-moot',
                'short_name' => 'Space Law Moot',
                'acronym' => 'Space',
                'description_en' => 'The Space Law Moot Court Competition focuses on international space law.',
                'description_km' => 'Space Law Moot',
                'official_url' => 'https://www.space.com/',
                'organizing_body_en' => 'International Space Law Institute',
                'logo_path' => 'images/moots/space-law.png',
                'case_file_path' => 'files/moots/space-2024-case.pdf',
                'first_participation_year' => 2022,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 16,
            ],
            [
                'name_en' => 'International Environmental Law Moot Court Competition',
                'name_km' => 'Environmental Law Moot',
                'slug' => 'environment-moot',
                'short_name' => 'Env Law Moot',
                'acronym' => 'Env',
                'description_en' => 'The International Environmental Law Moot Court Competition focuses on environmental law.',
                'description_km' => 'Environmental Law Moot',
                'official_url' => 'https://www.unep.org/',
                'organizing_body_en' => 'United Nations Environment Programme',
                'logo_path' => 'images/moots/environment.png',
                'case_file_path' => 'files/moots/environment-2024-case.pdf',
                'first_participation_year' => 2023,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 17,
            ],
            [
                'name_en' => 'International Tax Moot Court Competition',
                'name_km' => 'Tax Moot',
                'slug' => 'tax-moot',
                'short_name' => 'Tax Moot',
                'acronym' => 'Tax',
                'description_en' => 'The International Tax Moot Court Competition focuses on international taxation.',
                'description_km' => 'Tax Moot',
                'official_url' => 'https://www.oecd.org/',
                'organizing_body_en' => 'International Fiscal Association',
                'logo_path' => 'images/moots/tax-moot.png',
                'case_file_path' => 'files/moots/tax-2024-case.pdf',
                'first_participation_year' => 2023,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 18,
            ],
            [
                'name_en' => 'Cambodia National Moot Court Competition',
                'name_km' => 'Cambodia Moot',
                'slug' => 'cambodia-moot',
                'short_name' => 'Cambodia Moot',
                'acronym' => 'CNCC',
                'description_en' => 'The Cambodia National Moot Court Competition is a domestic moot competition.',
                'description_km' => 'ការប្រកួត',
                'official_url' => 'https://www.moj.gov.kh/',
                'organizing_body_en' => 'Ministry of Justice Cambodia',
                'logo_path' => 'images/moots/cambodia-moot.png',
                'case_file_path' => 'files/moots/cambodia-2024-case.pdf',
                'first_participation_year' => 2017,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 19,
            ],
            [
                'name_en' => 'University Inter-Faculty Moot Court Competition',
                'name_km' => 'Inter-Faculty Moot',
                'slug' => 'inter-faculty-moot',
                'short_name' => 'Inter-Faculty',
                'acronym' => 'IFM',
                'description_en' => 'The Inter-Faculty Moot Court Competition brings together law students from different universities.',
                'description_km' => 'ការប្រកួត',
                'official_url' => '',
                'organizing_body_en' => 'Various Universities',
                'logo_path' => 'images/moots/inter-faculty.png',
                'case_file_path' => 'files/moots/inter-faculty-2024-case.pdf',
                'first_participation_year' => 2016,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 20,
            ],
        ];

        foreach ($moots as $index => $mootData) {
            // Check if moot already exists
            $existingMoot = Moot::where('slug', $mootData['slug'])->first();
            if ($existingMoot) {
                // Skip Vis Moot as we create it separately with full history
                if ($mootData['slug'] === 'vis-moot') {
                    continue;
                }
                continue;
            }
            
            $moot = Moot::create($mootData);

            $recentYear = 2024 - rand(0, 2);
            
            $participation = MootParticipation::create([
                'moot_id' => $moot->id,
                'year' => $recentYear,
                'theme_en' => 'Annual Competition Theme - International Law Dispute',
                'case_problem_en' => 'Hypothetical dispute regarding international law issues between two fictional states before the International Court of Justice.',
                'competition_start_date' => $recentYear . '-03-15',
                'competition_end_date' => $recentYear . '-03-20',
                'venue' => 'International Convention Center',
                'host_city' => 'Various',
                'host_country' => 'International',
                'status' => 'completed',
                'summary_en' => 'Our team represented the Royal University of Law and Economics in the ' . $mootData['name_en'] . ' ' . $recentYear . '. This competition provided valuable experience in international law advocacy.',
                'is_published' => true,
                'result_en' => $recentYear >= 2023 ? 'Quarterfinalist' : 'Preliminary Round',
            ]);

            $team = MootTeam::create([
                'participation_id' => $participation->id,
                'team_name' => 'Royal University of Law and Economics',
                'team_name_local' => 'សាកលវិទ្យាល័យ',
                'coach_name' => 'Dr. Soksamnang Kheang',
                'coach_email' => 'coach@rule.edu.kh',
                'coach_image' => 'images/moots/coaches/coach-1.jpg',
                'advisor_name' => 'Prof. Chamnap Pheng',
                'advisor_image' => 'images/moots/advisors/advisor-1.jpg',
                'mentor_name' => 'Dr. Ly Sreypich',
                'mentor_image' => 'images/moots/mentors/mentor-1.jpg',
                'team_type' => 'main',
                'round_reached' => $recentYear >= 2023 ? 3 : 1,
                'result_en' => $recentYear >= 2023 ? 'Quarterfinalist' : 'Participant',
                'awards_en' => $recentYear >= 2023 ? 'Best Oralist - Student Name' : '',
                'display_order' => 1,
            ]);

            MootTeamMember::create([
                'team_id' => $team->id,
                'name_en' => 'Sokha Meth',
                'name_km' => 'សុខ៉ មេត',
                'email' => 'sokha.meth@student.edu.kh',
                'role' => 'speaker',
                'order' => 1,
                'is_team_lead' => true,
                'image' => 'images/moots/mooters/mooter-1.jpg',
            ]);

            MootTeamMember::create([
                'team_id' => $team->id,
                'name_en' => 'Vutha Soth',
                'name_km' => 'វ៉ុត សោថ',
                'email' => 'vutha.soth@student.edu.kh',
                'role' => 'speaker',
                'order' => 2,
                'image' => 'images/moots/mooters/mooter-2.jpg',
            ]);

            MootTeamMember::create([
                'team_id' => $team->id,
                'name_en' => 'Srey Mao',
                'name_km' => 'ស្រីម៉ៅ',
                'email' => 'srey.mao@student.edu.kh',
                'role' => 'researcher',
                'order' => 3,
                'image' => 'images/moots/researchers/researcher-1.jpg',
            ]);

            MootTeamMember::create([
                'team_id' => $team->id,
                'name_en' => 'Kimsreang Kol',
                'name_km' => 'គ្រីស្រែ',
                'email' => 'kimsreang@student.edu.kh',
                'role' => 'researcher',
                'order' => 4,
                'image' => 'images/moots/researchers/researcher-2.jpg',
            ]);

            MootTeamMember::create([
                'team_id' => $team->id,
                'name_en' => 'Pich Sreypov',
                'name_km' => 'ប៉ុក ស្រី',
                'email' => 'pich@student.edu.kh',
                'role' => 'reserve',
                'order' => 5,
                'image' => 'images/moots/mooters/mooter-3.jpg',
            ]);

            $activities = [
                ['title_en' => 'Team Formation & Registration', 'activity_type' => 'announcement', 'order' => 1, 'is_completed' => true, 'activity_date' => $recentYear . '-01-05', 'description_en' => 'Official team registration and formation'],
                ['title_en' => 'Case Problem Release', 'activity_type' => 'announcement', 'order' => 2, 'is_completed' => true, 'activity_date' => $recentYear . '-01-15', 'description_en' => 'Official case problem released by organizing committee'],
                ['title_en' => 'Legal Research Training', 'activity_type' => 'training', 'order' => 3, 'is_completed' => true, 'activity_date' => $recentYear . '-01-20', 'description_en' => 'Intensive legal research methodology workshop'],
                ['title_en' => 'Writing Workshop - Memorial Drafting', 'activity_type' => 'training', 'order' => 4, 'is_completed' => true, 'activity_date' => $recentYear . '-02-01', 'description_en' => 'Workshop on drafting memorials and legal memoranda'],
                ['title_en' => 'Oral Advocacy Training', 'activity_type' => 'training', 'order' => 5, 'is_completed' => true, 'activity_date' => $recentYear . '-02-10', 'description_en' => 'Oral presentation and argument techniques training'],
                ['title_en' => 'Practice Session I - Internal', 'activity_type' => 'training', 'order' => 6, 'is_completed' => true, 'activity_date' => $recentYear . '-02-15', 'description_en' => 'Internal practice round with feedback'],
                ['title_en' => 'Practice Session II - External', 'activity_type' => 'training', 'order' => 7, 'is_completed' => true, 'activity_date' => $recentYear . '-02-22', 'description_en' => 'Practice round against other universities'],
                ['title_en' => 'Memorial Submission Deadline', 'activity_type' => 'submission', 'order' => 8, 'is_completed' => true, 'activity_date' => $recentYear . '-02-28', 'description_en' => 'Final submission of written memorials'],
                ['title_en' => 'Team Preparation Camp', 'activity_type' => 'training', 'order' => 9, 'is_completed' => true, 'activity_date' => $recentYear . '-03-05', 'description_en' => 'Intensive pre-competition preparation'],
                ['title_en' => 'Preliminary Rounds - Day 1', 'activity_type' => 'preliminary', 'order' => 10, 'is_completed' => true, 'activity_date' => $recentYear . '-03-15', 'description_en' => 'First day of oral arguments'],
                ['title_en' => 'Preliminary Rounds - Day 2', 'activity_type' => 'preliminary', 'order' => 11, 'is_completed' => true, 'activity_date' => $recentYear . '-03-16', 'description_en' => 'Second day of oral arguments'],
                ['title_en' => 'Quarterfinal Round', 'activity_type' => 'quarterfinal', 'order' => 12, 'is_completed' => $recentYear >= 2023, 'activity_date' => $recentYear . '-03-17', 'description_en' => 'Quarterfinal knockout round'],
                ['title_en' => 'Semifinal Round', 'activity_type' => 'semifinal', 'order' => 13, 'is_completed' => false, 'activity_date' => $recentYear . '-03-18', 'description_en' => 'Semifinal knockout round'],
                ['title_en' => 'Final Round & Awards Ceremony', 'activity_type' => 'final', 'order' => 14, 'is_completed' => false, 'activity_date' => $recentYear . '-03-20', 'description_en' => 'Championship round and prize distribution'],
            ];

            foreach ($activities as $activity) {
                MootActivity::create(array_merge($activity, ['participation_id' => $participation->id]));
            }

            if (in_array($index, [0, 2, 3])) {
                $previousYear = $recentYear - 1;
                
                $prevParticipation = MootParticipation::create([
                    'moot_id' => $moot->id,
                    'year' => $previousYear,
                    'theme_en' => 'Previous Year Theme',
                    'case_problem_en' => 'Case problem for ' . $previousYear,
                    'competition_start_date' => $previousYear . '-03-15',
                    'competition_end_date' => $previousYear . '-03-20',
                    'venue' => 'Various Locations',
                    'host_country' => 'International',
                    'status' => 'completed',
                    'is_published' => true,
                    'result_en' => 'Preliminary Round',
                ]);

                $prevTeam = MootTeam::create([
                    'participation_id' => $prevParticipation->id,
                    'team_name' => 'Royal University of Law and Economics',
                    'coach_name' => 'Prof. Chamnap Pheng',
                    'coach_email' => 'chamnap@rule.edu.kh',
                    'coach_image' => 'images/moots/coaches/coach-2.jpg',
                    'advisor_name' => 'Dr. Ly Sreypich',
                    'advisor_image' => 'images/moots/advisors/advisor-2.jpg',
                    'team_type' => 'main',
                    'round_reached' => 1,
                    'display_order' => 1,
                ]);

                MootTeamMember::create([
                    'team_id' => $prevTeam->id,
                    'name_en' => 'Kong Vichea',
                    'email' => 'vichea@student.edu.kh',
                    'role' => 'speaker',
                    'order' => 1,
                    'is_team_lead' => true,
                ]);

                MootTeamMember::create([
                    'team_id' => $prevTeam->id,
                    'name_en' => 'Narin Jany',
                    'email' => 'narin@student.edu.kh',
                    'role' => 'speaker',
                    'order' => 2,
                ]);

                MootTeamMember::create([
                    'team_id' => $prevTeam->id,
                    'name_en' => 'Hour Serey',
                    'email' => 'hour@student.edu.kh',
                    'role' => 'researcher',
                    'order' => 3,
                ]);

                foreach ($activities as $activity) {
                    MootActivity::create(array_merge($activity, [
                        'participation_id' => $prevParticipation->id,
                        'activity_date' => str_replace((string)$recentYear, (string)$previousYear, $activity['activity_date']),
                    ]));
                }
            }
        }

        // Create Vis Moot with full history from 2019-2025
        $visMoot = Moot::where('slug', 'vis-moot')->first();
        if ($visMoot) {
            $this->createVisMootParticipation($visMoot, 2025);
            $this->createVisMootParticipation($visMoot, 2024);
            $this->createVisMootParticipation($visMoot, 2023);
            $this->createVisMootParticipation($visMoot, 2022);
            $this->createVisMootParticipation($visMoot, 2021);
            $this->createVisMootParticipation($visMoot, 2020);
            $this->createVisMootParticipation($visMoot, 2019);
        }
    }

    private function createVisMootParticipation(Moot $moot, int $year): void
    {
        // Check if participation already exists
        $existing = MootParticipation::where('moot_id', $moot->id)->where('year', $year)->first();
        if ($existing) {
            return;
        }
        
        $results = [
            2025 => ['result' => 'Quarterfinalist', 'round' => 3, 'awards' => 'Best Oralist - Meas Seanglong'],
            2024 => ['result' => 'Quarterfinalist', 'round' => 3, 'awards' => 'Best Memorandum - Team'],
            2023 => ['result' => 'Semifinalist', 'round' => 4, 'awards' => 'Best Oralist'],
            2022 => ['result' => 'Quarterfinalist', 'round' => 3, 'awards' => ''],
            2021 => ['result' => 'Preliminary Round', 'round' => 1, 'awards' => ''],
            2020 => ['result' => 'Participant', 'round' => 1, 'awards' => ''],
            2019 => ['result' => 'Participant', 'round' => 1, 'awards' => ''],
        ];

        $themes = [
            2025 => 'CISG and International Sale of Goods',
            2024 => 'International Commercial Arbitration and CISG',
            2023 => 'Sale of Goods and Payment Obligations',
            2022 => 'Contract Formation and Breach',
            2021 => 'Electronic Commerce and CISG',
            2020 => 'International Sales and Arbitration',
            2019 => 'CISG and International Trade Law',
        ];

        $coachNames = ['Dr. Soksamnang Kheang', 'Prof. Chamnap Pheng', 'Dr. Ly Sreypich', 'Prof. Sotheara Lay'];
        $studentNames = [
            ['Meas Seanglong', 'Sokha Meth', 'Vutha Soth', 'Srey Mao', 'Kimsreang Kol'],
            ['Kong Vichea', 'Pich Sreypov', 'Narin Jany', 'Hour Serey', 'Veasna Ly'],
            ['Sotheara Chhay', 'Sokha Meth', 'Vutha Soth', 'Srey Mao', 'Kimsreang Kol'],
            ['Chandara Soung', 'Kong Vichea', 'Pich Sreypov', 'Narin Jany', 'Raksa Thuy'],
            ['Sokha Meth', 'Vutha Soth', 'Srey Mao', 'Kimsreang Kol', 'Pich Sreypov'],
            ['Kong Vichea', 'Pich Sreypov', 'Narin Jany', 'Hour Serey', 'Veasna Ly'],
            ['Sotheara Chhay', 'Rithy Seng', 'Chandara Soung', 'Kong Vichea', 'Pich Sreypov'],
        ];

        $coachImages = ['coach-1.jpg', 'coach-2.jpg', 'coach-3.jpg', 'coach-4.jpg'];
        $memberImages = ['mooter-1.jpg', 'mooter-2.jpg', 'mooter-3.jpg', 'researcher-1.jpg', 'researcher-2.jpg'];

        $participation = MootParticipation::create([
            'moot_id' => $moot->id,
            'year' => $year,
            'theme_en' => $themes[$year],
            'case_problem_en' => "Hypothetical dispute regarding $themes[$year] under the CISG and UNCITRAL Arbitration Rules between two fictional parties.",
            'competition_start_date' => $year . '-04-11',
            'competition_end_date' => $year . '-04-18',
            'venue' => 'Vienna International Arbitration Center',
            'host_city' => 'Vienna',
            'host_country' => 'Austria',
            'status' => 'completed',
            'summary_en' => "Our team represented the Royal University of Law and Economics in the $year Willem C. Vis International Commercial Arbitration Moot in Vienna, Austria. This prestigious competition focuses on international commercial arbitration and the UN Convention on Contracts for the International Sale of Goods (CISG).",
            'is_published' => true,
            'result_en' => $results[$year]['result'],
        ]);

        $team = MootTeam::create([
            'participation_id' => $participation->id,
            'team_name' => 'Royal University of Law and Economics',
            'team_name_local' => 'សាកលវិទ្យាល័យ',
            'coach_name' => $coachNames[array_rand($coachNames)],
            'coach_email' => 'coach@rule.edu.kh',
            'coach_image' => 'images/moots/coaches/' . $coachImages[array_rand($coachImages)],
            'advisor_name' => 'Prof. Chamnap Pheng',
            'advisor_image' => 'images/moots/advisors/advisor-1.jpg',
            'mentor_name' => 'Dr. Ly Sreypich',
            'mentor_image' => 'images/moots/mentors/mentor-1.jpg',
            'team_type' => 'main',
            'round_reached' => $results[$year]['round'],
            'result_en' => $results[$year]['result'],
            'awards_en' => $results[$year]['awards'],
            'display_order' => 1,
        ]);

        $names = $studentNames[array_rand($studentNames)];
        
        MootTeamMember::create([
            'team_id' => $team->id,
            'name_en' => $names[0],
            'email' => strtolower($names[0]) . '@student.edu.kh',
            'role' => 'speaker',
            'order' => 1,
            'is_team_lead' => true,
            'image' => 'images/moots/mooters/' . $memberImages[0],
        ]);

        MootTeamMember::create([
            'team_id' => $team->id,
            'name_en' => $names[1],
            'email' => strtolower($names[1]) . '@student.edu.kh',
            'role' => 'speaker',
            'order' => 2,
            'image' => 'images/moots/mooters/' . $memberImages[1],
        ]);

        MootTeamMember::create([
            'team_id' => $team->id,
            'name_en' => $names[2],
            'email' => strtolower($names[2]) . '@student.edu.kh',
            'role' => 'researcher',
            'order' => 3,
            'image' => 'images/moots/researchers/' . $memberImages[2],
        ]);

        MootTeamMember::create([
            'team_id' => $team->id,
            'name_en' => $names[3],
            'email' => strtolower($names[3]) . '@student.edu.kh',
            'role' => 'researcher',
            'order' => 4,
            'image' => 'images/moots/researchers/' . $memberImages[3],
        ]);

        MootTeamMember::create([
            'team_id' => $team->id,
            'name_en' => $names[4],
            'email' => strtolower($names[4]) . '@student.edu.kh',
            'role' => 'reserve',
            'order' => 5,
            'image' => 'images/moots/mooters/' . $memberImages[4],
        ]);

        $activities = [
            ['title_en' => 'Team Registration & Formation', 'activity_type' => 'announcement', 'order' => 1, 'is_completed' => true, 'activity_date' => $year . '-01-10', 'description_en' => 'Official team registration and member selection'],
            ['title_en' => 'Case Problem Release', 'activity_type' => 'announcement', 'order' => 2, 'is_completed' => true, 'activity_date' => $year . '-01-15', 'description_en' => 'Official case problem released by the Vis Moot Committee'],
            ['title_en' => 'CISG Training Workshop', 'activity_type' => 'training', 'order' => 3, 'is_completed' => true, 'activity_date' => $year . '-01-20', 'description_en' => 'Intensive training on UN Convention on Contracts for the International Sale of Goods'],
            ['title_en' => 'Arbitration Law Fundamentals', 'activity_type' => 'training', 'order' => 4, 'is_completed' => true, 'activity_date' => $year . '-01-25', 'description_en' => 'Workshop on international arbitration principles and UNCITRAL rules'],
            ['title_en' => 'Legal Research Methodology', 'activity_type' => 'training', 'order' => 5, 'is_completed' => true, 'activity_date' => $year . '-02-01', 'description_en' => 'Advanced legal research techniques for moot court'],
            ['title_en' => 'Memorial Writing Workshop', 'activity_type' => 'training', 'order' => 6, 'is_completed' => true, 'activity_date' => $year . '-02-08', 'description_en' => 'Drafting written memorials and legal memoranda'],
            ['title_en' => 'Oral Advocacy Training I', 'activity_type' => 'training', 'order' => 7, 'is_completed' => true, 'activity_date' => $year . '-02-15', 'description_en' => 'First round of oral argument training'],
            ['title_en' => 'Oral Advocacy Training II', 'activity_type' => 'training', 'order' => 8, 'is_completed' => true, 'activity_date' => $year . '-02-22', 'description_en' => 'Advanced oral advocacy techniques'],
            ['title_en' => 'Practice Round - Internal', 'activity_type' => 'training', 'order' => 9, 'is_completed' => true, 'activity_date' => $year . '-03-01', 'description_en' => 'Internal practice session with faculty feedback'],
            ['title_en' => 'Practice Round - External', 'activity_type' => 'training', 'order' => 10, 'is_completed' => true, 'activity_date' => $year . '-03-05', 'description_en' => 'Practice against other universities in the region'],
            ['title_en' => 'Memorial Submission Deadline', 'activity_type' => 'submission', 'order' => 11, 'is_completed' => true, 'activity_date' => $year . '-03-10', 'description_en' => 'Final submission of Claimant and Respondent memorials'],
            ['title_en' => 'Pre-Competition Preparation Camp', 'activity_type' => 'training', 'order' => 12, 'is_completed' => true, 'activity_date' => $year . '-04-05', 'description_en' => 'Intensive pre-competition training in Vienna'],
            ['title_en' => 'Preliminary Rounds - Day 1', 'activity_type' => 'preliminary', 'order' => 13, 'is_completed' => true, 'activity_date' => $year . '-04-11', 'description_en' => 'First day of oral arguments in Vienna'],
            ['title_en' => 'Preliminary Rounds - Day 2', 'activity_type' => 'preliminary', 'order' => 14, 'is_completed' => true, 'activity_date' => $year . '-04-12', 'description_en' => 'Second day of oral arguments'],
            ['title_en' => 'Preliminary Rounds - Day 3', 'activity_type' => 'preliminary', 'order' => 15, 'is_completed' => true, 'activity_date' => $year . '-04-13', 'description_en' => 'Third day of oral arguments'],
            ['title_en' => 'Quarterfinal Round', 'activity_type' => 'quarterfinal', 'order' => 16, 'is_completed' => $results[$year]['round'] >= 3, 'activity_date' => $year . '-04-14', 'description_en' => 'Quarterfinal knockout round (if qualified)'],
            ['title_en' => 'Semifinal Round', 'activity_type' => 'semifinal', 'order' => 17, 'is_completed' => $results[$year]['round'] >= 4, 'activity_date' => $year . '-04-15', 'description_en' => 'Semifinal knockout round (if qualified)'],
            ['title_en' => 'Final Round & Awards Ceremony', 'activity_type' => 'final', 'order' => 18, 'is_completed' => $results[$year]['round'] >= 5, 'activity_date' => $year . '-04-18', 'description_en' => 'Championship final round and prize distribution ceremony'],
        ];

        if ($year === 2025) {
            $activities = [
                [
                    'title_en' => 'Team Formation & Initial Selection',
                    'activity_type' => 'announcement',
                    'order' => 1,
                    'is_completed' => true,
                    'activity_date' => '2025-01-08',
                    'description_en' => 'The 2025 Vis Moot team was officially formed with 5 dedicated members selected from the Royal University of Law and Economics. After a rigorous selection process including interviews and mock presentations, Meas Seanglong (Team Lead & Speaker), Sokha Meth (Speaker), Vutha Soth (Speaker), Srey Mao (Researcher), and Kimsreang Kol (Researcher) were chosen to represent the university.',
                    'location' => 'Royal University of Law and Economics, Phnom Penh'
                ],
                [
                    'title_en' => 'Case Problem Released - Seller v. Buyer Dispute',
                    'activity_type' => 'announcement',
                    'order' => 2,
                    'is_completed' => true,
                    'activity_date' => '2025-01-15',
                    'description_en' => 'The official case problem for the 32nd Willem C. Vis International Commercial Arbitration Moot was released. The case involves a complex dispute between a Cambodian seller and a German buyer regarding the sale of agricultural products, focusing on CISG articles related to contract formation, breach of contract, and remedies for non-conforming goods.',
                    'location' => 'Online'
                ],
                [
                    'title_en' => 'CISG Fundamentals Training Workshop',
                    'activity_type' => 'training',
                    'order' => 3,
                    'is_completed' => true,
                    'activity_date' => '2025-01-20',
                    'description_en' => 'Dr. Soksamnang Kheang conducted an intensive workshop on the United Nations Convention on Contracts for the International Sale of Goods (CISG). Team members learned about the scope of application, formation of contracts, obligations of sellers and buyers, remedies for breach, and risk allocation.',
                    'location' => 'RULE Campus, Room 301'
                ],
                [
                    'title_en' => 'UNCITRAL Arbitration Rules Training',
                    'activity_type' => 'training',
                    'order' => 4,
                    'is_completed' => true,
                    'activity_date' => '2025-01-27',
                    'description_en' => 'Prof. Chamnap Pheng led a comprehensive session on UNCITRAL Arbitration Rules. The team studied the arbitration procedure, jurisdiction, evidence rules, and award enforcement under the New York Convention.',
                    'location' => 'RULE Campus, Room 301'
                ],
                [
                    'title_en' => 'Legal Research Methodology Session',
                    'activity_type' => 'training',
                    'order' => 5,
                    'is_completed' => true,
                    'activity_date' => '2025-02-03',
                    'description_en' => 'The team received training on advanced legal research techniques specific to international commercial law and arbitration. Topics included using international legal databases, citing arbitral awards, and constructing persuasive legal arguments.',
                    'location' => 'RULE Library'
                ],
                [
                    'title_en' => 'Memorial Writing Workshop - Claimant Side',
                    'activity_type' => 'training',
                    'order' => 6,
                    'is_completed' => true,
                    'activity_date' => '2025-02-10',
                    'description_en' => 'The team began drafting the Claimant memorial. Under the guidance of Dr. Ly Sreypich, members learned the structure of written submissions, issue identification, statement of facts, legal arguments, and prayer for relief.',
                    'location' => 'RULE Moot Court Room'
                ],
                [
                    'title_en' => 'Memorial Writing Workshop - Respondent Side',
                    'activity_type' => 'training',
                    'order' => 7,
                    'is_completed' => true,
                    'activity_date' => '2025-02-17',
                    'description_en' => 'The team drafted the Respondent memorial, focusing on counterarguments to the Claimant\'s position. Emphasis was placed on articulating defenses under CISG Articles 35, 39, and 45 regarding non-conforming goods and notice requirements.',
                    'location' => 'RULE Moot Court Room'
                ],
                [
                    'title_en' => 'First Internal Practice Round',
                    'activity_type' => 'training',
                    'order' => 8,
                    'is_completed' => true,
                    'activity_date' => '2025-02-24',
                    'description_en' => 'The team conducted its first internal practice round. Each speaker presented their arguments while receiving feedback from coaches on clarity, structure, and persuasion techniques.',
                    'location' => 'RULE Moot Court Room'
                ],
                [
                    'title_en' => 'Oral Advocacy Intensive - Speaker Development',
                    'activity_type' => 'training',
                    'order' => 9,
                    'is_completed' => true,
                    'activity_date' => '2025-03-03',
                    'description_en' => 'An intensive oral advocacy session focused on improving presentation skills, handling arbitrator questions, and maintaining composure under pressure. Special attention given to time management and opening statements.',
                    'location' => 'RULE Moot Court Room'
                ],
                [
                    'title_en' => 'Regional Practice Round - TUFS University',
                    'activity_type' => 'training',
                    'order' => 10,
                    'is_completed' => true,
                    'activity_date' => '2025-03-08',
                    'description_en' => 'The team participated in a practice round against students from a regional university. This valuable experience exposed the team to different argumentation styles and helped identify areas for improvement.',
                    'location' => 'Online (Virtual)'
                ],
                [
                    'title_en' => 'Memorial Submission Deadline',
                    'activity_type' => 'submission',
                    'order' => 11,
                    'is_completed' => true,
                    'activity_date' => '2025-03-12',
                    'description_en' => 'Final submission of both Claimant and Respondent memorials to the Vis Moot Committee. The team submitted comprehensive 30-page memorials addressing all major issues in the case, including contract formation, breach of contract, and damages calculation.',
                    'location' => 'Online Submission'
                ],
                [
                    'title_en' => 'Final Preparation Camp in Vienna',
                    'activity_type' => 'training',
                    'order' => 12,
                    'is_completed' => true,
                    'activity_date' => '2025-04-06',
                    'description_en' => 'The team arrived in Vienna for the final preparation camp. With support from Prof. Sotheara Lay, members conducted daily practice sessions, refined their arguments, and prepared for the intense competition ahead.',
                    'location' => 'Vienna International Centre'
                ],
                [
                    'title_en' => 'Preliminary Round 1 - Against University of Warsaw',
                    'activity_type' => 'preliminary',
                    'order' => 13,
                    'is_completed' => true,
                    'activity_date' => '2025-04-11',
                    'description_en' => 'The team faced the University of Warsaw in the first preliminary round. Arguing as Claimant, Meas Seanglong and Sokha Meth presented arguments on contract formation and seller\'s remedies. The team successfully addressed challenging questions from the arbitrators.',
                    'location' => 'Vienna International Arbitration Center'
                ],
                [
                    'title_en' => 'Preliminary Round 2 - Against Universidad de Chile',
                    'activity_type' => 'preliminary',
                    'order' => 14,
                    'is_completed' => true,
                    'activity_date' => '2025-04-12',
                    'description_en' => 'In the second round, the team argued as Respondent against Universidad de Chile. Vutha Soth and Srey Mao presented strong defenses regarding the buyer\'s obligation to examine goods and give notice of non-conformity under CISG Article 39.',
                    'location' => 'Vienna International Arbitration Center'
                ],
                [
                    'title_en' => 'Preliminary Round 3 - Against University of Melbourne',
                    'activity_type' => 'preliminary',
                    'order' => 15,
                    'is_completed' => true,
                    'activity_date' => '2025-04-13',
                    'description_en' => 'The final preliminary round against the University of Melbourne was particularly challenging. The team argued both sides with excellent preparation. Meas Seanglong received commendation from arbitrators for his handling of complex damages calculations.',
                    'location' => 'Vienna International Arbitration Center'
                ],
                [
                    'title_en' => 'Quarterfinal Round - Against Sciences Po',
                    'activity_type' => 'quarterfinal',
                    'order' => 16,
                    'is_completed' => true,
                    'activity_date' => '2025-04-14',
                    'description_en' => 'Qualifying for the quarterfinals, the team faced Sciences Po Paris. In a closely contested round, the team presented sophisticated arguments on force majeure and hardship. Although the team did not advance, the performance demonstrated significant growth.',
                    'location' => 'Vienna International Arbitration Center'
                ],
                [
                    'title_en' => 'Awards Ceremony & Closing',
                    'activity_type' => 'ceremony',
                    'order' => 17,
                    'is_completed' => true,
                    'activity_date' => '2025-04-18',
                    'description_en' => 'The 32nd Willem C. Vis Moot concluded with a grand awards ceremony. Our team member Meas Seanglong was honored with the Best Oralist Award, recognizing his exceptional advocacy skills throughout the competition. The team finished as Quarterfinalists - the best result in the university\'s history.',
                    'location' => 'Vienna Hofburg Palace'
                ],
            ];
        }

        foreach ($activities as $activity) {
            MootActivity::create(array_merge($activity, ['participation_id' => $participation->id]));
        }
    }
}
