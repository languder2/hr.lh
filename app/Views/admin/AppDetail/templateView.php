<?php if(isset($appDetail)):?>
    <div class="container box-app-detail mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="home" aria-selected="true">
                    Заявка #<?=$appDetail->id??""?> от <?=$appDetail->day??""?>
                  </button>
            </li>
            <?php if($appDetail->duplicates):?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="duplicates-tab" data-bs-toggle="tab" data-bs-target="#duplicates" type="button" role="tab" aria-controls="duplicate" aria-selected="false">
                        Повторы
                    </button>
                </li>
            <?php endif;?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="home" aria-selected="true">
                    Уведомления
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <?=$appDetail->tabPresonal??""?>
            </div>
            <?php if($appDetail->duplicates):?>
                <div class="tab-pane fade border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0" id="duplicates" role="tabpanel" aria-labelledby="duplicates-tab">
                    <?=$appDetail->tabDuplicates??""?>
                </div>
            <?php endif;?>
            <div class="tab-pane fade border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                <?=$appDetail->tabNotifications??""?>
            </div>
        </div>
    </div>
<?php endif;?>
<?php
//print_r($appDetail->duplicates);
?>
</pre>