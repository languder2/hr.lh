<?php if(isset($header)) echo $header; ?>
<div class="row">
    <div class="col-lg-10 col-sm-8">
        <h3 class="mt-2 mb-3">Опросы</h3>
    </div>
    <div class="col-lg col-sm-4 pt-2 fs-5 text-end">
        <a href="<?=base_url('admin/polls/add')?>" class="btn btn-primary w-75">
            ADD
        </a>
    </div>
</div>
<?php if(isset($message) and !empty($message)):?>
    <div class="mb-3 callout <?=$message->class?>">
        <?=$message->message?>
    </div>
<?php endif; ?>
<?php if(isset($footer)) echo $footer; ?>