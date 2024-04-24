<?php if(isset($list) && is_array($list)):?>
    <section class="container-fluid">
        <?php foreach($list as $row):?>
            <div class="row">
                <div class="col-3"><?=$row->date?></div>
                <div class="col-3"><?=$row->appID?></div>
                <div class="col-3"><?=$row->name?></div>
                <div class="col-3"><?=$row->description??"-"?></div>
            </div>

        <?php endforeach;?>
    </section>
<?php endif;?>
