<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title??""?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="<?=base_url('css/public/media.css')?>?t=<?php echo(microtime(true).rand()); ?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('css/public/vars.css')?>?t=<?php echo(microtime(true).rand()); ?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('css/public/base.css')?>?t=<?php echo(microtime(true).rand()); ?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('css/public/poll.css')?>?t=<?php echo(microtime(true).rand()); ?>" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/imask"></script>
    <script defer src="<?= base_url('js/public/poll.js');?>?t=<?php echo(microtime(true).rand()); ?>"></script>
</head>
<body>
<header class="bg-white">
    <div class="container px-3 clearfix">
        <a class="logo float-start" href="https://mgu-mlt.ru/"></a>
        <div class="info float-end clearfix">
            <div class="address float-start pt-3 ms-3 d-none d-md-block">
                Адрес<br>
                проспект Богдана Хмельницкого, 18
            </div>
            <div class="phone float-start pt-3 ms-3">
                Телефон<br>
                +7 (990) 146 9279
            </div>
            <div class="col float-start pt-3 ms-3 d-none d-lg-block  ">
                Часы работы<br>
                Пн - Пт с 8:00 до 16:30
            </div>
        </div>
    </div>
</header>
<div class="content">
    <div class="container mt-4 mb-3">
        <div class="bg-white px-5 py-4 info-block-1 position-relative">
            <h4 class="fs-24 fw-bolder m-0">
                Давайте пройдем первичное анкетирование Вашей идеальной IT-профессии
            </h4>
            <div class="color-grey pt-3">
                Так вы сможете предварительно узнать, какая IT-профессия может Вам подойти!
            </div>
        </div>
    </div>
    <div class="container mb-3">
        <div class="d-grid gap-3 grid-1">
            <div class="poll-box bg-white p-3">
                <?=$content??""?>
            </div>
            <div class=" info-block-2 bg-white  p-3">
                <div class="gift-title">Подарок</div>
                <div class="gift-desc my-3">
                    Получите подарки в конце теста
                </div>
                <div class="gift-box gift-box-1 mb-3">
                    <div class="title mb-2 black">
                        Карьерная консультация
                    </div>
                    С экспертом узнаете подробнее про все профессии IT и что идеально подходит именно вам
                </div>
                <div class="gift-box gift-box-2 mb-3">
                    <div class="title mb-2 black">
                        Курс по выходу на фриланс
                    </div>
                    Вы получите точное руководство по старту и развитию на фрилансе.
                </div>
                <div class="gift-box gift-box-3">
                    <div class="title mb-2 black">
                        Курс "Английский для разработчика"
                    </div>
                    <div>
                        Технический английского позволит нам предложить Вашу кандидатуру в западные компании
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3 ">
        <div class="bg-white px-5 py-4 advantages-block position-relative">
            <h4 class="fs-2 fw-normal mb-3">
                Обучитесь бесплатно. Устроим на работу по профессии в сфере IT. И только потом начните платить за обучение в рассрочку.
            </h4>
            <ul class="advantages">
                <li>
                    Все 6 месяцев Вашего обучения оплачивает университет
                </li>
                <li>
                    Подробнее о программеВаш платеж начинается с 7-го месяца
                </li>
                <li>
                    Можно отказаться от обучения в первый месяц и не потерять ни рубля
                </li>
                <li>
                    Устроим на работу после обучения и только тогда наступит первый платеж за обучение.
                </li>
                <li>
                    Обучитесь, получите трудоустройство, а уже потом с заработанных средств оплачивание обучение.
                </li>
            </ul>
            <a href="#" class="btn btn-lg btn-purple text-white">Подробнее о программе</a>
        </div>
    </div>
</div>
<footer>
    <div class="container text-center">
        &copy; 2024 ФГБОУ ВО "Мелитопольский государственный университет"
    </div>
</footer>
</body>