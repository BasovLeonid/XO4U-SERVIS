<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $template->name }} - Предпросмотр</title>
    
    <!-- Подключаем стили шаблона -->
    @php
        $cssPath = storage_path('app/store/site_templates/' . $template->template_code . '/css/style.css');
        $jsPath = storage_path('app/store/site_templates/' . $template->template_code . '/js/script.js');
    @endphp
    
    @if(file_exists($cssPath))
        <style>
            {!! file_get_contents($cssPath) !!}
        </style>
    @endif
    
    <!-- Подключаем скрипты шаблона -->
    @if(file_exists($jsPath))
        <script>
            {!! file_get_contents($jsPath) !!}
        </script>
    @endif
</head>
<body>
    <!-- Включаем содержимое шаблона -->
    @php
        ob_start();
        include $tempFile;
        $content = ob_get_clean();
        echo $content;
    @endphp
</body>
</html> 