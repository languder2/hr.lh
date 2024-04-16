<?php if(isset($appD)):?>
    <div class="row">
    <div class="col-lg-10 col-sm-8">
        <h3 class="mt-2 mb-3">Заявка #<?=$appD->id??""?> от <?=$appD->day??""?></h3>
    </div>
</div>
<form action="#" method="post" class="container box-app-detail">
    <div class="row">
        <div class="form-floating my-2 px-1 col-4">
            <input type="text" id="app-form-name" class="form-control h-auto" name="form[name]" value="<?=$appD->name?>">
            <label for="app-form-name" class="h-auto w-auto">Имя</label>
        </div>
        <div class="form-floating my-2 px-1 col-4">
            <input type="text"  id="app-form-email" class="form-control h-auto" name="form[email]" value="<?=$appD->email?>">
            <label for="app-form-email" class="h-auto w-auto">E-mail</label>
        </div>
        <div class="form-floating my-2 px-1 col-4">
            <input type="text" id="app-form-phone" class="form-control h-auto" name="form[phone]" value="<?=$appD->phone?>">
            <label for="app-form-phone" class="h-auto w-auto">Телефон</label>
        </div>

    </div>
</form>

<?php endif;?>
<?php
//dd($appD);
?>
