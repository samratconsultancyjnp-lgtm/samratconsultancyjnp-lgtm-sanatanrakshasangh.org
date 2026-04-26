<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@ngo.com'],
            [
                'name' => 'Admin Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Designations
        $designations = ['National President', 'State President', 'District President', 'General Secretary', 'Member', 'Volunteer'];
        foreach ($designations as $name) {
            \App\Models\Designation::updateOrCreate(['name' => $name]);
        }

        // Settings
        $settings = [
            'site_name' => 'Sanatan Raksha Sangh',
            'contact_email' => 'info@sanatanraksha.org',
            'contact_phone' => '+91 800 123 4567',
            'about_content' => 'Sanatan Raksha Sangh is dedicated to the preservation of our cultural heritage and the upliftment of the society through unity and selfless service.',
            'mission_content' => 'To protect the values of Sanatan Dharma and serve humanity without any discrimination.',
            'vision_content' => 'A society where every individual is empowered and culturally rooted.',
            'total_projects' => '156',
            'total_events_conducted' => '450',
            'meta_title' => 'Sanatan Raksha Sangh - Protection & Service',
            'meta_description' => 'Official website of Sanatan Raksha Sangh, working for cultural preservation and social welfare.',
            'upi_id' => 'sanatanraksha@sbi',
            'bank_name' => 'State Bank of India',
            'account_number' => '12345678901',
            'ifsc_code' => 'SBIN0001234',
        ];
        foreach ($settings as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Events
        \App\Models\Event::truncate();
        $events = [
            [
                'title' => 'Mega Blood Donation Camp',
                'event_date' => now()->addDays(5),
                'description' => 'Join our life-saving mission. We are organizing a mega blood donation camp to support local hospitals.',
                'image' => null,
            ],
            [
                'title' => 'Cultural Awareness Seminar',
                'event_date' => now()->addDays(15),
                'description' => 'A seminar dedicated to teaching the youth about our rich Vedic traditions and cultural values.',
                'image' => null,
            ],
            [
                'title' => 'Village Upliftment Program',
                'event_date' => now()->subDays(10),
                'description' => 'A successful initiative where we provided education kits to 500+ children in rural areas.',
                'image' => null,
            ],
        ];
        foreach ($events as $event) {
            \App\Models\Event::create($event);
        }

        // Gallery
        \App\Models\GalleryAlbum::truncate();
        $album = \App\Models\GalleryAlbum::create(['name' => 'Recent Social Work']);
        \App\Models\GalleryMedia::create([
            'album_id' => $album->id,
            'file_path' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80',
            'type' => 'image'
        ]);

        // Donations
        \App\Models\Donation::truncate();
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\Donation::create([
                'name' => 'Donor ' . $i,
                'mobile' => '987654321' . $i,
                'amount' => rand(500, 5000),
                'transaction_id' => 'TXN' . strtoupper(Str::random(8)),
                'status' => 'approved'
            ]);
        }

        // Members
        \App\Models\Member::truncate();
        $designationId = \App\Models\Designation::first()->id;
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'name' => 'Member User ' . $i,
                'email' => 'member' . $i . '@test.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'member',
            ]);

            \App\Models\Member::create([
                'user_id' => $user->id,
                'designation_id' => $designationId,
                'mobile' => '900000000' . $i,
                'state' => 'Uttar Pradesh',
                'district' => 'Lucknow',
                'pincode' => '226001',
                'status' => 'approved',
            ]);
        }
    }
}
