<?php if(isset($header)) echo $header; ?>

<form method="post" action="<?=base_url("admin/results/form/processing")?>" class="container-md w-50 ">
    <input type="hidden" name="form[op]" value="<?=@$op?>">
    <input type="hidden" name="form[id]" value="<?=@$id?>">
    <h3 class="mb-2 mt-3 text-center">
        <?php if($op=="add"):?>
            Добавить результат
        <?php else:?>
            Редактировать результат: #<?=$id?>
        <?php endif;?>
    </h3>
    <?php if(!empty($errors)):?>
        <div class="text-center mt-3 mb-2 callout callout-error" role="alert">
            <?php foreach ($errors as $error) echo "$error<br>";?>
        </div>
    <?php endif;?>
    <div class="mb-3">
        <label for="formName" class="form-label">Название</label>
        <input type="text" class="form-control py-2 px-3 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" id="formName" name="form[name]" placeholder="Направление специализации" value="<?=@$form['name']?>">
        <?php if(isset($validator) && $validator->getError("form.name")!="required"):?>

        <?php endif;?>
    </div>
    <div class="mb-3">
        <label for="formLink" class="form-label">Ссылка</label>
        <input type="text" class="form-control py-2 px-3  <?=((isset($validator) && !empty($validator->getError("form.link")))?"alert alert-danger":"")?>" id="formLink" name="form[link]" placeholder="https://mgu-mlt.ru" value="<?=@$form['link']?>">
    </div>
    <div class="mb-3">
        <label for="formDescription" class="form-label">Описание</label>
        <textarea class="form-control py-2 px-3  <?=((isset($validator) && !empty($validator->getError("form.description")))?"alert alert-danger":"")?>" id="formDescription" name="form[description]" rows="3"><?=@$form['description']?></textarea>
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="formStatus"  name="form[status]" value="1" <?=(@$form['status']==1 || !isset($form))?"checked":""?>>
            <label class="form-check-label" for="formStatus">Активный</label>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" name="form[submit]" id="btnFormResult" class="btn btn-primary w-50" value="<?=($op=="add")?"Добавить":"Сохранить"?>">
    </div>
</form>
<?php if(isset($footer)) echo $footer; ?>