<table class="table table-striped table-hover caption-top align-middle table-info">
    <caption><?=$caption??""?></caption>
    <thead>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($polls)) foreach ($polls as $poll):?>
            <tr>
                <td><?=$poll->id??""?></td>
                <td><?=$poll->name??""?></td>
                <td><?=$poll->status??""?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

