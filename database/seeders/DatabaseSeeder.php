<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            NewsSeeder::class,
            BlogSeeder::class,
            LibrarySeeder::class,
            EventSeeder::class,
            InvestorSeeder::class,
            StartupSeeder::class,
            CohortSeeder::class,
            WiifPortfolioSeeder::class,
            MessageSeeder::class,
            SettingSeeder::class,
            StatSeeder::class,
            ProgramSeeder::class,
            HeroSlideSeeder::class,
        ]);
    }
}
