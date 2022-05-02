<?php

namespace App\Services;

class IngredientService
{
    const ADD = '+';
    const REMOVE = '-';

    /**
     * Verify the signal of ingredient
     *
     * @param string $ingredient
     * @return string
     */
    public function getType(string $ingredient): string
    {
        $signal = $ingredient[0];
        return $signal === self::ADD ? self::ADD : self::REMOVE;
    }
}
