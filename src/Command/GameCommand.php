<?php

namespace App\Command;

use App\Character\Character;
use App\FightResultSet;
use App\GameApplication;
use App\Printer\MessagePrinter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:game:play')]
class GameCommand extends Command
{
    public function __construct(
        private readonly GameApplication $game,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('cheatCode', 'c', InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Static field so we can print messages from anywhere
        GameApplication::$printer = new MessagePrinter($io);

        $io->section('Welcome to the game where warriors fight against each other for honor and glory... and 🍕!');

        if ($input->getOption('cheatCode')) {
            $this->game->activateCheatCode($input->getOption('cheatCode'));
        }

        $characters = $this->game->getCharactersList();
        $playerChoice = $io->choice('Select your character', $characters);

        $playerCharacter = $this->game->createCharacter($playerChoice);
        $playerCharacter->setNickname($playerChoice);

        GameApplication::$printer->initPlayerPrinters($playerCharacter->getId());

        $this->play($playerCharacter);

        return Command::SUCCESS;
    }

    private function play(Character $player): void
    {
        GameApplication::$printer->writeln(sprintf('Alright %s! It\'s time to fight!',
            $player->getNickname()
        ));

        $fightResultSet = new FightResultSet($player->getId());

        do {
            // let's make it *feel* like a proper battle!
            $weapons = ['🛡', '⚔️', '🏹'];
            GameApplication::$printer->writeln('');
            GameApplication::$printer->write('(Searching for a worthy opponent) ');
            for ($i = 0; $i < 4; $i++) {
                GameApplication::$printer->write($weapons[array_rand($weapons)]);
                usleep(250000);
            }
            GameApplication::$printer->writeln(['', '']);

            $aiCharacter = $this->game->createAiCharacter();

            GameApplication::$printer->writeln(sprintf('Opponent Found: <comment>%s</comment>', $aiCharacter->getNickname()));
            GameApplication::$printer->writeln('');
            usleep(300000);

            $fightResultSet->add($aiCharacter->getId());
            $this->game->play($player, $aiCharacter, $fightResultSet);

            if ($fightResultSet->getWinner() === $player) {
                $this->game->victory($player, $fightResultSet->of($player));
            } else {
                $this->game->defeat($player, $fightResultSet->of($player));
            }

            $this->printResult($fightResultSet, $player);

            $fightResultSet->remove($aiCharacter->getId());
            $fightResultSet->resetRounds();
            $fightResultSet->of($player)->prepareForNextMatch();

            $answer = GameApplication::$printer->choice('Want to keep playing?', [
                1 => 'Fight!',
                2 => 'Exit Game',
            ]);
        } while ($answer === 'Fight!');
    }

    private function printResult(FightResultSet $fightResultSet, Character $player): void
    {
        GameApplication::$printer->writeln('');

        GameApplication::$printer->writeln('------------------------------');
        if ($fightResultSet->getWinner() === $player) {
            GameApplication::$printer->writeln('Result: <bg=green;fg=white>You WON!</>');
        } else {
            GameApplication::$printer->writeln('Result: <bg=red;fg=white>You lost...</>');
        }

        $fightResult = $fightResultSet->of($player);
        GameApplication::$printer->writeln('Total Rounds: ' . $fightResultSet->getRounds());
        GameApplication::$printer->writeln('Damage dealt: ' . $fightResult->getDamageDealt());
        GameApplication::$printer->writeln('Damage received: ' . $fightResult->getDamageReceived());
        GameApplication::$printer->writeln('Level: ' . $player->getLevel());
        GameApplication::$printer->writeln('XP: ' . $player->getXp());
        GameApplication::$printer->writeln('Win Streak: ' . $fightResult->getWinStreak());
        GameApplication::$printer->writeln('Lose Streak: ' . $fightResult->getLoseStreak());
        GameApplication::$printer->writeln('------------------------------');
    }
}
