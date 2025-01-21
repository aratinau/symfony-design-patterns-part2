<?php

namespace App\ChainHandler;

use App\Character\Character;
use App\FightResult;

interface XpBonusHandlerInterface
{
    public function handle(Character $player, FightResult $fightResult): int;

    public function setNext(XpBonusHandlerInterface $next): void;
}
