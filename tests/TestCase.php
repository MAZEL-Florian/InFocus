<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected function setUp(): void
    {
        parent::setUp();
    
        if (config('database.connections.mysql.database') !== 'infocus_tests') {
            die("🚨 ERREUR: La base de tests n'est pas configurée correctement !");
        }
    }
    

}
