<?php

namespace App\Services;

class PromoService
{
    protected array $validPromoCodes = [
        'SP3CI4LCU5T0M3R' => 0.10, 
        'H1R3H477Y' => 0.99, 
    ];

    public function getDiscountFromCode(?string $code): float
    {
        if (!$code) return 0;

        $upperCode = strtoupper($code);

        return $this->validPromoCodes[$upperCode] ?? 0;
    }
}
