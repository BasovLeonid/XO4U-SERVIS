<?php

namespace App\Http\Controllers\YandexDirect;

use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignBidAdjustmentController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignExclusionController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignMetricController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignNegativeKeywordController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignNetworkStrategyController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignScheduleController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignSearchStrategyController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignSettingController;
use App\Http\Controllers\YandexDirect\TableControllers\CampaignBasicController;

class CampaignController extends Controller
{
    protected $tableControllers;

    public function __construct()
    {
        $this->tableControllers = [
            'basic' => new CampaignBasicController(),
            'settings' => new CampaignSettingController(),
            'bidAdjustments' => new CampaignBidAdjustmentController(),
            'exclusions' => new CampaignExclusionController(),
            'metrics' => new CampaignMetricController(),
            'negativeKeywords' => new CampaignNegativeKeywordController(),
            'networkStrategy' => new CampaignNetworkStrategyController(),
            'schedule' => new CampaignScheduleController(),
            'searchStrategy' => new CampaignSearchStrategyController()
        ];
    }

    /**
     * Отображение списка кампаний
     *
     * @return \Illuminate\View\View
     */
    /*
    public function index()
    {
        $campaigns = Campaign::with(['settings', 'placements', 'schedule', 'corrections', 'additional'])
            ->paginate(10);
        return view('yandex-direct.campaigns.index', compact('campaigns'));
    }
    */

    /**
     * Отображение формы создания кампании
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        // Получаем параметры из GET-запроса
        $type = $request->get('type', 'users');
        $templateId = $request->get('id_template');
        $back = $request->get('back');
        
        \Log::info('Template data:', [
            'type' => $type,
            'template_id' => $templateId,
            'back' => $back,
            'all_parameters' => $request->all()
        ]);
        
        $campaign = Campaign::create([
            'name' => 'Новая кампания',
            'status' => 'draft',
            'type' => $type,
            'template_id' => $templateId
        ]);

        // Формируем URL для редиректа
        $redirectUrl = route('interface.yandex-direct.settings', ['campaign' => $campaign->id]);
        $redirectUrl .= '?type=' . $type;
        if ($templateId) {
            $redirectUrl .= '&id_template=' . $templateId;
        }
        if ($back) {
            $redirectUrl .= '&back=' . urlencode($back);
        }

        return redirect($redirectUrl)
            ->with('success', 'Кампания успешно создана');
    }

    /**
     * Сохранение новой кампании
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*
    public function store(Request $request)
    {
        $validated = Campaign::validate($request->all());
        $campaign = Campaign::create($validated);

        return redirect()
            ->route('boss.direct-templates.campaigns.edit', $campaign)
            ->with('success', 'Кампания успешно создана');
    }
    */

    /**
     * Отображение кампании
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function show(Campaign $campaign)
    {
        $campaign->load(['settings', 'placements', 'schedule', 'corrections', 'additional']);
        return view('yandex-direct.campaigns.show', compact('campaign'));
    }
    */

    /**
     * Отображение страницы настроек кампании
     *
     * @param Request $request
     * @param int $campaign
     * @return \Illuminate\View\View
     */
    public function settings(Request $request, $campaign)
    {
        // Получаем основную кампанию и преобразуем в коллекцию
        $campaign = collect([Campaign::findOrFail($campaign)]);
        
        // Получаем данные в указанном порядке
        $searchStrategies = $campaign->first()->searchStrategies()->get();
        $networkStrategies = $campaign->first()->networkStrategies()->get();
        $metrics = $campaign->first()->metrics()->get();
        $schedule = $campaign->first()->schedule()->get();
        $bidAdjustments = $campaign->first()->bidAdjustments()->get();
        $negativeKeywords = $campaign->first()->negativeKeywords()->get();
        $exclusions = $campaign->first()->exclusions()->get();
        $settings = $campaign->first()->settings()->get();
            
        // Получаем параметры из сессии или из GET-запроса
        $type = session('type', $request->get('type'));
        $templateId = session('id_template', $request->get('id_template'));
        $back = session('back', $request->get('back'));
            
        return view('yandex-direct.interface_setting', [
            'campaign' => $campaign,
            'searchStrategies' => $searchStrategies,
            'networkStrategies' => $networkStrategies,
            'metrics' => $metrics,
            'schedule' => $schedule,
            'bidAdjustments' => $bidAdjustments,
            'negativeKeywords' => $negativeKeywords,
            'exclusions' => $exclusions,
            'settings' => $settings,
            'type' => $type,
            'template_id' => $templateId,
            'back' => $back
        ]);
    }

    /**
     * Отображение страницы расписания
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function schedule(Campaign $campaign)
    {
        $campaign->load('schedule');
        return view('yandex-direct.campaigns.schedule', compact('campaign'));
    }
    */

    /**
     * Отображение страницы корректировок
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function corrections(Campaign $campaign)
    {
        $campaign->load('corrections');
        return view('yandex-direct.campaigns.corrections', compact('campaign'));
    }
    */

    /**
     * Отображение страницы дополнительных настроек
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function additionalSettings(Campaign $campaign)
    {
        $campaign->load('additional');
        return view('yandex-direct.campaigns.additional-settings', compact('campaign'));
    }
    */

    /**
     * Обновление настроек кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function updateSettings(Request $request, Campaign $campaign)
    {   
        \Log::info('Начало обновления настроек кампании', [
            'campaign_id' => $campaign->id,
            'request_data' => $request->all()
        ]);

        try {
            DB::beginTransaction();

            // Обновляем базовые настройки
            $campaign->update([
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'url' => $request->input('url')
            ]);

            // Обновляем данные через соответствующие контроллеры
            foreach ($this->tableControllers as $section => $controller) {
                $controller->update($request, $campaign->id);
            }

            DB::commit();

            \Log::info('Успешное обновление настроек кампании', [
                'campaign_id' => $campaign->id
            ]);

            return redirect()
                ->back()
                ->with('success', 'Настройки кампании успешно обновлены');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Ошибка при обновлении настроек кампании: ' . $e->getMessage(), [
                'campaign_id' => $campaign->id,
                'data' => $request->all(),
                'exception' => $e
            ]);

            return redirect()
                ->back()
                ->with('error', 'Ошибка при обновлении настроек: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Обновление отдельного раздела настроек
     *
     * @param Request $request
     * @param Campaign $campaign
     * @param string $section
     * @return JsonResponse
     */
    public function updateSettingsSection(Request $request, Campaign $campaign, string $section): JsonResponse
    {
        if (!isset($this->tableControllers[$section])) {
            return response()->json([
                'success' => false,
                'message' => 'Неизвестный раздел настроек'
            ], 400);
        }

        return $this->tableControllers[$section]->update($request, $campaign->id);
    }

    /**
     * Удаление кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Campaign $campaign)
    {
        try {
            $campaign->delete();

            // Получаем URL для возврата из GET-параметра
            $backUrl = $request->get('back');

            return redirect($backUrl)
                ->with('success', 'Кампания успешно удалена');
        } catch (\Exception $e) {
            \Log::error('Ошибка при удалении кампании: ' . $e->getMessage(), [
                'campaign_id' => $campaign->id,
                'exception' => $e
            ]);

            return redirect()->back()
                ->with('error', 'Ошибка при удалении кампании: ' . $e->getMessage());
        }
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
            'additional'
        ])->find(request()->route('campaign'));

        return array_merge(
            $campaign->toArray(),
            $campaign->settings->toArray(),
            $campaign->placements->toArray(),
            $campaign->schedule->toArray(),
            $campaign->corrections->toArray(),
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