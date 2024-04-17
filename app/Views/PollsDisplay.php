<form class="poll-box position-relative" style="height: 100%; min-height: 490px"  method="post" action="/apps/save_result">
    <input type="hidden" name="step" value="1">
    <input type="hidden" name="max" value="<?=isset($poll->questions)?count($poll->questions):0?>">
    <input type="hidden" name="form[pid]" value="<?=$poll->id??0?>">
    <input type="hidden" name="form[answers]" value="">
    <input type="hidden" name="form[results]" value="">
    <!---->
    <div style="height: 400px; position:relative;">
        <?php if(isset($poll)) foreach($poll->questions as $qi=>$question):?>
            <div class="poll-question  px-1 <?=$qi?"":"poll-step-active"?>" data-step-box="<?=$qi+1?>">
                <div class="poll-el poll-question-title p-3 fs-4 <?=$qi?"poll-hidden":""?>" data-step="<?=$qi+1?>">
                    <?=$question->question?>
                </div>
                <?php foreach ($question->answers as $ai=>$answer):?>
                <label class="poll-el form-check-label d-block border border-1 border-custom1 rounded-3 p-3 mb-2 cursor-pointer <?=$qi?"poll-hidden":""?>" data-step="<?=$qi+1?>">
                    <input
                            class="form-check-input mr-5 radio-answer"
                            type="radio"
                            name="a2q[<?=$qi+1?>]"
                            data-qid="<?=$question->id?>"
                            data-aid="<?=$ai?>"
                            data-rid="<?=$answer->result?>"
                            data-rw="<?=$answer->weight?>"
                            onchange="answerBySelected(this)"
                    >
                    <span class="d-inline-block ms-2">
                       <?=$answer->answer?>
                    </span>
                </label>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    </div>
    <!-- FORM -->
    <div class="position-absolute poll-form poll-hidden top-0 w-100" data-step="form" data-step-box="form">
        <h3 class="mt-0 mb-3 px-2 ff-gilroy">
            Заполните форму для получения результатов
        </h3>
        <div class="form-floating my-2 px-1">
            <input type="text" class="form-control h-auto" id="poll-form-name" name="form[name]" value="" >
            <label for="poll-form-name" class="h-auto w-auto">Имя</label>
        </div>
        <div class="form-floating my-2 px-1">
            <input type="email" class="form-control h-auto" id="poll-form-email" name="form[email]" value="">
            <label for="poll-form-email" class="h-auto w-auto">Email</label>
        </div>
        <div class="form-floating my-2 px-1">
            <input type="text" class="form-control h-auto" id="poll-form-phone" name="form[phone]" value="+7 ">
            <label for="poll-form-phone" class="h-auto w-auto">Телефон</label>
        </div>
        <div class="px-1 mt-1 mb-3">
            <div class="form-check">
                <input class="form-check-input cursor-pointer form-check-purple" type="checkbox"  name="form[success]" value="success" id="flexCheckDefault" checked >
                <label class="form-check-label cursor-pointer ff-gilroy" for="flexCheckDefault">
                    Я соглашаюсь на обработку персональных данных
                </label>
            </div>
            </div>
        <div class="my-1 text-center px-1">
            <button type="submit" class="btn btn-purple btn-lg fs-16 rounded-4 ff-gilroy position-relative">Получить результаты теста</button>
        </div>
    </div>
    <!-- RESULTS -->
    <div class="poll-results position-absolute w-100 top-0" data-step-box="results">
        <div class="container-fluid">
            <div class="row">
                <?php if(isset($results)) foreach($results as $key=>$result):?>
                    <div class="col col-12 poll-hidden position-relative callout callout-result poll-result py-2 mb-2 w-100 <?=(isset($poll->result) && $result->id==$poll->result)?"poll-base-result":""?> d-none"
                         data-rid="<?=$result->id?>"
                         data-step="results"
                    >
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
    </div>
    <!-- END RESULTS -->
    <!-- NAVBAR -->
    <div class="poll-navbar position-absolute bottom-0 start-0 end-0 text-secondary">
        <div class="pt-0 position-relative">
            <div class="caption position-absolute text-left w-100 bottom-50">Шаг: <span class="current">1</span> из <?=isset($poll->questions)?count($poll->questions)+1:1;?></div>
            <div class="progress float-start w-100 rounded-4 position-relative mt-3">
                <div class="progress-bar progress-purple progress-bar-striped progress-bar-animated py-3" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=100/(isset($poll)?count($poll->questions)+1:1)?>%"></div>
            </div>
        </div>
        <div class="ms-3">
            <div class="float-start">
                <button class="btn btn-secondary p-0 btn_prev rounded-circle disabled" style="width: 30px; height: 30px"></button>
            </div>
            <div class="float-end">
                <button class="btn btn-secondary p-0 btn_next rounded-circle disabled" style="width: 30px; height: 30px"></button>
            </div>
        </div>
    </div>
</form>
<?php //    dd($results) ?>
