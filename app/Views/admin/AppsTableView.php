<?php if(isset($apps)) foreach ($apps as $day=>$appByDays):?>
<table class="table caption-top align-middle" style="table-layout: fixed;">
    <caption class="fs-5 text-primary fw-bold"><?=$day?></caption>
    <thead class="table-caption">
        <tr>
            <td>Опрос</td>
            <td style="width: 50px">#</td>
            <td>Дата</td>
            <td>Имя</td>
            <td>Email</td>
            <td>Телефон</td>
            <td style="width: 300px"></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($appByDays as $app):?>
            <tr>
                <td>
                    <?=isset($polls[$app->poll_id])?$polls[$app->poll_id]->name:"Не действителен #$app->poll_id"?>
                </td>
                <td><?=$app->id?></td>
                <td>
                    <?=$app->time?>
                </td>
                <td>
                    <?=$app->name?>
                </td>
                <td>
                    <a href="mailto:<?=$app->email?>"><?=$app->email?></a>
                    <br>
                    <a href="tel:<?=$app->phone?>"><?=$app->phone?></a>
                </td>
                <td>
                    <?php foreach ($app->results as $result):?>
                        <div>
                            <?=$result->name?>
                            <?=$result->weight?>
                            <a href="<?=$result->link?>" target="_blank">
                                link
                            </a>
                        </div>
                    <?php endforeach;?>
                </td>
                <td>btn</td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php endforeach;?>
