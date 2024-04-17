<?php if(isset($appDetail)):?>
<div class="container box-app-detail mt-2"
>
    <input type="hidden" name="form[appID]" value="<?=$appDetail->id?>">
    <ul class="nav nav-tabs" style="z-index: 10" >
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
                Заявка #<?=$appDetail->id??""?> от <?=$appDetail->day??""?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
    <div class="border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0">
        <?=$appDetail->tabPresonal??""?>
    </div>
</div>

<?php endif;?>
<?php
//dd($appD);
?>
