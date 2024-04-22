<?php if(isset($appDetail) && count($appDetail->duplicates)):?>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <?php foreach ($appDetail->duplicates as $duplicate):?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="duplicate-<?=$duplicate->appID?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duplicate-collapse-<?=$duplicate->appID?>" aria-expanded="false" aria-controls="duplicate-collapse-<?=$duplicate->appID?>">
                        Заявка #<?=$duplicate->appID??""?> от <?=$duplicate->date??""?>
                        |
                        <?=$duplicate->type?>
                        <?php if(is_array($duplicate->comments) && count($duplicate->comments)): ?>
                            | comments (<?=count($duplicate->comments)?>)
                        <?php endif;?>
                    </button>
                </h2>
                <div
                        id="duplicate-collapse-<?=$duplicate->appID?>"
                        class="accordion-collapse collapse"
                        aria-labelledby="duplicate-<?=$duplicate->appID?>"
                        data-bs-parent="#accordionFlushExample"
                >
                    <div class="accordion-body container">
                        <div class="personal row py-2 text-center">
                            <div class="col-4 col-lg-4 <?=($appDetail->name===$duplicate->name)?"text-success":"text-danger"?>">
                                <?=$duplicate->name?>
                            </div>
                            <div class="col-4 col-lg-4 <?=($appDetail->email===$duplicate->email)?"text-success":"text-danger"?>">
                                <?=$duplicate->email?>
                            </div>
                            <div class="col-4 col-lg-4 <?=($appDetail->phone===$duplicate->phone)?"text-success":"text-danger"?>">
                                <?=$duplicate->phone?>
                            </div>
                        </div>
                        <?php if(is_array($duplicate->comments)) foreach($duplicate->comments as $comment):?>
                            <div class="comment row py-2">
                                <div class="col-3 col-lg-2">
                                    <?=$comment->dt?>
                                </div>
                                <div class="col-9 col-lg-10">
                                    <?=$comment->comment?>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        <?php endforeach;;?>
    </div>
<?php endif;?>