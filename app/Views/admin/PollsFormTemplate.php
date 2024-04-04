<?php if(isset($header)) echo $header; ?>
    <form method="post" action="<?=base_url("admin/polls/form/processing")?>" class="container-md w-100 ">
        <input type="hidden" name="form[op]" value="<?=@$op?>">
        <input type="hidden" name="form[id]" value="<?=@$id?>">
        <input type="hidden" name="form[nq]" value="0">
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
            <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[name]" placeholder="Название опроса" value="<?=@$form['name']?>">
        </div>

        <div class="accordion mb-3" id="questions" data-last-question-id="1">
            <?php $qcnt=1;?>
            <?php if(isset($form['questions'])) $qcnt+= count($form['questions']); ?>
            <div class="questions">
                <div class="accordion-item question" data-qid="1">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-q1">
                            Вопрос
                        </button>
                    </h2>
                    <div id="collapse-q1" class="accordion-collapse collapse show question">
                        <div class="accordion-body">
                            <div class="mb-2">
                                <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][1][question]" placeholder="Вопрос" value="">
                            </div>
                            <div class="mb-2">
                                <select class="form-select" name="form[questions][1][fixed]">
                                    <option value="0">Фиксированный результат</option>
                                    <?php if(isset($results)) foreach ($results as $result):?>
                                        <option value="<?=$result->id?>"><?=$result->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="container-fluid answers mt-2 px-1">
                                <table class="table caption-top align-middle mb-0 pb-0" data-laid="1">
                                    <caption>Ответы</caption>
                                    <tbody>
                                    <tr class="answer">
                                        <td style="width: 70px;">
                                            <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][1][answers][sort][]" placeholder="Sort" value="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][1][answers][answer][]" placeholder="Ответ" value="">
                                        </td>
                                        <td>
                                            <select class="form-select" name="form[questions][1][answers][result][]">
                                                <option value="0">Результат</option>
                                                <?php if(isset($results)) foreach ($results as $result):?>
                                                    <option value="<?=$result->id?>"><?=$result->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td style="width: 70px;">
                                            <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][1][answers][weight][]" placeholder="Вес" value="">
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="10" class="text-end border-0">
                                            <button class="btn btn-primary addAnswer" onclick="addAnswer('1'); return false;">Добавить ответ</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-2">
                <button class="btn btn-primary addQuestion">Добавить вопрос</button>
            </div>
        </div>
        <div class="text-center">
            <input type="submit" name="form[submit]" id="btnFormResult" class="btn btn-primary px-3" value="Сохранить опрос">
        </div>
    </form>

<div class="example-answer">
    <table>
        <tbody>
        <tr class="answer">
            <td style="width: 70px;">
                <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][replace-qid][answers][sort][]" placeholder="Sort" value="">
            </td>
            <td>
                <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][replace-qid][answers][answer][]" placeholder="Ответ" value="">
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
                <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][replace-qid][answers][weight][]" placeholder="Вес" value="">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="example-question">
    <div class="accordion-item question" data-qid="replace-qid">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-q-replace-qid">
                Вопрос
            </button>
        </h2>
        <div id="collapse-q-replace-qid" class="accordion-collapse collapse show question">
            <div class="accordion-body">
                <div class="mb-2">
                    <input type="text" class="form-control py-2 px-2 <?=((isset($validator) && !empty($validator->getError("form.name")))?"alert alert-danger":"")?>" name="form[questions][replace-qid][question]" placeholder="Вопрос" value="">
                </div>
                <div class="mb-2">
                    <select class="form-select" name="form[questions][replace-qid][fixed]">
                        <option value="0">Фиксированный результат</option>
                        <?php if(isset($results)) foreach ($results as $result):?>
                            <option value="<?=$result->id?>"><?=$result->name?></option>
                        <?php endforeach;?>
                    </select>
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

<?php
    //print_r(@$results);
?>
<?php if(isset($footer)) echo $footer; ?>