<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title??""?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="<?= base_url('js/code.jquery.com_jquery-3.7.0.min.js');?>"></script>
    <script defer src="<?= base_url('js/main.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous" defer></script>
    <link href="<?=base_url('css/main.css'); ?>" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
</head>
<body>
<main class="container-lg px-2">
<?=$content??""?>
</main>
<footer>
</footer>
</body>