<?php

namespace Database\Factories;

use App\Models\SiteTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiteTemplateFactory extends Factory
{
    protected $model = SiteTemplate::class;

    public function definition(): array
    {
        return [
            'name' => 'Лендинг Услуги',
            'slug' => 'landing-service-' . Str::random(4),
            'description' => 'Шаблон для одностраничника услуг',
            'variables' => [
                [ "key" => "title", "type" => "string", "label" => "Заголовок" ],
                [ "key" => "phone", "type" => "string", "label" => "Телефон" ],
                [ "key" => "features", "type" => "list", "label" => "Список преимуществ" ]
            ],
            'template_path' => 'site_templates.landing_service',
            'preview_url' => '/images/previews/landing_service.png',
        ];
    }
}
