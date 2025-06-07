<?php

namespace App\View\Components\YandexDirect\Campaigns;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $campaign;

    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    public function render()
    {
        return view('yandex_direct.campaigns.sidebar');
    }
} 