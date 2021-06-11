<?php

namespace Database\Factories;

use App\Enums\InvoiceTypeEnum;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Enum\Laravel\Faker\FakerEnumProvider;

class InvoiceFactory extends Factory
{

    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            //
        ];
    }

    public function ofType($invoice_type): Factory
    {
        if (is_string($invoice_type)){
            $invoice_type = InvoiceTypeEnum::from($invoice_type);
        }

        return $this->state(['invoice_type' => $invoice_type]);
    }

    public function ownerAs(User $user): Factory
    {
        return $this->state(['user_id' => $user->id]);
    }
}
