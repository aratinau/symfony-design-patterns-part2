<?php

namespace App\Factory;

use App\AttackType\AttackType;
use App\AttackType\BowType;
use App\AttackType\FireBoltType;
use App\AttackType\TwoHandedSwordType;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

/*
 * Avant d'essayer, il y a un petit détail à régler.
 * Symfony ne sait pas quelle AttackTypeFactory injecter dans CharacterBuilder
 *  car nous avons plus d'une implémentation de l'AttackTypeFactoryInterface.
 *  Nous devons dire à Symfony laquelle utiliser par défaut.
 *  Pour ce faire, nous pouvons utiliser l'attribut AsAlias.
 *  Ouvrez AttackTypeFactory et, au-dessus du nom de la classe,
 * écrivez #[AsAlias()] et passez AttackTypeFactoryInterface::class comme ID. C'est fait !
 * */

#[AsAlias(AttackTypeFactoryInterface::class)]
class AttackTypeFactory implements AttackTypeFactoryInterface
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
