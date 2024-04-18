<?php if(isset($apps)) foreach ($apps as $day=>$appByDays):?>
<table class="table caption-top align-middle" style="table-layout: fixed;">
    <caption class="fs-5 text-primary fw-bold"><?=$day?></caption>
    <thead class="table-caption">
        <tr>
            <td style="width: 30px" class="text-center">#</td>
            <td style="width: 100px"  class="text-center">Время</td>
            <td>Имя</td>
            <td>E-mail</td>
            <td>Телефон</td>
            <td style="width: 80px"></td>
            <td style="width: 150px"  class="text-center">статус</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($appByDays as $app):?>
            <tr class="<?=$app->status?>">
                <td><?=$app->id?></td>
                <td class="text-center">
                    <?=$app->time?>
                </td>
                <td>
                    <?=$app->name?>
                </td>
                <td>
                    <a href="mailto:<?=$app->email?>"><?=$app->email?></a>
                    <?php if($app->duplicates->email):?>
                        <a href="<?=$app->email?>" class="duplicate duplicate-email"><?=$app->duplicates->email?></a>
                    <?php endif;?>
                </td>
                <td>
                    <a href="tel:<?=$app->phone?>"><?=$app->phone?></a>
                    <?php if($app->duplicates->phone):?>
                        <a href="<?=$app->phone?>" class="duplicate duplicate-phone"><?=$app->duplicates->phone?></a>
                    <?php endif;?>
                </td>
                <td>
                    <a href="/<?=ADMIN?>/app/detail/<?=$app->id?>/" class="btn btn-sm btn-primary btn-add-detail" target="_self" data-show="1modal">
                        детали
                    </a>
                </td>
                <td class="text-center">
                    <label>
                        <select class="form-select form-select-sm set-status" data-app="<?=$app->id?>">
                            <?php if(isset($statuses->app)) foreach ($statuses->app as $code=>$status): ?>
                                <option value="<?=$code?>" data-access="<?=$status->access?>"
                                    <?=($code==$app->status)?"selected":""?>
                                    <?=!$status->access?"disabled":""?>
                                >
                                    <?=$status->name?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php endforeach;?>
