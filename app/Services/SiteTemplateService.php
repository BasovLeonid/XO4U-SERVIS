<?php

namespace App\Services;

use App\Models\SiteTemplate;
use App\Models\SiteTemplateBlock;
use App\Models\SiteTemplateVariable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteTemplateService
{
    public function createTemplate(array $data): SiteTemplate
    {
        return SiteTemplate::create($data);
    }

    public function updateTemplate(SiteTemplate $template, array $data): SiteTemplate
    {
        $template->update($data);
        return $template;
    }

    public function deleteTemplate(SiteTemplate $template): bool
    {
        // Удаляем директорию с файлами шаблона
        $templatePath = 'store/site_templates/' . $template->template_code;
        if (Storage::exists($templatePath)) {
            Storage::deleteDirectory($templatePath);
        }

        return $template->delete();
    }

    public function createBlock(SiteTemplate $template, array $data): SiteTemplateBlock
    {
        $block = $template->blocks()->create($data);
        
        // Создаем файл блока
        $this->createBlockFile($block);
        
        return $block;
    }

    public function updateBlock(SiteTemplateBlock $block, array $data): SiteTemplateBlock
    {
        $block->update($data);
        return $block;
    }

    public function deleteBlock(SiteTemplateBlock $block): bool
    {
        // Удаляем файл блока
        $this->deleteBlockFile($block);
        
        return $block->delete();
    }

    public function createVariable(SiteTemplate $template, array $data): SiteTemplateVariable
    {
        return $template->variables()->create($data);
    }

    public function updateVariable(SiteTemplateVariable $variable, array $data): SiteTemplateVariable
    {
        $variable->update($data);
        return $variable;
    }

    public function deleteVariable(SiteTemplateVariable $variable): bool
    {
        return $variable->delete();
    }

    protected function createTemplateDirectories(SiteTemplate $template): void
    {
        $basePath = storage_path("app/store/site_templates/{$template->template_code}");
        
        // Создаем основные директории
        File::makeDirectory($basePath, 0755, true);
        File::makeDirectory("{$basePath}/blocks", 0755, true);
        File::makeDirectory("{$basePath}/assets", 0755, true);
        File::makeDirectory("{$basePath}/assets/images", 0755, true);
        File::makeDirectory("{$basePath}/assets/css", 0755, true);
        File::makeDirectory("{$basePath}/assets/js", 0755, true);
    }

    protected function deleteTemplateDirectories(SiteTemplate $template): void
    {
        $path = storage_path("app/store/site_templates/{$template->template_code}");
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }

    protected function createDefaultConfig(SiteTemplate $template): void
    {
        $config = [
            'name' => $template->name,
            'template_code' => $template->template_code,
            'version' => '1.0.0',
            'blocks' => [],
            'variables' => []
        ];

        File::put(
            $template->getConfigPath(),
            json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    protected function createBlockFile(SiteTemplateBlock $block): void
    {
        $content = <<<BLADE
<div class="block-{$block->block_code}">
    {{-- Содержимое блока {$block->name} --}}
</div>
BLADE;

        File::put($block->getBlockPath(), $content);
    }

    protected function deleteBlockFile(SiteTemplateBlock $block): void
    {
        if (File::exists($block->getBlockPath())) {
            File::delete($block->getBlockPath());
        }
    }
} 