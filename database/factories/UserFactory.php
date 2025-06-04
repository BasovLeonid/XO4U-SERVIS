<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isPartner = $this->faker->boolean(30);
        $role = $isPartner ? 'partner' : $this->faker->randomElement(['admin', 'user']);
        
        return [
            'name' => 'Test ' . $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'telegram_username' => '@' . $this->faker->userName(),
            'last_auth_method' => $this->faker->randomElement(['email', 'telegram', 'phone']),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'total_spent' => $this->faker->randomFloat(2, 0, 50000),
            'repeat_purchases' => $this->faker->numberBetween(0, 50),
            'payment_rating' => $this->faker->randomFloat(2, 0, 5),
            'role' => $role,
            'is_partner' => $isPartner,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
