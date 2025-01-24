<?php

namespace App\Factory;

use App\AttackType\AttackType;
use App\AttackType\BowType;
use App\AttackType\FireBoltType;
use App\AttackType\TwoHandedSwordType;

class AttackTypeFactory
{
    public function create(string $type): AttackType
    {
        return match ($type) {
            'bow' => new BowType(),
            'fire_bolt' => new FireBoltType(),
            'sword' => new TwoHandedSwordType(),
            default => throw new \RuntimeException('Invalid attack type given')
        };
    }
}
