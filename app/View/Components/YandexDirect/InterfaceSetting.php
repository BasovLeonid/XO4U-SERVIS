<?php

namespace App\View\Components\YandexDirect\Campaigns;

use Illuminate\View\Component;
use App\Models\YandexDirect\Campaign;

class InterfaceSetting extends Component
{
    public $campaign;
    public $counters;
    public $goals;
    public $template;

    /**
     * Создание нового экземпляра компонента.
     *
     * @param Campaign $campaign
     * @param array $counters
     * @param array $goals
     * @param string|null $template
     */
    public function __construct(Campaign $campaign, array $counters = [], array $goals = [], ?string $template = null)
    {
        $this->campaign = $campaign;
        $this->counters = $counters;
        $this->goals = $goals;
        $this->template = $template;
    }

    /**
     * Получение представления / содержимого, которое представляет компонент.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('yandex-direct.interface_setting', [
            'campaign' => $this->campaign,
            'counters' => $this->counters,
            'goals' => $this->goals,
            'template' => $this->template
        ]);
    }
} 