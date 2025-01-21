<?php

namespace App\ChainHandler;

use App\Character\Character;
use App\Dice;
use App\FightResult;
use App\GameApplication;

class CasinoHandler implements XpBonusHandlerInterface
{
    private XpBonusHandlerInterface $next;

    public function handle(Character $player, FightResult $fightResult): int
    {
        $dice1 = Dice::roll(6);
        $dice2 = Dice::roll(6);

        // exit immediately
        if ($dice1 + $dice2 === 7) {
            return 0;
        }

        // The player wins if rolled a pair
        if ($dice1 === $dice2) {
            GameApplication::$printer->info('You earned extra XP thanks to the Casino handler!');

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
