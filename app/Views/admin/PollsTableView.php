<table class="table table-striped caption-top" style="table-layout: fixed;">
    <caption><?=$caption??""?></caption>
    <thead class="table-caption">
        <tr>
            <td class="text-center" style="width: 50px">#</td>
            <td>Название</td>
            <td>Результат</td>
            <td style="width: 150px"></td>
        </tr>
    </thead>
    <tbody class="table-custom">
        <?php if(isset($polls)) foreach ($polls as $poll):?>
            <tr>
                <td class="text-center"><?=$poll->id?></td>
                <td><?=$poll->name?></td>
                <td>
                    <?php if(isset($results[$poll->result])):?>
                        <?=$results[$poll->result]->name?><br>
                        <a href="<?=$results[$poll->result]->link?>" target="_blank"><?=$results[$poll->result]->link?></a>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/admin/poll/edit/<?=$poll->id?>" class="btn btn-sm btn bg-primary text-white">
                        ред.
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

