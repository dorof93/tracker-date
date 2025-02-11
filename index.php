<?php
    require_once('functions.php');

    $date  = $_COOKIE['date']  ?? '';
    $event = $_COOKIE['event'] ?? '';

    
    $text = '';
    if ( empty($date) ) {
        $text = 'Пожалуйста, введите дату';
    } elseif ( ! check_format_date($date) ) {
        $text = 'Пожалуйста, введите корректную дату в формате ДД.ММ.ГГГГ';
    } else {
        $days = intval( round( ( strtotime($date) - strtotime(date('Y-m-d')) ) / 60 / 60 / 24 ) );
        if ( $days <= 0 ) {
            $text = 'Указанная дата раньше или равна сегодняшней';
        } else {
            if ( ! empty($event) ) {
                $text = 'До события "' . htmlspecialchars($event) . '" осталось: ';
            } else {
                $text = 'До даты ' . htmlspecialchars($date) . ' осталось: ';
            }
            $text .= declension($days, ['день', 'дня', 'дней']);
        }
    }
?>
<!DOCTYPE html>
<html>
   <head>
        <title>Количество дней до даты</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Подсчет количества дней до указанной даты">
        <link rel="icon" href="/favicon.ico">
        <link href="/style.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/style.css') ?>" rel="stylesheet">
   </head>
   <body>
        <header>
            <div class="logo">
                <a href="/">
                    <img src="/logo.png" alt="Logo">
                </a>
            </div>
        </header>
        <main>
            <h1>Количество дней до даты</h1>
            <form class="form" method="POST" action="/handler.php">
                <div class="form__field">
                    <label class="form__label">Дата</label>
                    <input required class="form__input" name="date" value="<?php echo $date; ?>" type="text" placeholder="ДД.ММ.ГГГГ">
                </div>
                <div class="form__field">
                    <label class="form__label">Название события</label>
                    <input class="form__input" name="event" value="<?php echo $event; ?>" type="text" placeholder="Свадьба">
                </div>
                <div class="form__field">
                    <button class="button form__button">Рассчитать</button>
                </div>
            </form>
            <div class="tracker">
                <?php echo $text; ?>
            </div>
        </main>
        <footer>
            (c) Oleg Dorofeev 2025
        </footer>
   </body>
</html>