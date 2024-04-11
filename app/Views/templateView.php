<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title??""?></title>
    <script defer src="<?= base_url('js/public/main.js');?>"></script>
    <link href="<?=base_url('css/public/vars.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('css/public/base.css')?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="test">
    test
</div>
<main class="container-lg px-2">

<?=$content??""?>
</main>
<footer>
</footer>
</body>