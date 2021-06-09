<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Copy stub files for listing images and documents during development
        if (App::environment('local')) {
            if (
                Storage::disk('listing')->missing('images/samples') ||
                empty(Storage::disk('listing')->files('images/samples'))
                ) {
                File::copyDirectory(
                    Storage::path('stubs/listing_images'),
                    Storage::disk('listing')->path('images/samples')
                );
            }

            if (
                Storage::disk('listing')->missing('documents/samples')||
                empty(Storage::disk('listing')->files('documents/samples'))
                ) {
                File::copyDirectory(
                    Storage::path('stubs/listing_documents'),
                    Storage::disk('listing')->path('documents/samples')
                );
            }
        }
    }
}
