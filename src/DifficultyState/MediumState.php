<?php

namespace App\DifficultyState;

use App\Character\Character;
use App\Dice;
use App\FightResult;
use App\GameApplication;
use App\GameDifficultyContext;

class MediumState implements DifficultyStateInterface
{
    public function victory(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void
    {
        if ($player->getLevel() >= 4 || $fightResult->getWinStreak() >= 4) {
            $difficultyContext->enemyLevelBonus = $player->getLevel() + 1;
            $difficultyContext->enemyHealthBonus = 10;
            $difficultyContext->enemyAttackBonus = 8;
            $player->setXpBonus(50);
            $difficultyContext->difficultyState = new HardState();

            GameApplication::$printer->info('Game difficulty level increased to Hard!');
        }
    }

    public function defeat(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void
    {
        if (Dice::roll(100) <= 60) {
            // Back to level 1
            $difficultyContext->enemyAttackBonus = 0;
            $difficultyContext->enemyHealthBonus = 0;
            $player->setXpBonus(0);
            $difficultyContext->difficultyState = new EasyState();

            GameApplication::$printer->info('Game difficulty level decreased to Easy!');
        }
    }

}
