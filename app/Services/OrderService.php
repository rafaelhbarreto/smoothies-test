<?php

namespace App\Services;

use App\Repositories\SmoothieRepository;

class OrderService
{
    private SmoothieRepository $smoothieRepository;
    private IngredientService $ingredientService;

    /**
     * @param IngredientService $ingredientService
     * @param SmoothieRepository $smoothieRepository
     */
    public function __construct(IngredientService $ingredientService, SmoothieRepository $smoothieRepository)
    {
        $this->smoothieRepository = $smoothieRepository;
        $this->ingredientService = $ingredientService;
    }

    /**
     * Returns the smoothie name
     *
     * @param string $order
     * @return string
     */
    public function getSmoothieName(string $order): string
    {
        return explode(',', $order)[0];
    }

    /**
     * Returns the additionals of a order
     *
     * @param string $order
     * @return array
     */
    public function getAdditionals(string $order): array
    {
        $additionals = explode(',', $order);

        unset($additionals[0]);

        return $additionals;
    }

    /**
     * Verify if a order has additionals
     *
     * @param string $order
     * @return bool
     */
    public function hasAdditionals(string $order): bool
    {
        return count($this->getAdditionals($order));
    }

    /**
     * Make a smoothie
     *
     * @param string $order
     * @return array
     */
    public function makeSmoothie(string $order): array
    {
        $ingredients = $this->smoothieRepository->findByName($this->getSmoothieName($order));

        if ($this->hasAdditionals($order)) {
            foreach ($this->getAdditionals($order) as $ingredient) {
                if ($this->ingredientService->getType($ingredient) == IngredientService::ADD) {
                    $ingredients = $this->smoothieRepository->addIngredient($ingredient, $ingredients);
                } else {
                    $ingredients = $this->smoothieRepository->removeIngredient($ingredient, $ingredients);
                }
            }
        }

        sort($ingredients);
        return $ingredients;
    }
}
