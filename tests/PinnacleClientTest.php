<?php

namespace Armandsar\PinnaclePineapple\Test;

use Armandsar\PinnaclePineapple\PinnacleClient;
use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;

class PinnacleClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_returns_odds()
    {
        list($guzzleClientMock, $configMock) = $this->injections();

        $guzzleClientMock->shouldReceive('request->getBody->getContents')->once()->andReturn('{"something":"else"}');
        $class = new PinnacleClient($guzzleClientMock, $configMock);

        $odds = $class->since(5)->odds();

        $expected = ["something" => "else"];

        $this->assertEquals($expected, $odds);
    }

    /**
     * @test
     */
    public function it_returns_fixtures()
    {
        list($guzzleClientMock, $configMock) = $this->injections();

        $guzzleClientMock->shouldReceive('request->getBody->getContents')->once()->andReturn('{"something":"else"}');
        $class = new PinnacleClient($guzzleClientMock, $configMock);

        $fixtures = $class->since(5)->fixtures();

        $expected = ["something" => "else"];

        $this->assertEquals($expected, $fixtures);
    }

    /**
     * @test
     */
    public function it_returns_settled_fixtures()
    {
        list($guzzleClientMock, $configMock) = $this->injections();

        $guzzleClientMock->shouldReceive('request->getBody->getContents')->once()->andReturn('{"something":"else"}');
        $class = new PinnacleClient($guzzleClientMock, $configMock);

        $fixtures = $class->since(5)->settledFixtures();

        $expected = ["something" => "else"];

        $this->assertEquals($expected, $fixtures);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @return array
     */
    private function injections()
    {
        $guzzleClientMock = \Mockery::mock(Client::class);
        $configMock = \Mockery::mock(Repository::class);
        $configMock->shouldReceive('get')->with('pinnacle_pineapple.user')->once()->andReturn('user');
        $configMock->shouldReceive('get')->with('pinnacle_pineapple.password')->once()->andReturn('password');
        return array($guzzleClientMock, $configMock);
    }
}
