<?php

use Illuminate\Database\Seeder;
use App\Models\PageMetaTag;

class PageMetaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageMetaTag::create([
            'id' => '1',
            'page_name' => 'Dashboard',
            'meta_title' => 'Sankalp Filters | Dashboard',
            'meta_keywords' => 'Sankalp Filters | Dashboard',
            'meta_description' => 'Sankalp Filters | Dashboard',
        ]);

        PageMetaTag::create([
            'id' => '2',
            'page_name' => 'About Us',
            'meta_title' => 'Sankalp Filters | About Us',
            'meta_keywords' => 'Sankalp Filters | About Us',
            'meta_description' => 'Sankalp Filters | About Us',
        ]);

        PageMetaTag::create([
            'id' => '3',
            'page_name' => 'Enquiry',
            'meta_title' => 'Sankalp Filters | Enquiry',
            'meta_keywords' => 'Sankalp Filters | Enquiry',
            'meta_description' => 'Sankalp Filters | Enquiry',
        ]);

        PageMetaTag::create([
            'id' => '4',
            'page_name' => 'Product',
            'meta_title' => 'Sankalp Filters | Product',
            'meta_keywords' => 'Sankalp Filters | Product',
            'meta_description' => 'Sankalp Filters | Product',
        ]);

        PageMetaTag::create([
            'id' => '5',
            'page_name' => 'Product Details',
            'meta_title' => 'Sankalp Filters | Product Details',
            'meta_keywords' => 'Sankalp Filters | Product Details',
            'meta_description' => 'Sankalp Filters | Product Details',
        ]);
    }
}
