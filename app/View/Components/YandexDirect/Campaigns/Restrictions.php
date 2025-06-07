<?php

namespace App\View\Components\YandexDirect\Campaigns;

use Illuminate\View\Component;

class Restrictions extends Component
{
    public $campaign;

    public function __construct($campaign = null)
    {
        $this->campaign = $campaign;
    }

    public function render()
    {
        return view('yandex_direct.campaigns.restrictions');
    }
} 