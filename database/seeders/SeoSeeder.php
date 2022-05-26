<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seo::create([
            'page_id'             => Page::where('slug', 'welcome-page')->first()->id,
            'page_title'          => 'Loan and Credit Refund Specialists',
            'page_description'    => 'Loan and Credit Refund Specialists',
            'page_keywords'       => 'Loan and Credit Refund Specialists',
            'og_title'            => '',
            'og_type'             => '',
            'og_url'              => '',
            'og_description'      => '',
            'og_image'            => '',
            'twitter_title'       => '',
            'twitter_site'        => '',
            'twitter_card'        => '',
            'twitter_description' => '',
            'twitter_image'       => '',
            'page_scripts'        => '',
        ]);
    }
}
