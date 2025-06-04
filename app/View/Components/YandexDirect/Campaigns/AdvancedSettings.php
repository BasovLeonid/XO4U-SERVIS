<?php

namespace App\View\Components\YandexDirect\Campaigns;

use Illuminate\View\Component;

class AdvancedSettings extends Component
{
    public $campaign;
    public $counters;
    public $goals;

    public function __construct($campaign = null, $counters = [], $goals = [])
    {
        $this->campaign = $campaign;
        $this->counters = $counters;
        $this->goals = $goals;
    }

    public function render()
    {
        return view('yandex_direct.campaigns.advanced_settings');
    }
} 