<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Province;
use App\Models\UniversityType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Province::insert([
            ['name_km' => 'ភ្នំពេញ', 'name_en' => 'Phnom Penh'],
            ['name_km' => 'កណ្ដាល', 'name_en' => 'Kandal'],
            ['name_km' => 'កំពង់ចាម', 'name_en' => 'Kampong Cham'],
            ['name_km' => 'កំពង់ឆ្នាំង', 'name_en' => 'Kampong Chhnang'],
            ['name_km' => 'កំពង់ធំ', 'name_en' => 'Kampong Thom'],
            ['name_km' => 'កំពង់ស្ពឺ', 'name_en' => 'Kampong Speu'],
            ['name_km' => 'កំពត', 'name_en' => 'Kampot'],
            ['name_km' => 'កែប', 'name_en' => 'Kep'],
            ['name_km' => 'កោះកុង', 'name_en' => 'Koh Kong'],
            ['name_km' => 'ក្រចេះ', 'name_en' => 'Kratie'],
            ['name_km' => 'តាកែវ', 'name_en' => 'Takeo'],
            ['name_km' => 'ត្បូងឃ្មុំ', 'name_en' => 'Tboung Khmom'],
            ['name_km' => 'បន្ទាយមានជ័យ', 'name_en' => 'Banteay Meanchey'],
            ['name_km' => 'បាត់ដំបង', 'name_en' => 'Battambang'],
            ['name_km' => 'ប៉ៃលិន', 'name_en' => 'Pailin'],
            ['name_km' => 'ពោធិ៍សាត់', 'name_en' => 'Pursat'],
            ['name_km' => 'ព្រះវិហារ', 'name_en' => 'Preah Vihear'],
            ['name_km' => 'ព្រះសីហនុ', 'name_en' => 'Preah Sihanouk'],
            ['name_km' => 'ព្រៃវែង', 'name_en' => 'Prey Veng'],
            ['name_km' => 'មណ្ឌលគីរី', 'name_en' => 'Mondulkiri'],
            ['name_km' => 'រតនគីរី', 'name_en' => 'Ratanakiri'],
            ['name_km' => 'សៀមរាប', 'name_en' => 'Siem Reap'],
            ['name_km' => 'ស្ទឹងត្រែង', 'name_en' => 'Stung Treng'],
            ['name_km' => 'ស្វាយរៀង', 'name_en' => 'Svay Rieng'],
            ['name_km' => 'ឧត្តរមានជ័យ', 'name_en' => 'Oddar Meanchey']
            ]);

        UniversityType::insert([
            ['name_km' => 'រដ្ឋ', 'name_en' => 'Public'],
            ['name_km' => 'ឯកជន', 'name_en' => 'Private'],
        ]);
    }
}
