<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateFixturesCommand extends Command
{
    protected static $defaultName = 'app:create-fixtures';

    protected function configure()
    {
        $this
            ->setDescription('Commande pour lancer les fixtures')
            ->addArgument('module', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $module = $input->getArgument('module');

        if ($module) {
            $io->note(sprintf('You passed an argument: %s', $module));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('La fixture a été exécutée');

        return 0;
    }
}
