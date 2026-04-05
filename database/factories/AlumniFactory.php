<?php

namespace Database\Factories;

use App\Models\Alumni;
use App\Models\User;
use App\Models\AcademicProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    protected $model = Alumni::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = [
            'Legal Services', 'Corporate Law', 'Government', 'Banking & Finance',
            'Technology', 'Healthcare', 'Education', 'Non-Profit', 'Consulting',
            'Real Estate', 'Insurance', 'Manufacturing', 'Retail', 'Media & Communications'
        ];

        $jobTitles = [
            'Lawyer', 'Legal Counsel', 'Attorney', 'Legal Advisor', 'Corporate Lawyer',
            'Partner', 'Associate', 'Legal Consultant', 'Compliance Officer', 'Legal Manager',
            'Judge', 'Prosecutor', 'Public Defender', 'Legal Analyst', 'Contract Specialist'
        ];

        $locations = [
            'Phnom Penh, Cambodia', 'Siem Reap, Cambodia', 'Battambang, Cambodia',
            'Singapore', 'Bangkok, Thailand', 'Ho Chi Minh City, Vietnam',
            'Kuala Lumpur, Malaysia', 'Tokyo, Japan', 'Seoul, South Korea',
            'Beijing, China', 'Shanghai, China', 'Hong Kong', 'Taipei, Taiwan'
        ];

        return [
            'user_id' => User::factory(),
            'program_id' => AcademicProgram::inRandomOrder()->first(),
            'student_id' => 'STU' . $this->faker->unique()->numerify('######'),
            'graduation_year' => $this->faker->numberBetween(2000, now()->year - 1),
            'current_job_title' => $this->faker->randomElement($jobTitles),
            'company' => $this->faker->company(),
            'industry' => $this->faker->randomElement($industries),
            'location' => $this->faker->randomElement($locations),
            'phone' => $this->faker->phoneNumber(),
            'linkedin_url' => 'https://linkedin.com/in/' . $this->faker->userName(),
            'facebook_url' => 'https://facebook.com/' . $this->faker->userName(),
            'twitter_url' => 'https://twitter.com/' . $this->faker->userName(),
            'bio' => $this->faker->paragraphs(2, true),
            'achievements' => $this->faker->randomElements([
                'Graduated with Honors',
                'Published Legal Research Paper',
                'Received Excellence Award',
                'Community Service Recognition',
                'Professional Certification',
                'Leadership Award',
                'Best Delegate Award'
            ], $this->faker->numberBetween(1, 3)),
            'skills' => $this->faker->randomElements([
                'Contract Law', 'Corporate Law', 'Legal Research', 'Legal Writing',
                'Negotiation', 'Client Relations', 'Legal Compliance', 'Case Management',
                'Public Speaking', 'Legal Analysis', 'Due Diligence', 'Legal Counseling'
            ], $this->faker->numberBetween(3, 6)),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'contact_consent' => $this->faker->boolean(80), // 80% consent to contact
            'newsletter_consent' => $this->faker->boolean(70), // 70% consent to newsletter
            'is_verified' => $this->faker->boolean(60), // 60% verified
            'verified_at' => $this->faker->optional(0.6)->dateTime(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'approved_at' => $this->faker->optional(0.7)->dateTime(),
            'approved_by' => $this->faker->optional(0.7)->randomNumber(),
        ];
    }

    /**
     * Indicate that the alumni is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_at' => now(),
            'is_verified' => true,
            'verified_at' => now(),
        ]);
    }

    /**
     * Indicate that the alumni is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the alumni is verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => true,
            'verified_at' => now(),
        ]);
    }
}