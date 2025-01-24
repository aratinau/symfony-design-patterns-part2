<?php

namespace App\DifficultyState;

use App\Character\Character;
use App\FightResult;
use App\GameApplication;
use App\GameDifficultyContext;

class EasyState implements DifficultyStateInterface
{
    public function victory(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void
    {
        if ($player->getLevel() >= 2 || $fightResult->getTotalVictories() >= 2) {
            $difficultyContext->enemyAttackBonus = 5;
            $difficultyContext->enemyHealthBonus = 5;
            $player->setXpBonus(25);
            // $difficultyContext->level++;
            $difficultyContext->difficultyState = new MediumState();

            GameApplication::$printer->info('Game difficulty level increased to Medium!');
        }
    }

    public function defeat(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void
    {
        // TODO: Implement defeat() method.
    }

}
