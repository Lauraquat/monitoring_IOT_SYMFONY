<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\MyCustomNativeLoader;
use App\Entity\Module;
use App\Entity\Type;

class AppFixtures extends Fixture
{

    public function createModuleFixture($name, $type, $active, $displayActive, $uptime, $displayUptime, $temperatue, $displayTemperature, $dataSent, $displayDataSent)
    {
        $module = new Module();
        $module->setName($name);
        $module->setType($type);
        $module->setDescription("Description de ". $name);
        $module->setActive($active);
        $module->setDisplayActive($displayActive);
        $module->setUptime($uptime);
        $module->setDisplayUptime($displayUptime);
        $module->setTemperature($temperatue);
        $module->setDisplayTemperature($displayTemperature);
        $module->setDataSent($dataSent);
        $module->setDisplayDataSent($displayDataSent);

        $this->em->persist($module);
    }

    public function createTypeFixture($name, $code)
    {
        $type = new Type();
        $type->setName($name);
        $type->setCode($code);

        $this->em->persist($type);
    }


    public function load(ObjectManager $em)
    {
        $loader = new MyCustomNativeLoader();
        
        //importe le fichier de fixtures et récupère les entités générés
        $entities = $loader->loadFile(__DIR__.'/fixtures.yaml')->getObjects();
        
        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {
            $em->persist($entity);
        };
        
        //enregistre
        $em->flush();
    }
}
