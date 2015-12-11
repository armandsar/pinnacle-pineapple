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

    /**
     * @test
     */
    public function it_returns_leagues()
    {
        list($guzzleClientMock, $configMock) = $this->injections();

        $guzzleClientMock->shouldReceive('request->getBody->getContents')->once()
            ->andReturn('<rsp status="ok">
                          <sportId>2</sportId>
                          <leagues>
                            <league id="1" homeTeamType="Team1" feedContents="0" allowRoundRobins="0">One</league>
                            <league id="2" homeTeamType="Team1" feedContents="0" allowRoundRobins="0">Two</league>
                          </leagues>
                        </rsp>');
        $class = new PinnacleClient($guzzleClientMock, $configMock);

        $leagues = $class->since(5)->leagues();

        $expected = [
            ['id' => 1, 'league' => 'One'],
            ['id' => 2, 'league' => 'Two'],
        ];

        $this->assertEquals($expected, $leagues);
    }

    /**
     * @test
     */
    public function it_returns_sports()
    {
        list($guzzleClientMock, $configMock) = $this->injections();

        $guzzleClientMock->shouldReceive('request->getBody->getContents')->once()
            ->andReturn('<rsp status="ok">
                            <sports>
                                <sport id="1" feedContents="0">Badminton</sport>
                                <sport id="3" feedContents="1">Baseball</sport>
                            </sports>
                        </rsp>
                        ');
        $class = new PinnacleClient($guzzleClientMock, $configMock);

        $sports = $class->since(5)->sports();

        $expected = [
            ['id' => 1, 'sport' => 'Badminton'],
            ['id' => 3, 'sport' => 'Baseball'],
        ];

        $this->assertEquals($expected, $sports);
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
