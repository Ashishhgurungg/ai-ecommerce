<?php
namespace App\Services;

class OrderTotalCalculator
{
    public function calculate(float $subtotal, float $discount): float
    {
        if ($discount < 0) {
            $discount = 0;
        }
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }
        return round($subtotal - $discount, 2);
    }
}
