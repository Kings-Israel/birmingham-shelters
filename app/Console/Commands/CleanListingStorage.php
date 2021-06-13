<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanListingStorage extends Command
{

    protected $signature = 'clean-listing-storage';

    protected $description = 'Clean the listing directory in storage (onlys runs in local env)';

    public function handle(): int
    {
        if(!App::environment('local')) {
            $this->warn("Can't run command outside local environment.");
            return 0;
        }

        collect(Storage::disk('listing')->files('images'))
            ->merge(Storage::disk('listing')->files('documents'))
            ->each(fn ($file) => Storage::disk('listing')->delete($file));

        $this->info("Listing storage cleared");

        return 0;
    }
}
