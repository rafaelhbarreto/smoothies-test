<?php

namespace App\Services;

use App\Repositories\SmoothieRepository;

class SmoothieService
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
     * Make an order
     *
     * @param string $order
     */
    public function make(string $order)
    {

    }
}
