<?php if(isset($header)) echo $header; ?>
    <form method="post" action="<?=base_url("admin/polls/form/processing")?>" class="container-md w-100 pb-3">
        <input type="hidden" name="form[op]" value="<?=@$op?>">
        <input type="hidden" name="form[id]" value="<?=@$id?>">
        <input type="hidden" name="form[nq]" value="<?=(isset($poll->maxQID)?$poll->maxQID:"n1")?>">
        <h3 class="mb-2 mt-3 text-center">
            <?php if($op=="add"):?>
                Добавить опрос
            <?php else:?>
                Редактировать опрос: #<?=$id?>
            <?php endif;?>
        </h3>
        <?php if(!empty($errors)):?>
            <div class="text-center mt-3 mb-2 callout callout-error" role="alert">
                <?php foreach ($errors as $error) echo "$error<br>";?>
            </div>
        <?php endif;?>
        <div class="mb-3">
            <input type="text" class="form-control py-2 px-2
                <?=((isset($validator) && !empty($validator->getError("form.pollname")))?"alert alert-danger":"")?>
                " name="form[pollname]" placeholder="Название опроса" value="<?=isset($poll->name)?$poll->name:""?>">
        </div>
        <div class="mb-3">
             <select class="form-select" name="form[fixed]">
                <option value="0">Фиксированный результат</option>
                <?php if(isset($results)) foreach ($results as $result):?>
                    <option value="<?=$result->id?>" <?=(isset($poll->fixed) && $poll->fixed==$result->id)?"selected":""?>><?=$result->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="accordion mb-3" id="questions" data-last-question-id="1">
            <div class="questions">
                <?php if(empty($poll->questions)):?>
                    <div class="accordion-item question" data-qid="n0">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-q-n0">
                                Вопрос
                            </button>
                        </h2>
                        <div id="collapse-q-n0" class="accordion-collapse collapse show question">
                            <div class="accordion-body">
                                <div class="mb-2">
                                    <input type="text" class="form-control py-2 px-2" name="form[questions][n0][question]" placeholder="Вопрос" value="">
                                </div>
                                <div class="container-fluid answers mt-2 px-1">
                                    <table class="table caption-top align-middle mb-0 pb-0" data-laid="1">
                                        <caption>Ответы</caption>
                                        <tbody>
                                        <tr class="answer">
                                            <td style="width: 70px;">
                                                <input type="text" class="form-control py-2 px-2" name="form[questions][n0][answers][sort][]" placeholder="Sort" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control py-2 px-2" name="form[questions][n0][answers][answer][]" placeholder="Ответ" value="">
                                            </td>
                                            <td>
                                                <select class="form-select" name="form[questions][n0][answers][result][]">
                                                    <option value="0">Результат</option>
                                                    <?php if(isset($results)) foreach ($results as $result):?>
                                                        <option value="<?=$result->id?>"><?=$result->name?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </td>
                                            <td style="width: 70px;">
                                                <input type="text" class="form-control py-2 px-2" name="form[questions][n0][answers][weight][]" placeholder="Вес" value="">
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="10" class="text-end border-0">
                                                <button class="btn btn-primary addAnswer" onclick="addAnswer('n0'); return false;">Добавить ответ</button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <?php foreach ($poll->questions as $qid=>$question):?>
                        <div class="accordion-item question" data-qid="<?=$qid;?>">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-q-<?=$qid;?>">
                                Вопрос
                            </button>
                        </h2>
                        <div id="collapse-q-<?=$qid;?>" class="accordion-collapse collapse question">
                            <div class="accordion-body">
                                <div class="mb-2">
                                    <input type="text" class="form-control py-2 px-2" name="form[questions][<?=$qid;?>][question]" placeholder="Вопрос" value="<?=$question->question?>">
                                </div>
                                <div class="container-fluid answers mt-2 px-1">
                                    <table class="table caption-top align-middle mb-0 pb-0" data-laid="1">
                                        <caption>Ответы</caption>
                                        <tbody>
                                            <?php foreach ($question->answers as $answer):?>
                                                <tr class="answer">
                                                    <td style="width: 70px;">
                                                        <input type="text" class="form-control py-2 px-2" name="form[questions][<?=$qid;?>][answers][sort][]" placeholder="Sort" value="<?=$answer->sort?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control py-2 px-2" name="form[questions][<?=$qid;?>][answers][answer][]" placeholder="Ответ" value="<?=$answer->answer?>">
                                                    </td>
                                                    <td>
                                                        <select class="form-select" name="form[questions][<?=$qid;?>][answers][result][]">
                                                            <option value="0">Результат</option>
                                                            <?php if(isset($results)) foreach ($results as $result):?>
                                                                <option value="<?=$result->id?>" <?=($answer->result==$result->id)?"selected":""?>><?=$result->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </td>
                                                    <td style="width: 70px;">
                                                        <input type="text" class="form-control py-2 px-2" name="form[questions][<?=$qid;?>][answers][weight][]" placeholder="Вес" value="<?=$answer->weight?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="10" class="text-end border-0">
                                                <button class="btn btn-primary addAnswer" onclick="addAnswer('<?=$qid;?>'); return false;">Добавить ответ</button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="text-end mt-2">
                <button class="btn btn-primary addQuestion">Добавить вопрос</button>
            </div>
        </div>
        <div class="text-center">
            <input type="submit" name="form[submit]" id="btnFormResult" class="btn btn-primary px-3" value="Сохранить опрос">
        </div>
    </form>

<div class="example-answer d-none">
    <table>
        <tbody>
        <tr class="answer">
            <td style="width: 70px;">
                <input type="text" class="form-control py-2 px-2" name="form[questions][replace-qid][answers][sort][]" placeholder="Sort" value="">
            </td>
            <td>
                <input type="text" class="form-control py-2 px-2" name="form[questions][replace-qid][answers][answer][]" placeholder="Ответ" value="">
            </td>
            <td>
                <select class="form-select" name="form[questions][replace-qid][answers][result][]">
                    <option value="0">Результат</option>
                    <?php if(isset($results)) foreach ($results as $result):?>
                        <option value="<?=$result->id?>"><?=$result->name?></option>
                    <?php endforeach;?>
                </select>
            </td>
            <td style="width: 70px;">
                <input type="text" class="form-control py-2 px-2" name="form[questions][replace-qid][answers][weight][]" placeholder="Вес" value="">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="example-question d-none">
    <div class="accordion-item question" data-qid="replace-qid">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-q-replace-qid">
                Вопрос
            </button>
        </h2>
        <div id="collapse-q-replace-qid" class="accordion-collapse collapse show question">
            <div class="accordion-body">
                <div class="mb-2">
                    <input type="text" class="form-control py-2 px-2" name="form[questions][replace-qid][question]" placeholder="Вопрос" value="">
                </div>
                <div class="container-fluid answers mt-2 px-1">
                    <table class="table caption-top align-middle mb-0 pb-0" data-laid="1">
                        <caption>Ответы</caption>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="10" class="text-end border-0">
                                <button class="btn btn-primary addAnswer" onclick="addAnswer('replace-qid'); return false;">Добавить ответ</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($footer)) echo $footer; ?>