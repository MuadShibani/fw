<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Startup;

class StartupSeeder extends Seeder
{
    public function run(): void
    {
        Startup::truncate();

        $items = [
            [
                'name'           => 'PayYemen',
                'sector'         => 'Fintech',
                'description_en' => 'Seamless mobile payments and digital wallet solution for the unbanked population.',
                'description_ar' => 'حلول الدفع عبر الهاتف المحمول والمحفظة الرقمية للسكان الذين لا يتعاملون مع البنوك.',
                'logo_url'       => 'https://via.placeholder.com/100/A2C59A/FFFFFF?text=PY',
                'stage'          => 'Seed',
                'founder_name'   => 'Mohammed Ali',
            ],
            [
                'name'           => 'SouqYemen',
                'sector'         => 'E-commerce',
                'description_en' => 'Connecting local artisans directly to global markets through a unified platform.',
                'description_ar' => 'ربط الحرفيين المحليين مباشرة بالأسواق العالمية من خلال منصة موحدة.',
                'logo_url'       => 'https://via.placeholder.com/100/B04C2C/FFFFFF?text=SY',
                'stage'          => 'Pre-Seed',
                'founder_name'   => 'Fatima Saleh',
            ],
            [
                'name'           => 'GreenGrow',
                'sector'         => 'AgriTech',
                'description_en' => 'Smart irrigation systems powered by solar energy for Yemeni farmers.',
                'description_ar' => 'أنظمة ري ذكية تعمل بالطاقة الشمسية للمزارعين اليمنيين.',
                'logo_url'       => 'https://via.placeholder.com/100/9FD4D5/FFFFFF?text=GG',
                'stage'          => 'Seed',
                'founder_name'   => 'Yasser Ahmed',
            ],
            [
                'name'           => 'EduYemen',
                'sector'         => 'EdTech',
                'description_en' => 'Online learning platform tailored for the Yemeni curriculum with offline capabilities.',
                'description_ar' => 'منصة تعليمية عبر الإنترنت مصممة للمناهج اليمنية مع إمكانيات العمل دون اتصال بالإنترنت.',
                'logo_url'       => 'https://via.placeholder.com/100/ECCE9E/524037?text=EY',
                'stage'          => 'Bootstrapped',
                'founder_name'   => 'Layla Hameed',
            ],
        ];

        Startup::insert($items);
    }
}
