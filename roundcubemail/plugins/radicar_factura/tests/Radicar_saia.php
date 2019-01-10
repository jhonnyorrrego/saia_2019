<?php

class Radicar_saia_Plugin extends PHPUnit_Framework_TestCase
{

    function setUp()
    {
        include_once __DIR__ . '/../radicar_factura.php';
    }

    /**
     * Plugin object construction test
     */
    function test_constructor()
    {
        $rcube  = rcube::get_instance();
        $plugin = new markasjunk($rcube->api);

        $this->assertInstanceOf('radicar_factura', $plugin);
        $this->assertInstanceOf('rcube_plugin', $plugin);
    }
}

