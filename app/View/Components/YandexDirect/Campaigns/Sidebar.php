<?php

namespace App\YandexDirect\Components\Campaigns;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $campaign;
    public $activeSection;

    public function __construct($campaign = null, $activeSection = 'basic')
    {
        $this->campaign = $campaign;
        $this->activeSection = $activeSection;
    }

    public function render()
    {
        return view('yandex-direct::campaigns.partials.sidebar');
    }
} 