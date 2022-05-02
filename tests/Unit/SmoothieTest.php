<?php

namespace Tests\Unit;

use App\Repositories\SmoothieRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmoothieTest extends TestCase
{
    use WithFaker;

    /** @var SmoothieRepository */
    protected $smoothieRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->smoothieRepository = app(SmoothieRepository::class);
    }

    /** @test */
    public function should_decode_the_smoothies()
    {
        $this->assertEquals(collect(json_decode(config('smoothies.items'))), $this->smoothieRepository->all());
    }

    /** @test */
    public function should_be_valid_when_find_a_specific_smoothie()
    {
        $this->assertNotNull($this->smoothieRepository->findByName('Classic'));
    }

    /** @test */
    public function should_be_invalid_when_the_name_of_a_smoothie_does_not_exist()
    {
        $this->assertNull($this->smoothieRepository->findByName($this->faker->name));
    }

    /** @test */
    public function should_add_a_ingredient_from_smoothie()
    {
        $ingredients = $this->smoothieRepository->findByName('Classic');
        $aditional = '+mint';

        $ingredientsWithMint = $this->smoothieRepository->addIngredient($aditional, $ingredients);
        $ingredients[] = substr($aditional, 1);

        $this->assertEquals($ingredients, $ingredientsWithMint);
    }

    /** @test */
    public function should_remove_a_ingredient_from_smoothie()
    {
        $ingredientToRemove = '-banana';
        $ingredients = $this->smoothieRepository->findByName('Classic');

        $this->assertEquals(count($ingredients) - 1, count($this->smoothieRepository->removeIngredient($ingredientToRemove, $ingredients)));
    }

    /**
     * @test
     * @dataProvider providers
     */
    public function should_create_a_smoothie($order, $result)
    {
        /** @var OrderService $orderService */
        $orderService = app(OrderService::class);
        $this->assertEquals($result, $orderService->makeSmoothie($order));
    }

    public function providers()
    {
        return [
            'it_create_classic_plus_chocolate' => [
                'Classic,+chocolate', ["banana", "chocolate","honey","ice","mango","peach","pineapple","strawberry", "yogurt"]
            ],

            'it_create_a_classic_plus_chocolate_minus_straberry' => [
                'Classic,+chocolate,-strawberry', ["banana", "chocolate","honey","ice","mango","peach","pineapple","yogurt"]
            ],

            'it_create_a_classic_smoothie' => [
                'Classic', ["banana","honey","ice","mango","peach","pineapple","strawberry","yogurt"]
            ],

            'it_create_a_classic_minus_straberry' => [
                'Classic,-strawberry', ["banana","honey","ice","mango","peach","pineapple","yogurt"]
            ],

            'it_create_a_just_desserts' => [
                'Just Desserts', ["banana","cherry","chocolate","ice cream","peanut"]
            ],

            'it_create_just_desserts_without_ice_cream_and_peanut' => [
                'Just Desserts,-ice cream,-peanut', ["banana","cherry","chocolate"]
            ],

            'it_create_a_smooth_without_ingredients' => [
                'Just Desserts,-banana,-cherry,-chocolate,-ice cream,-peanut', []
            ],

            'it_exclude_unset_ingredients' => [
                'Classic,-banana,-mango,-peanut', ["honey","ice","peach","pineapple","strawberry","yogurt"]
            ],
        ];
    }
}
