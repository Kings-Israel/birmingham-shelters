<?php

namespace Database\Factories;

use App\Enums\ListingDocumentTypesEnum;
use App\Models\ListingDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Carbon;

class ListingDocumentFactory extends Factory
{
    protected $model = ListingDocument::class;

    public function definition()
    {
        return [
            'filename' => $this->faker->randomElement(['samples/sample_1.pdf', 'samples/sample_2.pdf']),
            'expiry_date' => Carbon::today()->addRealYears(2),
        ];
    }

    public function requiredDocuments(): Factory
    {
        $doc_types = ListingDocumentTypesEnum::toValues();
        $types_sequence = collect($doc_types)->map(fn ($type) => ['document_type' => $type])->all();

        return $this->count(count($doc_types))
            ->state(new Sequence(...$types_sequence));
    }
}
