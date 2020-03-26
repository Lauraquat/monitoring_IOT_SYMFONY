<?php

namespace App\DataFixtures\Faker;

use \Faker\Provider\Base as BaseProvider;

class TypeProvider extends BaseProvider{

    protected static $typeName = [
        'Chauffage',
        'Eclairage',
        'Appareil',
        'Volet',
        'prise',
        
    ];

    protected static $typeCode = [
        'HEATER',
        'LIGHT',
        'APPLIANCE',
        'SHUTTER',
        'PLUG',
    ];

    public static function typeName(){
        return static::randomElement(static::$typeName);
    }

    public static function typeCode(){
        return static::randomElement(static::$typeCode);
    }
}