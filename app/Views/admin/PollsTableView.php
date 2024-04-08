<table class="table table-striped caption-top align-middle" style="table-layout: fixed;">
    <caption><?=$caption??""?></caption>
    <thead class="table-caption">
        <tr>
            <td style="width: 50px">1</td>
            <td>2</td>
            <td>2</td>
            <td style="width: 300px">1</td>
        </tr>
    </thead>
    <tbody class="table-custom">
        <?php if(isset($polls)) foreach ($polls as $poll):?>
            <tr>
                <td><?=$poll->id??""?></td>
                <td><?=$poll->name??""?></td>
                <td><?=$poll->resullt??""?></td>
                <td>btns</td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

