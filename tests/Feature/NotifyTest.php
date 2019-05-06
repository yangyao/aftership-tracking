<?php


use Dotenv\Dotenv;

class NotifyTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $dotenv = Dotenv::create(__DIR__.'/../../');
        $dotenv->load();
    }

    /** @test */
    function it_adds_a_email()
    {
        $tracking = new \Yangyao\AfterShip\Notify(getenv('AFTERSHIP_API_KEY'));
        $data = $tracking->add('dhl','1984332118','y.yang@aftership.com');
        $this->assertJson($data);
    }

    /** @test*/
    function it_show_notify()
    {
        $tracking = new \Yangyao\AfterShip\Notify(getenv('AFTERSHIP_API_KEY'));
        $data = $tracking->notifications('dhl','1984332118');
        $this->assertJson($data);
    }

}