<?php

namespace Database\Seeders;

use App\Models\SiteTemplate;
use App\Models\SiteTemplateBlock;
use App\Models\SiteTemplateVariable;
use Illuminate\Database\Seeder;

class SiteTemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем шаблон
        $template = SiteTemplate::create([
            'name' => 'Тестовый шаблон',
            'template_code' => 'test_template',
            'description' => 'Базовый шаблон для тестирования функциональности',
            'status' => 'active',
        ]);

        // Создаем блоки шаблона
        $blocks = [
            [
                'name' => 'Шапка',
                'block_code' => 'header',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'name' => 'Главный баннер',
                'block_code' => 'main_banner',
                'is_required' => true,
                'order' => 2,
            ],
            [
                'name' => 'О компании',
                'block_code' => 'about',
                'is_required' => false,
                'order' => 3,
            ],
            [
                'name' => 'Услуги',
                'block_code' => 'services',
                'is_required' => true,
                'order' => 4,
            ],
            [
                'name' => 'Контакты',
                'block_code' => 'contacts',
                'is_required' => true,
                'order' => 5,
            ],
        ];

        foreach ($blocks as $block) {
            SiteTemplateBlock::create([
                'site_template_id' => $template->id,
                'name' => $block['name'],
                'block_code' => $block['block_code'],
                'is_required' => $block['is_required'],
                'order' => $block['order'],
            ]);
        }

        // Создаем переменные шаблона
        $variables = [
            [
                'name' => 'Название компании',
                'variable_code' => 'company_name',
                'type' => 'string',
                'is_required' => true,
                'default_value' => 'Моя компания',
            ],
            [
                'name' => 'Телефон',
                'variable_code' => 'phone',
                'type' => 'string',
                'is_required' => true,
                'default_value' => '+7 (999) 123-45-67',
            ],
            [
                'name' => 'Email',
                'variable_code' => 'email',
                'type' => 'string',
                'is_required' => true,
                'default_value' => 'info@example.com',
            ],
            [
                'name' => 'Адрес',
                'variable_code' => 'address',
                'type' => 'string',
                'is_required' => false,
                'default_value' => 'г. Москва, ул. Примерная, д. 1',
            ],
        ];

        foreach ($variables as $variable) {
            SiteTemplateVariable::create([
                'site_template_id' => $template->id,
                'name' => $variable['name'],
                'variable_code' => $variable['variable_code'],
                'type' => $variable['type'],
                'is_required' => $variable['is_required'],
                'default_value' => $variable['default_value'],
            ]);
        }
    }
}
