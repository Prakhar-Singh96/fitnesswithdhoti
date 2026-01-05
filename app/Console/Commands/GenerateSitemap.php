<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file dynamically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('⏳ Starting Sitemap Generation...');

        // 1. Sitemap Instance Create karein
        $sitemap = Sitemap::create();

        // ==========================================
        // 🏠 1. STATIC PAGES (Home, FAQ, Tracking etc)
        // ==========================================
        $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        $sitemap->add(Url::create('/faqs')->setPriority(0.5));
        $sitemap->add(Url::create('/track-order')->setPriority(0.5));

        // Main Collection Page
        $sitemap->add(Url::create('/collections/all')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        // 🟢 SEO Special: Purpose Links (Wealth, Health etc.)
        $purposes = ['Wealth', 'Health', 'Love', 'Luck', 'Protection', 'Peace', 'Courage', 'Balance'];
        foreach ($purposes as $purpose) {
            $sitemap->add(Url::create("/collections/all?purpose={$purpose}")
                ->setPriority(0.7)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
        }

        // ==========================================
        // 📂 2. CATEGORIES (Route: /category/{slug})
        // ==========================================
        $this->info('👉 Adding Categories...');
        Category::where('status', 1)->get()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create("/category/{$category->slug}")
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });

        // ==========================================
        // 📂 3. SUB-CATEGORIES (Route: /category/{cat}/{sub})
        // ==========================================
        $this->info('👉 Adding Sub-Categories...');
        SubCategory::with('category')->where('status', 1)->get()->each(function (SubCategory $sub) use ($sitemap) {
            if ($sub->category) {
                $sitemap->add(
                    Url::create("/category/{$sub->category->slug}/{$sub->slug}")
                        ->setLastModificationDate($sub->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
            }
        });

        // ==========================================
        // 📦 4. PRODUCTS (Route: /product/{slug})
        // ==========================================
        $this->info('👉 Adding Products (This might take time)...');
        Product::where('status', 1)->chunk(100, function ($products) use ($sitemap) {
            foreach ($products as $product) {
                $sitemap->add(
                    Url::create("/product/{$product->slug}")
                        ->setLastModificationDate($product->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.9)
                );
            }
        });

        // ==========================================
        // 💾 SAVE FILE
        // ==========================================
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info('✅ Sitemap Generated Successfully at: ' . $path);
    }
}
