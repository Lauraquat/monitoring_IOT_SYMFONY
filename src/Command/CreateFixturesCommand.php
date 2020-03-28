<?php

namespace App\Command;

use App\Entity\Module;
use App\Entity\Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateFixturesCommand extends Command
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected static $defaultName = 'app:create-fixtures';

    protected function configure()
    {
        $this
            ->setDescription('Commande pour lancer les fixtures');
    }

    public function createModuleFixture($name, $type, $active, $displayActive, $uptime, $displayUptime, $temperatue, $displayTemperature, $dataSent, $displayDataSent)
    {
        $module = new Module();
        $module->setName($name);
        $module->setType($type);
        $module->setDescription("Description de " . $name);
        $module->setActive($active);
        $module->setDisplayActive($displayActive);
        $module->setUptime($uptime);
        $module->setDisplayUptime($displayUptime);
        $module->setTemperature($temperatue);
        $module->setDisplayTemperature($displayTemperature);
        $module->setDataSent($dataSent);
        $module->setDisplayDataSent($displayDataSent);

        $this->em->persist($module);
        $this->em->flush();
    }

    public function createTypeFixture($name, $code)
    {
        $type = new Type();
        $type->setName($name);
        $type->setCode($code);

        $this->em->persist($type);
        $this->em->flush();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $typeHeater = $this->createTypeFixture("Chauffage", "HEATER");
        $typeLight = $this->createTypeFixture("Eclairage", "LIGHT");
        $typePlug = $this->createTypeFixture("Prise", "PLUG");



        $this->createModuleFixture("Chauffage Salon", $typeHeater, true, true, 30, true, 19, true, 214, true);
        $this->createModuleFixture("Chauffage Cuisine", $typeHeater, false, true, null, false, null, false, null, false);
        $this->createModuleFixture("Lumière salon", $typeLight, true, true, 45, true, false, false, false, false);
        $this->createModuleFixture("Lumière cuisine", $typeLight, false, true, null, false, null, false, null, false);
        $this->createModuleFixture("TV salon", $typePlug, true, true, 60, true, false, false, 1462, true);
        $this->createModuleFixture("TV cuisine", $typePlug, false, true, null, false, null, false, null, false);


        $io->success('La fixture a été exécutée');

        return 0;
    }
}
