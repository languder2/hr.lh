<form class="poll-box position-relative" style="height: 400px;"  method="post" action="/poll/save_result" onsubmit="return false;">
    <input type="hidden" name="step" value="1">
    <input type="hidden" name="max" value="<?=isset($poll->questions)?count($poll->questions):0?>">
    <input type="hidden" name="pid" value="<?=$poll->id??0?>">
    <input type="hidden" name="pid" value="<?=$poll->name??""?>">
    <input type="hidden" name="form[answers]" value="">
    <input type="hidden" name="form[results]" value="">
    <!---->
    <div style="height: 400px; position:relative;">
        <?php foreach($poll->questions as $qi=>$question):?>
            <div class="poll-question <?=$qi?"":"poll-step-active"?>" data-step-box="<?=$qi+1?>">
                <div class="poll-el poll-question-title p-3 fs-4 <?=$qi?"poll-hidden":""?>" data-step="<?=$qi+1?>">
                    <?=$question->question?>
                </div>
                <?php foreach ($question->answers as $ai=>$answer):?>
                <label class="poll-el form-check-label d-block border border-1 border-custom1 rounded-3 p-3 mb-2 <?=$qi?"poll-hidden":""?>" data-step="<?=$qi+1?>">
                    <input
                            class="form-check-input mr-5 radio-answer"
                            type="radio"
                            name="a2q[<?=$qi+1?>]"
                            data-qid="<?=$qi+1?>"
                            onchange="answerbySelected(this)"
                    >
                    <span class="d-inline-block ms-2">
                       <?=$answer->answer?>
                    </span>
                </label>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    </div>
    <!---->
    <div class="position-absolute poll-form poll-hidden top-0 w-100" data-step="form data-step-box="form>
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
    </div>
    <!---->
    <!---->
    <div class="poll-navbar position-absolute bottom-0 start-0 end-0 text-secondary">
        <div class="pt-0 position-relative">
            <div class="caption position-absolute text-left w-100 bottom-50">Шаг: <span class="current">1</span> из <?=count($poll->questions)+1;?></div>
            <div class="progress float-start w-100 rounded-4 position-relative mt-3">
                <div class="progress-bar progress-purple progress-bar-striped progress-bar-animated py-3" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=100/(count($poll->questions)+1)?>%"></div>
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
<?php //dd($poll->questions) ?>
