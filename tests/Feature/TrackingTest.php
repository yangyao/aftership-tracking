<?php


class TrackingTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $dotenv = Dotenv\Dotenv::create(__DIR__.'/../../');
        $dotenv->load();
    }

    /** @test  */
    public function it_returns_couriers_json()
    {
        $tracking = new \Yangyao\AfterShip\Tracking(getenv('AFTERSHIP_API_KEY'));
        $data = $tracking->couriers();
        $this->assertJson($data);

    }
    /** @test */
    public function it_returns_tracking_id()
    {
        $tracking = new \Yangyao\AfterShip\Tracking(getenv('AFTERSHIP_API_KEY'));
        try{
            $data = $tracking->create('1984332118');
            $this->assertJson($data);
            $dataArray = json_decode($data,true);
            $this->assertArrayHasKey('data',$dataArray);
            $this->assertArrayHasKey('tracking',$dataArray['data']);
            $this->assertArrayHasKey('id',$dataArray['data']['tracking']);
            var_dump($dataArray);
        }catch (Exception $e){
            // delete exist tracking
            $response = $tracking->delete('dhl','1984332118');
            $this->assertJson($response);
        }

    }

}