<?php

namespace Armandsar\PinnaclePineapple;

class PinnacleClient extends BaseApiClient
{
    private $since = null;

    public function since($when)
    {
        if ($when) {
            $this->since = $when;
        }

        return $this;
    }

    public function odds($options = [])
    {
        $default = $this->useSince(['oddsFormat' => 'DECIMAL']);

        return $this->get('odds', 'v1', array_merge($default, $options));
    }

    public function specialOdds($options = [])
    {
        $default = $this->useSince(['oddsFormat' => 'DECIMAL']);

        return $this->get('odds/special', 'v1', array_merge($default, $options));
    }

    public function fixtures($options = [])
    {
        $default = $this->useSince();

        return $this->get('fixtures', 'v1', array_merge($default, $options));
    }

    public function specialFixtures($options = [])
    {
        $default = $this->useSince();

        return $this->get('fixtures/special', 'v1', array_merge($default, $options));
    }

    public function settledFixtures($options = [])
    {
        $default = $this->useSince();

        return $this->get('fixtures/settled', 'v1', array_merge($default, $options));
    }

    public function leagues($options = [])
    {
        $data = $this->get('leagues', 'v2', $options);

        return $data['leagues'];
    }

    public function sports()
    {
        $data = $this->get('sports', 'v2');

        return $data['sports'];
    }

    public function inrunnings()
    {
        $data = $this->get('inrunning', 'v1');

        return $data['sports'];
    }
    
    private function useSince($default = [])
    {
        if (!is_null($this->since)) {
            $default['since'] = $this->since;
            $this->since = null;
            return $default;
        }
        return $default;
    }

}
