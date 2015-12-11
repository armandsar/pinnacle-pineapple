<?php

namespace Armandsar\PinnaclePineapple;

class PinnacleClient extends BaseApiClient
{
    private $since = null;

    public function since($when)
    {
        $this->since = $when;
        return $this;
    }

    public function odds($options = [])
    {
        $default = ['oddsFormat' => 'DECIMAL'];

        return $this->get('odds', array_merge($default, $options));
    }

    public function fixtures($options = [])
    {
        $default = [];
        if (!is_null($this->since)) {
            $default['since'] = $this->since;
            $this->since = null;
        }

        return $this->get('fixtures', array_merge($default, $options));
    }

    public function settledFixtures($options = [])
    {
        $default = [];
        if (!is_null($this->since)) {
            $default['since'] = $this->since;
            $this->since = null;
        }

        return $this->get('fixtures/settled', array_merge($default, $options));
    }

    public function leagues($options = [])
    {
        $leaguesRaw = $this->get('leagues', $options, 'parseXml');

        $leagues = [];

        foreach ($leaguesRaw->leagues->league as $value) {
            $leagues[] = [
                'id' => (int)$value->attributes()['id'],
                'league' => (string)$value,
            ];
        }

        return $leagues;
    }

    public function sports()
    {
        $sportsRaw = $this->get('sports', [], 'parseXml');

        $sports = [];

        foreach ($sportsRaw->sports->sport as $value) {
            $sports[] = [
                'id' => (int)$value->attributes()['id'],
                'sport' => (string)$value,
            ];
        }

        return $sports;
    }

}
