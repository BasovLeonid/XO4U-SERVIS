<?php

namespace App\Http\Controllers\YandexDirect;

use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CampaignController extends BaseDirectController
{
    /**
     * Отображение списка кампаний
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $campaigns = Campaign::with(['settings', 'placements', 'schedule', 'corrections', 'restrictions', 'additional'])
            ->paginate(10);
        return view('yandex-direct.campaigns.index', compact('campaigns'));
    }

    /**
     * Отображение формы создания кампании
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('yandex-direct.campaigns.create');
    }

    /**
     * Сохранение новой кампании
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = Campaign::validate($request->all());
        $campaign = Campaign::create($validated);

        return redirect()
            ->route('boss.direct-templates.campaigns.edit', $campaign)
            ->with('success', 'Кампания успешно создана');
    }

    /**
     * Отображение кампании
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function show(Campaign $campaign)
    {
        $campaign->load(['settings', 'placements', 'schedule', 'corrections', 'restrictions', 'additional']);
        return view('yandex-direct.campaigns.show', compact('campaign'));
    }

    /**
     * Отображение страницы настроек кампании
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function settings(Campaign $campaign)
    {
        $campaign->load(['settings', 'placements', 'schedule', 'corrections', 'restrictions', 'additional']);
        return view('yandex-direct.campaigns.settings', [
            'campaign' => $campaign,
            'counters' => $this->getCounters(),
            'goals' => $this->getGoals()
        ]);
    }

    /**
     * Отображение страницы расписания
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function schedule(Campaign $campaign)
    {
        $campaign->load('schedule');
        return view('yandex-direct.campaigns.schedule', compact('campaign'));
    }

    /**
     * Отображение страницы ограничений
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function restrictions(Campaign $campaign)
    {
        $campaign->load('restrictions');
        return view('yandex-direct.campaigns.restrictions', compact('campaign'));
    }

    /**
     * Отображение страницы корректировок
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function corrections(Campaign $campaign)
    {
        $campaign->load('corrections');
        return view('yandex-direct.campaigns.corrections', compact('campaign'));
    }

    /**
     * Отображение страницы дополнительных настроек
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    public function additionalSettings(Campaign $campaign)
    {
        $campaign->load('additional');
        return view('yandex-direct.campaigns.additional-settings', compact('campaign'));
    }

    /**
     * Обновление настроек кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function updateSettings(Request $request, Campaign $campaign): JsonResponse
    {
        return $this->handleUpdate($request);
    }

    /**
     * Обновление отдельного раздела настроек
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function updateSection(Request $request, Campaign $campaign): JsonResponse
    {
        return $this->handleUpdate($request);
    }

    /**
     * Удаление кампании
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()
            ->route('boss.direct-templates.campaigns.index')
            ->with('success', 'Кампания успешно удалена');
    }

    /**
     * Получение текущих данных кампании
     *
     * @return array
     */
    protected function getCurrentData(): array
    {
        $campaign = Campaign::with([
            'settings',
            'placements',
            'schedule',
            'corrections',
            'restrictions',
            'additional'
        ])->find(request()->route('campaign'));

        return array_merge(
            $campaign->toArray(),
            $campaign->settings->toArray(),
            $campaign->placements->toArray(),
            $campaign->schedule->toArray(),
            $campaign->corrections->toArray(),
            $campaign->restrictions->toArray(),
            $campaign->additional->toArray()
        );
    }

    /**
     * Получение счетчиков Яндекс.Метрики
     *
     * @return array
     */
    protected function getCounters(): array
    {
        // TODO: Реализовать получение счетчиков
        return [];
    }

    /**
     * Получение целей Яндекс.Метрики
     *
     * @return array
     */
    protected function getGoals(): array
    {
        // TODO: Реализовать получение целей
        return [];
    }
} 