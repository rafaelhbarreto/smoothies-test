<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class SmoothieRepository
{
    /**
     * Return all smothies
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return collect(json_decode(config('smoothies.items'), true));
    }

    /**
     * Returns a specific smoothie
     *
     * @param string $name
     * @return array|null
     */
    public function findByName(string $name): ?array
    {
        return $this->all()->filter(function($value, $key) use ($name) {
            return $name === $key;
        })->first();
    }

    /**
     * Add a ingredient to the given smoothie
     *
     * @param string $ingredient
     * @param array $ingredients
     * @return array
     */
    public function addIngredient(string $ingredient, array $ingredients): array
    {
        $ingredient = substr($ingredient, 1);
        return array_merge($ingredients, [$ingredient]);
    }

    /**
     * Remove a given ingredient from ingredients
     *
     * @param string $ingredientToRemove
     * @param array $ingredients
     * @return array
     */
    public function removeIngredient(string $ingredientToRemove, array $ingredients): array
    {
        $ingredientToRemove = substr($ingredientToRemove, 1);
        return array_filter($ingredients, fn($item) => $item != $ingredientToRemove);
    }
}
