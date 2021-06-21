<?php

namespace Database\Seeders;

use App\Models\ListingInquiry;
use Illuminate\Database\Seeder;

class ListingInquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListingInquiry::factory(20)->forListing()->create();
    }
}
