<?php

namespace App\ChainHandler;

use App\Character\Character;
use App\FightResult;
use App\GameApplication;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;


#[Autoconfigure(
    calls: [['setNext' => ['@'.OnFireHandler::class]]]
)]
class LevelHandler implements XpBonusHandlerInterface
{
    private XpBonusHandlerInterface $next;

    public function handle(Character $player, FightResult $fightResult): int
    {
        if ($player->getLevel() === 1) {
            GameApplication::$printer->info('You earned extra XP thanks to the Level handler!');

            return 25;
        }

        if (isset($this->next)) {
            return $this->next->handle($player, $fightResult);
        }

        return 0;
    }

    public function setNext(XpBonusHandlerInterface $next): void
    {
        $this->next = $next;
    }
}
