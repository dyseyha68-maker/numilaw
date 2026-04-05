<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumniConnection;
use Carbon\Carbon;

class AlumniConnectionSeeder extends Seeder
{
    public function run(): void
    {
        $connections = [
            [
                'requester_id' => 4,
                'receiver_id' => 1,
                'message' => 'Hi Sok! I\'m a recent graduate and really admire your work in corporate law. I would love to connect and learn from your experience.',
                'message_km' => 'សួស្តីសុខ! ខ្ញុំជានិស្សិតចាស់ថ្មីហើយគោរពការងាររបស់លោកក្នុងច្បាប់ក្រុមហ៊ុនណាស់។ ខ្ញុំចង់ភ្ជាប់ទំនាក់ទំនង និងរៀនពីបទពិសោធន៍របស់លោក។',
                'status' => 'accepted',
                'accepted_at' => Carbon::now()->subMonths(3),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'requester_id' => 5,
                'receiver_id' => 2,
                'message' => 'Dear Bopha, I\'m inspired by your work in human rights law. As a fellow NUMiLaw graduate, I would appreciate the opportunity to connect and share insights.',
                'message_km' => 'លោកស្រីបុប្ផាដ៏គួរឱ្យគោរព ខ្ញុំបានទទួលការបំផុសគំនិតពីការងាររបស់លោកស្រីក្នុងច្បាប់សិទ្ធិមនុស្ស។ ជានិស្សិតចាស់ NUMiLaw ម្នាក់ទៀត ខ្ញុំសូមឱកាសភ្ជាប់ទំនាក់ទំនង និងចែករំលែកគំនិត។',
                'status' => 'accepted',
                'accepted_at' => Carbon::now()->subMonths(2),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'requester_id' => 3,
                'receiver_id' => 1,
                'message' => 'Hello Sok, I\'m working in banking law and would love to connect with fellow alumni in the corporate legal field.',
                'message_km' => 'សួស្តីសុខ ខ្ញុំកំពុងធ្វើការនៅច្បាប់ធនាគារ ហើយចង់ភ្ជាប់ទំនាក់ទំនងជាមួយនិស្សិតចាស់ផ្សេងទៀតនៅក្នុងវិស័យច្បាប់ក្រុមហ៊ុន។',
                'status' => 'pending',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'requester_id' => 2,
                'receiver_id' => 3,
                'message' => 'Hi Kosal, I\'m interested in learning more about banking law compliance. Would love to connect and discuss potential collaboration opportunities.',
                'message_km' => 'សួស្តីកុសល ខ្ញុំចង់ស្វែងយល់បន្ថែមអំពីការអនុវត្តច្បាប់ធនាគារ។ ចង់ភ្ជាប់ទំនាក់ទំនង និងពិភាក្សាអំពីឱកាសសហការណ៍ដែលអាចកើតមាន។',
                'status' => 'accepted',
                'accepted_at' => Carbon::now()->subMonths(5),
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now()->subMonths(5),
            ],
            [
                'requester_id' => 1,
                'receiver_id' => 5,
                'message' => 'Hello Daravuth, as a fellow legal practitioner, I would be honored to connect and learn from your experience in public prosecution.',
                'message_km' => 'សួស្តីតារាវុធ ជាអ្នកអនុវត្តច្បាប់ម្នាក់ទៀត ខ្ញុំនឹងមានក្តីសុបិនក្នុងការភ្ជាប់ទំនាក់ទំនង និងរៀនពីបទពិសោធន៍របស់លោកក្នុងការចោទប្រកាន់សាធារណៈ។',
                'status' => 'accepted',
                'accepted_at' => Carbon::now()->subMonths(4),
                'created_at' => Carbon::now()->subMonths(5),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
            [
                'requester_id' => 4,
                'receiver_id' => 2,
                'message' => 'Dear Bopha, your work in human rights law is inspiring. I would love to learn from your experience and potentially explore internship opportunities.',
                'message_km' => 'លោកស្រីបុប្ផាដ៏គួរឱ្យគោរព ការងាររបស់លោកស្រីក្នុងច្បាប់សិទ្ធិមនុស្សគឺផ្តល់ការបំផុសគំនិត។ ខ្ញុំចង់រៀនពីបទពិសោធន៍របស់លោកស្រី និងអាចស្វែងរកឱកាសអនុវត្តការងារ។',
                'status' => 'rejected',
                'rejected_at' => Carbon::now()->subWeeks(1),
                'rejection_reason' => 'Currently not available for new connections due to workload',
                'rejection_reason_km' => 'ពុំអាចមានពេលសម្រាប់ការភ្ជាប់ទំនាក់ទំនងថ្មីនៅពេលបច្ចុប្បន្នដោយសារតែការងារច្រើន',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(1),
            ],
            [
                'requester_id' => 5,
                'receiver_id' => 3,
                'message' => 'Hello Kosal, I\'m interested in understanding the intersection of criminal law and banking regulations. Would you be open to connecting?',
                'message_km' => 'សួស្តីកុសល ខ្ញុំចាប់អារម្មណ៍ក្នុងការយល់ពីចំណុចប្រសព្វរវាងច្បាប់ឧក្រិដ្ឋ និងបទបញ្ជាធនាគារ។ តើលោកបើកចំហរក្នុងការភ្ជាប់ទំនាក់ទំនងដែរឬទេ?',
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'requester_id' => 3,
                'receiver_id' => 4,
                'message' => 'Hi Sreyneang, I remember you from campus! Would love to connect and see how your career in tax law is progressing.',
                'message_km' => 'សួស្តីស្រីនាង ខ្ញុំចងចាំអ្នកពីសាលា! ចង់ភ្ជាប់ទំនាក់ទំនង និងមើលថាអាជីពរបស់អ្នកក្នុងច្បាប់ពន្ធកំពុងរីកចម្រើនយ៉ាងដូចម្តេច។',
                'status' => 'accepted',
                'accepted_at' => Carbon::now()->subWeeks(1),
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(1),
            ],
        ];

        foreach ($connections as $connection) {
            AlumniConnection::create($connection);
        }
    }
}