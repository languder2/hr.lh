<table class="table table-striped caption-top" style="table-layout: fixed;">
    <caption><?=$caption??""?></caption>
    <thead class="table-caption">
        <tr>
            <td class="text-center" style="width: 50px">#</td>
            <td>Название</td>
            <td>Результат</td>
            <td style="width: 190px"></td>
        </tr>
    </thead>
    <tbody class="table-custom">
        <?php if(isset($polls)) foreach ($polls as $poll):?>
            <tr data-pid="<?=$poll->id?>" class="align-middle">
                <td class="text-center"><?=$poll->id?></td>
                <td><?=$poll->name?></td>
                <td>
                    <?php if(isset($results[$poll->result])):?>
                        <?=$results[$poll->result]->name?><br>
                        <a href="<?=$results[$poll->result]->link?>" target="_blank"><?=$results[$poll->result]->link?></a>
                    <?php endif; ?>
                </td>
                <td class="align-middle text-center">
                    <div class="d-flex align-content-between">
                        <label class="form-check form-switch mx-1 mt-2">
                            <input class="form-check-input btnPollChangeStatus" type="checkbox" role="switch" data-pid="<?=$poll->id?>" <?=($poll->status)?"checked":""?>>
                        </label>
                        <button class="btn btn-primary mx-1 btn-edit" data-action="<?=base_url("/admin/poll/edit/$poll->id")?>">
                            edit
                        </button>
                        <button class="btn btn-danger mx-1 btn-remove" data-action="/admin/poll/remove/<?=$poll->id?>" data-pid="<?=$poll->id?>">
                            del
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

