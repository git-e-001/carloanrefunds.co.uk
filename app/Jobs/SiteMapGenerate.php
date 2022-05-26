<?php

namespace App\Jobs;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SiteMapGenerate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $pages = Page::where('is_sitemap', true)->get()->pluck('slug');
            $siteMap = Sitemap::create();
            $siteMap->add(
                Url::create("https://carloanrefunds.co.uk/")
                    ->setLastModificationDate(Carbon::today())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
            foreach ($pages as $page) {
                $siteMap->add(
                    Url::create("/$page")
                        ->setLastModificationDate(Carbon::today())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.8)
                );
            }

            $siteMap->writeToFile(public_path("sitemap.xml"));

        } catch (\Exception $e) {
            info($e->getMessage());
        }
    }
}
