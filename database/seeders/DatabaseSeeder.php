<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Template;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@undangan.test',
            'password' => Hash::make('password'),
        ]);

        // Create Settings
        Setting::create([
            'whatsapp_number' => '628123456789',
            'brand_name' => 'Undangan Digital Elegan',
            'instagram' => '@undanganelegan',
            'tiktok' => '@undanganelegan',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Undangan Website'],
            ['name' => 'Undangan Video'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Templates
        $templates = [
            [
                'category_id' => 1,
                'code' => 'WEB-MODERN-001',
                'thumbnail' => 'templates/dummy.jpg',
                'preview_link' => 'https://example.com/demo1',
                'price' => 150000,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'code' => 'WEB-RUSTIC-002',
                'thumbnail' => 'templates/dummy2.jpg',
                'preview_link' => 'https://example.com/demo2',
                'price' => 200000,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'code' => 'VIDEO-CINEMATIC-001',
                'thumbnail' => 'templates/dummy3.jpg',
                'preview_link' => 'https://youtube.com/watch?v=example',
                'price' => 300000,
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            Template::create($template);
        }

        // Create Testimonies
        $testimonies = [
            [
                'image' => 'testimonies/testi1.jpg',
                'note' => 'Orderan dari Kak Shinta - Jakarta',
            ],
            [
                'image' => 'testimonies/testi2.jpg',
                'note' => 'Pelanggan dari Surabaya - Sangat Puas!',
            ],
        ];

        foreach ($testimonies as $testimony) {
            Testimony::create($testimony);
        }
    }
}