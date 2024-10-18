<?php

namespace App\ActionCommand;

use App\Character\Character;
use App\GameApplication;
use App\FightResultSet;

class AttackCommand implements ActionCommandInterface
{
    public function __construct(
        private readonly Character $player,
        private readonly Character $opponent,
        private readonly FightResultSet $fightResultSet,
    ) {
    }

    public function execute(): void
    {
        $damage = $this->player->attack();
        if ($damage === 0) {
            GameApplication::$printer->printFor($this->player)->exhaustedMessage();
            $this->fightResultSet->of($this->player)->addExhaustedTurn();

            return;
        }

        $damageDealt = $this->opponent->receiveAttack($damage);
        $this->fightResultSet->of($this->player)->addDamageDealt($damageDealt);

        GameApplication::$printer->printFor($this->player)->attackMessage($damageDealt);
        GameApplication::$printer->writeln('');
        usleep(300000);
    }
}
