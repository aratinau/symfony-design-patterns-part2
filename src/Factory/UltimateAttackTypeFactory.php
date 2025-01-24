<?php

namespace App\Factory;

use App\AttackType\AttackType;
use App\AttackType\Ultimate\MeteorType;
use App\AttackType\Ultimate\SkullBreakerSwordType;
use App\AttackType\Ultimate\TitaniumBowType;

class UltimateAttackTypeFactory implements AttackTypeFactoryInterface
{
    public function create(string $type): AttackType
    {
        return match ($type) {
            'bow' => new TitaniumBowType(),
            'fire_bolt' => new MeteorType(),
            'sword' => new SkullBreakerSwordType(),
            default => throw new \RuntimeException('Invalid attack type given')
        };
    }
}
