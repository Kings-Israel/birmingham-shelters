<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ListingDocument;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        Listing::factory()
            ->count(10)
            ->forUser()
            ->has(ListingDocument::factory()->requiredDocuments(), 'documents')
            ->create();
    }
}
