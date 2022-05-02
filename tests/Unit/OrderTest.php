<?php

namespace Tests\Unit;

use App\Services\OrderService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker;

    /** @var OrderService */
    protected $orderService;


    public function setUp(): void
    {
        parent::setUp();
        $this->orderService = app(OrderService::class);
    }

    /** @test */
    public function should_returns_a_name_of_an_order()
    {
        $order = 'Classic,+chocolate,-straberry';
        $this->assertEquals('Classic', $this->orderService->getSmoothieName($order));
    }

    /** @test */
    public function should_returns_a_additionals()
    {
        $order = 'Classic,+chocolate,-straberry';
        $this->assertEquals(2, count($this->orderService->getAdditionals($order)));
    }
}
