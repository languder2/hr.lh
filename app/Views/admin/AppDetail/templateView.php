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
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <?=$appDetail->tabPresonal??""?>
            </div>
            <?php if($appDetail->duplicates):?>
                <div class="tab-pane fade border border-1 px-2 pt-2 pb-3 rounded-bottom border-top-0" id="duplicates" role="tabpanel" aria-labelledby="duplicates-tab">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <?php foreach ($appDetail->duplicates as $duplicate):?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="duplicate-<?=$duplicate->appID?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duplicate-collapse-<?=$duplicate->appID?>" aria-expanded="false" aria-controls="duplicate-collapse-<?=$duplicate->appID?>">
                                        <?=$duplicate->date?>
                                        ->
                                        <?=$duplicate->type?>
                                        ->
                                        <?php if()($duplicate->comments)?>
                                        comments
                                    </button>
                                </h2>
                                <div id="duplicate-collapse-<?=$duplicate->appID?>" class="accordion-collapse collapse" aria-labelledby="duplicate-<?=$duplicate->appID?>" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                </div>
                            </div>
                        <?php endforeach;;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endif;?>
<pre>
<?php
//print_r($appDetail->duplicates);
?>
</pre>