<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message_contact_name' => $this->faker->name(),
            'message_contact_email' => $this->faker->email(),
            'message_contact_subject' => $this->faker->sentence(4),
            'message_contact' => $this->faker->paragraph()
        ];
    }
}
