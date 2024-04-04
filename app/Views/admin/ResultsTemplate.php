<?php if(isset($header)) echo $header; ?>
<div class="row">
    <div class="col-lg-10 col-sm-8">
        <h3 class="mt-2 mb-3">Результаты</h3>
    </div>
    <div class="col-lg col-sm-4 pt-2 fs-5 text-end">
        <a href="<?=base_url('admin/results/add')?>" class="btn btn-primary w-75">
            ADD
        </a>
    </div>
</div>
<?php if(isset($message) and !empty($message)):?>
    <div class="mb-3 callout <?=$message->class?>">
        <?=$message->message?>
    </div>
<?php endif; ?>
<?php if(isset($results) && !empty($results)):?>
    <table class="table table-striped table-hover table-light caption-top align-middle">
        <caption>Активные</caption>
        <thead class="table-primary">
        <tr>
            <th class="text-center" scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Ссылка</th>
            <td style="width: 40px"></td>
            <td style="width: 60px"></td>
            <td style="width: 60px"></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $record):?>
                <?php if($record->status!=1)continue;?>
                <tr >
                    <td class="text-center"><?=$record->id?></td>
                    <td ><?=$record->name?></td>
                    <td ><?=$record->link?></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input formResultStatus" type="checkbox" role="switch" data-id="<?=$record->id?>"  checked>
                        </div>
                    </td>
                    <td>
                        <a href="<?=base_url("admin/results/edit/$record->id")?>" class="btn btn-primary">
                            edit
                        </a>
                    </td>
                    <td>
                        <a href="<?=base_url("admin/results/remove/$record->id")?>" class="btn btn-danger btnResultDelete" data-id="<?=$record->id?>" data-name="<?=$record->name?>">
                            del
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <table class="table table-striped table-hover table-light caption-top align-middle">
        <caption>Активные</caption>
        <thead class="table-primary">
        <tr>
            <th class="text-center" scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Ссылка</th>
            <td style="width: 40px"></td>
            <td style="width: 60px"></td>
            <td style="width: 60px"></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $record):?>
            <?php if($record->status==1)continue;?>
            <tr >
                <td class="text-center"><?=$record->id?></td>
                <td ><?=$record->name?></td>
                <td ><?=$record->link?></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input  formResultStatus" type="checkbox" role="switch" data-id="<?=$record->id?>">
                    </div>
                </td>
                <td>
                    <a href="<?=base_url("admin/results/edit/$record->id")?>" class="btn btn-primary">
                        edit
                    </a>
                </td>
                <td>
                    <a href="<?=base_url("admin/results/remove/$record->id")?>" class="btn btn-danger btnResultDelete" data-id="<?=$record->id?>" data-name="<?=$record->name?>">
                        del
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php endif; ?>












<?php if(isset($footer)) echo $footer; ?>