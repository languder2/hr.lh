<section class="container">
    <form method="post" action="/admin/app/change/personal">
        <div class="row">
            <h5 class="col-12 px-0">Персональные данные</h5>
            <div class="my-2 px-1 ps-0 col-3 col-sm-12 col-md-3">
                <label for="app-form-name">Имя</label>
                <input type="text" id="app-form-name" class="form-control h-auto" name="form[name]" value="<?=$appDetail->name??""?>">
            </div>
            <div class="my-2 px-1 col-3 col-sm-12 col-md-3">
                <label for="app-form-email" >E-mail</label>
                <input type="text"  id="app-form-email" class="form-control h-auto" name="form[email]" value="<?=$appDetail->email??""?>">
            </div>
            <div class="my-2 px-1 pe-0 col-3 col-sm-12 col-md-3">
                <label for="app-form-phone" class="h-auto w-auto">Телефон</label>
                <input type="text" id="app-form-phone" class="form-control h-auto" name="form[phone]" value="<?=$appDetail->phone??""?>">
            </div>
            <div class="col-lg-3 text-end mt-2 pt-sm-0 px-0 col-md-3 pt-md-4 ps-sm-1">
                <button class="btn btn-primary d-inline w-100">сохранить</button>
            </div>
        </div>
    </form>
</section>
<section class="mt-2 box-app-detail-comments">
    <form action="/admin/app/addComment" method="post" class="container form-app-detail-new-comment">
        <input type="hidden" name="form[appID]" value="<?=$appDetail->id??0?>">
        <div class="row">
            <h5 class="col-12 px-0">Комментарии</h5>
            <div class="col-9 col-lg-10 px-0">
                <label for="app-form-phone" class="d-block">
                    <input type="text"
                           class="form-control"
                           name="form[comment]"
                           placeholder="Новый комментарий">
                </label>
            </div>
            <div class="col-3 col-lg-2 px-1 mb-2">
                <button class="btn btn-primary btn-add-comment w-100">добавить</button>
            </div>
        </div>
    </form>
    <div class="comments px-1">
        <?=$appDetail->tabComments??""?>
    </div>
</section>
<?php
    //dd($includes);
?>