<?php

namespace Database\Seeders;

use App\Models\SiteTemplate;
use App\Models\SiteTemplateBlock;
use App\Models\SiteTemplateVariable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestTemplateSeeder extends Seeder
{
    public function run()
    {
        // Создаем шаблон
        $template = SiteTemplate::create([
            'name' => 'Тестовый шаблон',
            'template_code' => 'test_template',
            'description' => 'Простой тестовый шаблон для демонстрации функционала',
            'status' => 'active',
        ]);

        // Создаем блоки шаблона
        $blocks = [
            [
                'name' => 'Шапка',
                'block_code' => 'header',
                'is_required' => true,
                'order' => 1,
                'description' => 'Блок с логотипом и навигацией'
            ],
            [
                'name' => 'Главный баннер',
                'block_code' => 'main_banner',
                'is_required' => true,
                'order' => 2,
                'description' => 'Главный баннер с заголовком и описанием'
            ],
            [
                'name' => 'О компании',
                'block_code' => 'about',
                'is_required' => false,
                'order' => 3,
                'description' => 'Блок с информацией о компании'
            ],
            [
                'name' => 'Услуги',
                'block_code' => 'services',
                'is_required' => true,
                'order' => 4,
                'description' => 'Блок со списком услуг'
            ],
            [
                'name' => 'Контакты',
                'block_code' => 'contacts',
                'is_required' => true,
                'order' => 5,
                'description' => 'Блок с контактной информацией'
            ]
        ];

        foreach ($blocks as $block) {
            SiteTemplateBlock::create(array_merge($block, ['site_template_id' => $template->id]));
        }

        // Создаем переменные шаблона
        $variables = [
            [
                'name' => 'Название компании',
                'variable_code' => 'company_name',
                'type' => 'string',
                'is_required' => true,
                'default_value' => 'Моя компания',
                'description' => 'Название компании, отображаемое на сайте'
            ],
            [
                'name' => 'Телефон',
                'variable_code' => 'phone',
                'type' => 'string',
                'is_required' => true,
                'default_value' => '+7 (999) 123-45-67',
                'description' => 'Контактный телефон'
            ],
            [
                'name' => 'Email',
                'variable_code' => 'email',
                'type' => 'string',
                'is_required' => true,
                'default_value' => 'info@example.com',
                'description' => 'Контактный email'
            ],
            [
                'name' => 'Адрес',
                'variable_code' => 'address',
                'type' => 'string',
                'is_required' => false,
                'default_value' => 'г. Москва, ул. Примерная, д. 1',
                'description' => 'Физический адрес компании'
            ]
        ];

        foreach ($variables as $variable) {
            SiteTemplateVariable::create(array_merge($variable, ['site_template_id' => $template->id]));
        }
    }
} 