<?php

namespace App\Command;

use App\Entity\Module;
use App\Entity\Type;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->setDescription('Commande pour lancer les fixtures')
            // Ajout de l'option clear pour vider la BDD avant de créer une nouvelle fixture en BDD
            ->addOption('clear', null, InputOption::VALUE_NONE, 'Pour vider la BDD avant de lancer une fixture')
        ;
    }

    public function createModuleFixture($name, $type, $active, $displayActive, $uptime, $displayUptime, $temperatue, $displayTemperature, $dataSent, $displayDataSent)
    {
        // Définition des propriétés d'un objet Module
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

        // On envoie les données en BDD
        $this->em->persist($module);
        $this->em->flush();
    }

    public function createTypeFixture($name, $code)
    {
        // Définition des propriétés d'un objet Type
        $type = new Type();
        $type->setName($name);
        $type->setCode($code);

        $this->em->persist($type);
        $this->em->flush();

        return $type;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // A l'exécution de la commande, si l'option "clear" existe, on purge la BDD
        if ($input->getOption('clear') == true) {
            $purger = new ORMPurger($this->em);
            $purger->purge();
        }
        

        $io = new SymfonyStyle($input, $output);

        // Création des différents Types
        $typeHeater = $this->createTypeFixture("Chauffage", "HEATER");
        $typeLight = $this->createTypeFixture("Eclairage", "LIGHT");
        $typeAppliance = $this->createTypeFixture("Appareil", "APPLIANCE");

        // Création des différents modules reprenant les types créés ci dessus
        $this->createModuleFixture("Chauffage Salon", $typeHeater, true, true, 30, true, 19, true, 50, true);
        $this->createModuleFixture("Chauffage Cuisine", $typeHeater, false, true, null, false, null, false, null, false);
        $this->createModuleFixture("Lumière salon", $typeLight, true, true, 45, true, null, false, false, false);
        $this->createModuleFixture("Lumière cuisine", $typeLight, false, true, null, false, null, false, null, false);
        $this->createModuleFixture("TV salon", $typeAppliance, true, true, 60, true, null, false, 150, true);
        $this->createModuleFixture("TV cuisine", $typeAppliance, false, true, null, false, null, false, null, false);


        $io->success('La fixture a été exécutée');

        return 0;
    }
}
