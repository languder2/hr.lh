<div class="row">
    <div class="col-lg-10 col-sm-8">
        <h3 class="mt-2 mb-3">Заявки</h3>
    </div>
</div>
<?php if(isset($message) and !empty($message)):?>
    <div class="mb-3 callout <?=$message->class?>">
        <?=$message->message?>
    </div>
<?php endif; ?>
<?php if(isset($filterBox)):?>
    <div class="filter-box">
        <?=$filterBox;?>
    </div>
<?php endif;?>
<?php if(isset($appsTable)):?>
    <div class="apps-box">
        <?=$appsTable;?>
    </div>
<?php endif;?>