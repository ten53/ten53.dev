<?php

namespace Database\Factories;

use App\Enum\NoteStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 999999),
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(4, true),
            'featured_image' => null,
            'status' => NoteStatus::DRAFT,
            'published_at' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn() => [
            'status' => NoteStatus::PUBLISHED,
            'published_at' => now(),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn() => [
            'status' => NoteStatus::DRAFT,
            'published_at' => null,
        ]);
    }
}
