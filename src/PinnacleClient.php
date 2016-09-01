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

        return $this->get('odds', 'v1', array_merge($default, $options));
    }

    public function fixtures($options = [])
    {
        $default = [];
        if (!is_null($this->since)) {
            $default['since'] = $this->since;
            $this->since = null;
        }

        return $this->get('fixtures', 'v1', array_merge($default, $options));
    }

    public function settledFixtures($options = [])
    {
        $default = [];
        if (!is_null($this->since)) {
            $default['since'] = $this->since;
            $this->since = null;
        }

        return $this->get('fixtures/settled', 'v1', array_merge($default, $options));
    }

    public function leagues($options = [])
    {
        $leaguesRaw = $this->get('leagues', 'v1', $options, 'parseXml');

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
        $data = $this->get('sports', 'v2');

        return $data['sports'];
    }

}
