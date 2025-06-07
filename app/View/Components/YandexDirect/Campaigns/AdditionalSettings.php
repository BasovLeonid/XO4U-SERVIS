<?php

namespace App\YandexDirect\Components\Campaigns;

use Illuminate\View\Component;

class AdditionalSettings extends Component
{
    public $campaign;

    public function __construct($campaign = null)
    {
        $this->campaign = $campaign;
    }

    public function render()
    {
        return view('yandex-direct::campaigns.settings.additional');
    }
} 