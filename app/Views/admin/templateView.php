<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title??""?></title>
    <script defer src="<?= base_url('js/lib/code.jquery.com_jquery-3.7.0.min.js');?>"></script>
    <script defer src="<?= base_url('js/lib/bootstrap.bundle.min.js');?>"></script>
    <script defer src="<?= base_url('js/lib/imask.js');?>"></script>
    <link href="<?=base_url('css/lib/bootstrap.min.css')?>" rel="stylesheet" type="text/css">

    <link href="<?=base_url("css/admin/main.css"); ?>?t=<?php echo(microtime(true).rand()); ?>" rel="stylesheet" type="text/css">
    <script defer src="<?= base_url('/js/admin/main.js');?>?t=<?php echo(microtime(true).rand()); ?>"></script>
</head>
<body>
<header class="container-fluid px-0">
    <?php if(!empty($mainMenu)) echo $mainMenu?>
</header>
<main class="container-lg px-2">
<?=$content??""?>
</main>
<footer>
</footer>
</body>