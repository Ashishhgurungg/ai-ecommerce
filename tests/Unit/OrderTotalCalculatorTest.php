<?php

namespace Tests\Unit;

use App\Services\OrderTotalCalculator;
use PHPUnit\Framework\TestCase;

class OrderTotalCalculatorTest extends TestCase
{
    public function test_it_calculates_order_total_after_discount(): void
    {
        $calculator = new OrderTotalCalculator;
        $total = $calculator->calculate(100, 25);
        $this->assertSame(75.0, $total);
    }

    public function test_discount_cannot_be_greater_than_subtotal(): void{
        $calculator = new OrderTotalCalculator();
        $total = $calculator->calculate(100, 150);
        $this->assertSame(0.0, $total);
    }

    public function test_negative_discount_is_treated_as_zero(): void
    {
        $calculator = new OrderTotalCalculator();
        $total = $calculator->calculate(100, -20);
        $this->assertSame(100.0, $total);
    }
}
