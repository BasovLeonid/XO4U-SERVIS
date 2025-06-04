<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $data['page_title'] ?? 'Название страницы' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: sans-serif; background: #fafafa; margin: 0; padding: 0; }
        header { background: #222; color: #fff; padding: 40px; text-align: center; }
        section { padding: 40px; max-width: 800px; margin: 0 auto; background: #fff; }
        footer { background: #222; color: #ccc; text-align: center; padding: 20px; font-size: 14px; }
    </style>
</head>
<body>

    <header>
        <h1>{{ $data['hero_title'] ?? 'Заголовок по умолчанию' }}</h1>
        <p>{{ $data['hero_subtitle'] ?? 'Подзаголовок по умолчанию' }}</p>
    </header>

    <section>
        <h2>{{ $data['section_title'] ?? 'О нас' }}</h2>
        <p>{{ $data['section_text'] ?? 'Этот блок предназначен для описания компании, услуг или чего угодно.' }}</p>
    </section>

    <section>
        <h2>{{ $data['form_title'] ?? 'Форма обратной связи' }}</h2>
        <form>
            <input type="text" placeholder="Ваше имя"><br><br>
            <input type="email" placeholder="Email"><br><br>
            <textarea placeholder="Сообщение"></textarea><br><br>
            <button type="submit">Отправить</button>
        </form>
    </section>

    <footer>
        {{ $data['footer'] ?? '© 2025 Все права защищены' }}
    </footer>

</body>
</html>
