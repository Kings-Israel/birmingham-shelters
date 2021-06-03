<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use App\Models\ListingDocuments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminListingDocumentActions extends Component
{
    public ListingDocuments $document;

    public Listing $listing;

    public function mount(ListingDocuments $document, Listing $listing): void
    {
        $this->document = $document;

        $this->listing = $listing;
    }

    public function download()
    {
        $property_name = Str::of($this->listing->name)->snake();
        $today = now()->format('Y-m-d');
        $download_filename = "{$property_name}_{$this->document->document_type->value}_{$today}.pdf";
        return Storage::disk('listing')->download(
            "documents/{$this->document->filename}",
            $download_filename
        );
    }

    public function render()
    {
        return <<<'blade'
                <div>
                    <button wire:click="download" class="btn btn-sm btn-link text-decoration-none">
                        Download<span wire:loading wire:target="download">ing...</span>
                    </button>
                    <button
                        data-document-url="{{ $document->url() }}"
                        data-document-type="{{ $document->document_type->label }}"
                        class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#preview-document-modal">View</button>
                </div>
        blade;
    }
}
