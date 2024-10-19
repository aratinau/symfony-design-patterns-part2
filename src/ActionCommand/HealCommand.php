<?php

namespace App\ActionCommand;

use App\Character\Character;
use App\Dice;
use App\GameApplication;

class HealCommand implements ActionCommandInterface
{
    private int $currentHealth = 0;
    private int $stamina = 0;

    public function __construct(private readonly Character $player)
    {
    }

    public function execute(): void
    {
        $this->stamina = $this->player->getStamina();
        $this->currentHealth = $this->player->getCurrentHealth();

        $healAmount = Dice::roll(20) + $this->player->getLevel() * 3;
        $newAmount = $this->player->getCurrentHealth() + $healAmount;
        $newAmount = min($newAmount, $this->player->getMaxHealth());

        $this->player->setHealth($newAmount);
        $this->player->setStamina(Character::MAX_STAMINA);

        GameApplication::$printer->writeln(sprintf(
            'You healed %d damage',
            $healAmount
        ));
    }

    public function undo(): void
    {
        $this->player->setHealth($this->currentHealth);
        $this->player->setStamina($this->stamina);
    }
}
