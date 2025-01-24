<?php

namespace App\DifficultyState;

/*
 * L'interface doit avoir une méthode pour chaque événement possible.
 * Dans notre cas, il s'agirait de victory() et defeat(),
 * donc nous écrivons public function victory().
 *
 * Les arguments sont GameDifficultyContext $difficultyContext, Character $player, et FightResult $fightResult.
 * La méthode defeat() a les mêmes arguments, nous pouvons donc dupliquer cette ligne et la renommer « defeat ».
 * */

use App\Character\Character;
use App\FightResult;
use App\GameDifficultyContext;

interface DifficultyStateInterface
{
    public function victory(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void;

    public function defeat(GameDifficultyContext $difficultyContext, Character $player, FightResult $fightResult): void;
}
