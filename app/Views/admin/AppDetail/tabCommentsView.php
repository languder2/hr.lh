<?php if(isset($appDetail) && $appDetail->comments === NULL):?>
    Нет комментариев
<?php else:?>
    <?php foreach ($appDetail->comments as $key=>$comment): ?>
    <div class="comment row py-2">
            <div class="col-3 col-lg-2">
                <?=$comment->dt?>
            </div>
            <div class="col-8 col-lg-9">
                <?=$comment->comment?>
            </div>
            <div class="col-1 text-end">
                <a href="/admin/app/<?=$appDetail->appID?>/comment/remove/<?=$key?>" class="btn btn-sm btn-danger btn-remove-comment">del</a>
            </div>
        </div>
    <?php endforeach;?>
<?php endif;?>
