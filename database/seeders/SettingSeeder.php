<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'app_links' => json_encode([
                'acceleratorApplication' => 'https://docs.google.com/forms/d/e/1FAIpQLSf_EXAMPLE_ACCELERATOR/viewform',
                'yainStartupPitch'       => 'https://docs.google.com/forms/d/e/1FAIpQLSf_EXAMPLE_PITCH/viewform',
                'yainInvestorJoin'       => 'https://docs.google.com/forms/d/e/1FAIpQLSf_EXAMPLE_INVESTOR/viewform',
                'silExternalLink'        => '',
            ]),
            'site_name_en'  => 'Wathba Platform',
            'site_name_ar'  => 'منصة وثبة',
            'contact_email' => 'info@wathba.org',
            'footer_text_en' => 'Wathba is funded by the European Union.',
            'footer_text_ar' => 'وثبة ممولة من الاتحاد الأوروبي.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }
    }
}
