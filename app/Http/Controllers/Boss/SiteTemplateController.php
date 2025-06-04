<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\SiteTemplate;
use App\Services\SiteTemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use ZipArchive;

class SiteTemplateController extends Controller
{
    protected $siteTemplateService;

    public function __construct(SiteTemplateService $siteTemplateService)
    {
        $this->siteTemplateService = $siteTemplateService;
    }

    public function index()
    {
        $templates = SiteTemplate::latest()->paginate(12);
        return view('boss.site_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('boss.site_templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'template_code' => 'required|string|max:50|unique:site_templates',
            'description' => 'nullable|string',
            'preview_image' => 'required|image|mimes:jpeg,jpg,webp|max:250|dimensions:width=640,height=360',
            'template_zip' => 'required|file|mimes:zip|max:51200' // 50MB в килобайтах
        ]);

        try {
            // Обработка превью
            if ($request->hasFile('preview_image')) {
                $image = $request->file('preview_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                $path = 'site_templates/previews';
                if (!Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->makeDirectory($path);
                }

                $img = Image::make($image);
                $img->fit(640, 360);
                $img->save(storage_path('app/public/' . $path . '/' . $imageName));

                $validated['preview_image'] = $path . '/' . $imageName;
            }

            // Обработка ZIP-архива
            if ($request->hasFile('template_zip')) {
                $zip = $request->file('template_zip');
                $templatePath = 'site_templates/' . $validated['template_code'];

                // Создаем директорию для шаблона
                if (!Storage::exists($templatePath)) {
                    Storage::makeDirectory($templatePath);
                }

                // Распаковываем архив
                $zipArchive = new ZipArchive;
                if ($zipArchive->open($zip->getRealPath()) === true) {
                    $zipArchive->extractTo(storage_path('app/' . $templatePath));
                    $zipArchive->close();

                    // Проверяем наличие основных файлов
                    if (!Storage::exists($templatePath . '/template.blade.php')) {
                        throw new \Exception('В архиве отсутствует файл template.blade.php');
                    }

                    // Создаем шаблон в базе данных
                    $template = $this->siteTemplateService->createTemplate($validated);

                    return redirect()
                        ->route('boss.site-templates.show', $template)
                        ->with('success', 'Шаблон успешно создан');
                } else {
                    throw new \Exception('Не удалось распаковать архив');
                }
            }
        } catch (\Exception $e) {
            // Удаляем загруженные файлы в случае ошибки
            if (isset($validated['preview_image'])) {
                Storage::disk('public')->delete($validated['preview_image']);
            }
            if (isset($templatePath)) {
                Storage::deleteDirectory($templatePath);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка при создании шаблона: ' . $e->getMessage()]);
        }
    }

    public function show(SiteTemplate $siteTemplate)
    {
        $template = $siteTemplate->load(['blocks', 'variables']);
        return view('boss.site_templates.show', compact('template'));
    }

    public function edit(SiteTemplate $siteTemplate)
    {
        $template = $siteTemplate;
        return view('boss.site_templates.edit', compact('template'));
    }

    public function update(Request $request, SiteTemplate $siteTemplate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'template_code' => 'required|string|max:50|unique:site_templates,template_code,' . $siteTemplate->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,draft,archived',
            'preview_image' => 'nullable|image|mimes:jpeg,jpg,webp|max:250|dimensions:width=640,height=360'
        ]);

        if ($request->hasFile('preview_image')) {
            $image = $request->file('preview_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            $path = 'site_templates/previews';
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            $img = Image::make($image);
            $img->fit(640, 360);
            $img->save(storage_path('app/public/' . $path . '/' . $imageName));

            if ($siteTemplate->preview_image) {
                Storage::disk('public')->delete($siteTemplate->preview_image);
            }

            $validated['preview_image'] = $path . '/' . $imageName;
        }

        $template = $this->siteTemplateService->updateTemplate($siteTemplate, $validated);

        return redirect()
            ->route('boss.site-templates.show', $template)
            ->with('success', 'Шаблон успешно обновлен');
    }

    public function destroy(SiteTemplate $siteTemplate)
    {
        if ($siteTemplate->preview_image) {
            Storage::disk('public')->delete($siteTemplate->preview_image);
        }

        $this->siteTemplateService->deleteTemplate($siteTemplate);

        return redirect()
            ->route('boss.site-templates.index')
            ->with('success', 'Шаблон успешно удален');
    }

    public function preview(SiteTemplate $siteTemplate)
    {
        \Log::info('Preview method called for template: ' . $siteTemplate->id);
        \Log::info('Template code: ' . $siteTemplate->template_code);
        \Log::info('Request URL: ' . request()->url());
        \Log::info('Request Method: ' . request()->method());
        
        // Проверяем существование файла шаблона
        $templatePath = 'store/site_templates/' . $siteTemplate->template_code . '/template.blade.php';
        $fullPath = storage_path('app/' . $templatePath);
        
        \Log::info('Checking template path: ' . $templatePath);
        \Log::info('Full storage path: ' . $fullPath);
        \Log::info('File exists: ' . (file_exists($fullPath) ? 'true' : 'false'));
        
        if (!file_exists($fullPath)) {
            \Log::error('Template file not found at path: ' . $fullPath);
            abort(404, 'Файл шаблона не найден');
        }

        // Получаем все переменные шаблона
        $variables = $siteTemplate->variables()->get()->pluck('default_value', 'name')->toArray();
        \Log::info('Template variables: ' . json_encode($variables));
        
        // Добавляем базовые переменные
        $variables['template'] = $siteTemplate;
        
        try {
            // Читаем содержимое файла
            $templateContent = file_get_contents($fullPath);
            \Log::info('Template content length: ' . strlen($templateContent));
            
            // Заменяем пути к блокам на прямые включения
            $blocksPath = storage_path('app/store/site_templates/' . $siteTemplate->template_code . '/blocks');
            $templateContent = preg_replace_callback(
                '/@include\(\'site_templates\.' . $siteTemplate->template_code . '\.blocks\.([^\']+)\'\)/',
                function($matches) use ($blocksPath) {
                    $blockFile = $blocksPath . '/' . $matches[1] . '.blade.php';
                    if (file_exists($blockFile)) {
                        return file_get_contents($blockFile);
                    }
                    return '<!-- Block ' . $matches[1] . ' not found -->';
                },
                $templateContent
            );
            
            // Компилируем Blade-шаблон
            $compiler = app('blade.compiler');
            $compiledContent = $compiler->compileString($templateContent);
            
            // Создаем временный файл для скомпилированного шаблона
            $tempFile = tempnam(sys_get_temp_dir(), 'blade_');
            file_put_contents($tempFile, $compiledContent);
            
            // Рендерим шаблон
            return view('site_templates.preview', [
                'template' => $siteTemplate,
                'variables' => $variables,
                'templateContent' => $compiledContent,
                'tempFile' => $tempFile
            ]);
        } catch (\Exception $e) {
            \Log::error('Error rendering template: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            abort(500, 'Ошибка при отображении шаблона: ' . $e->getMessage());
        }
    }
} 