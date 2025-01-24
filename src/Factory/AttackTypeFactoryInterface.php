<?php

namespace App\Factory;

use App\AttackType\AttackType;

interface AttackTypeFactoryInterface
{
    public function create(string $type): AttackType;
}
