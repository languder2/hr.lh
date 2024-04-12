<?php if(isset($header)) echo $header; ?>
<div class="poll-box position-relative px-3" style="width: <?=$width??800?>px; height: <?=$height??600?>px">
    <div class="poll-questions position-relative d-none">
        <!--QUESTIONS-->
        <?php if(isset($poll)) foreach ($poll->questions as $qk=>$question):?>
            <div class="poll-question position-absolute w-100"  style="z-index: <?=$qk?0:1?>" data-step="<?=$qk?>">
                <h4 class="poll-caption px-2 pb-2 <?=$qk?"hide":""?>" data-group="<?=$qk?>">
                    <?=$question->question??""?>
                </h4>
                <?php foreach ($question->answers as $ak=>$answer):?>
                    <div class="poll-answer <?=$qk?"hide":""?>" data-group="<?=$qk?>">
                        <label class="form-check-label d-block border border-1 border-custom1 rounded-3 p-3 mb-2" for="a_<?=$question->id?>_<?=$ak?>">
                            <input
                                    class="form-check-input mr-5 radio-answer"
                                    type="radio" name="answer2q_<?=$qk?>"
                                    id="a_<?=$question->id?>_<?=$ak?>"
                                    data-qid="<?=$question->id?>"
                                    data-aid="<?=$ak?>"
                                    data-result="<?=$answer->result?>"
                                    data-result-weight="<?=!empty($answer->weight)?$answer->weight:0?>"
                            >
                            <span class="d-inline-block ml-10">
                                <?=$answer->answer??""?>
                            </span>
                        </label>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
        <!--END QUESTIONS-->
    </div>
    <!-- FORM -->
    <div class="position-relative poll-form">
        <div class="hide position-absolute w-100" data-group="form" data-step="form">
            <form class="pt-1 poll-app-form mx-auto" method="post" action="/poll/save_result">
                <input type="hidden" name="form[pid]" value="<?=$poll->id?>">
                <input type="hidden" name="form[answers]" value="">
                <input type="hidden" name="form[results]" value="">
                <h3 class="mt-0 mb-3 px-2">
                    Заполните форму для получения результатов
                </h3>
                <div class="form-floating my-2">
                    <input type="text" class="form-control h-auto" id="poll-form-name" name="form[name]" placeholder="Имя" value="" >
                    <label for="poll-form-name">Имя</label>
                </div>
                <div class="form-floating my-2">
                    <input type="email" class="form-control h-auto" id="poll-form-email" name="form[email]" placeholder="name@ya.ru" value="">
                    <label for="poll-form-email">Email</label>
                </div>
                <div class="form-floating my-2">
                    <input type="text" class="form-control h-auto" id="poll-form-phone" name="form[phone]" placeholder="+7(999)999-99-99" value="">
                    <label for="poll-form-phone">Телефон</label>
                </div>
                <div class="my-1 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!--END FORM-->
    <!--RESULTS-->
    <div class="poll-results position-relative d-none" data-step="results">
        <div class="position-absolute hide container-fluid" data-group="results">
            <div class="row">
            <?php if(isset($results)) foreach($results as $key=>$result):?>
                <div class="col-12 callout callout-result poll-result py-2 mb-2 <?=($result->id==$poll->result)?"poll-base-result":""?>" data-rid="<?=$result->id?>">
                    <a href="<?=$result->link?>" class="fs-4 poll-result-title">
                        <?=$result->name?>
                    </a>
                    <div class="result-description">
                        <?=$result->description?>
                    </div>
                    <div class="text-end">
                        <a href="<?=$result->link?>" class="poll-result-link fs-10">
                            подробнее
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>    <!--END RESULTS-->
    <div class="poll-navbar position-absolute bottom-0 start-0 end-0 px-3 mx-3 text-secondary d-none">
            <div class="pt-1 position-relative">
                <div class="caption position-absolute text-left w-100 bottom-50">Шаг: <span class="current">1</span> из <?=$qk+1?></div>
                <div class="progress float-start w-100 rounded-4 position-relative mt-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated py-3" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=100/($qk+1)?>%"></div>
                </div>
            </div>
            <div class="ms-3">
                <input type="hidden" name="poll_step" value="0">
                <input type="hidden" name="max_step" value="<?=isset($poll->questions)?count($poll->questions):0?>">
                <div class="float-start">
                    <button class="btn btn-secondary btn_prev rounded-circle disabled" style="width: 30px; height: 30px"></button>
                </div>
                <div class="float-end">
                    <button class="btn btn-secondary btn_next rounded-circle disabled" style="width: 30px; height: 30px"></button>
                </div>
            </div>
        </div>
</div>
<?php if(isset($footer)) echo $footer; ?>