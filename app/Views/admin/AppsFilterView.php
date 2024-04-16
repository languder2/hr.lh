<div class="container px-0">
    <form action="/admin/apps/set/filter" method="POST" class="row apps-filter">
        <div class="col col-lg-2">
            <input class="form-control" type="date" name="filter[date]" max="<?=date("Y-m-d")?>" value="<?=$filter['date']??""?>" autocomplete="off">
        </div>
        <div class="col col-lg-4">
            <input class="form-control" type="text" name="filter[name]" value="<?=$filter['name']??""?>" placeholder="Имя" autocomplete="off">
        </div>
        <div class="col col-lg-2">
            <input class="form-control" type="text" name="filter[email]" value="<?=$filter['email']??""?>" placeholder="email" autocomplete="off">
        </div>
        <div class="col col-lg-2">
            <input class="form-control" type="text" name="filter[phone]" autocomplete="off" value="<?=$filter['phone']??""?>" placeholder="телефон">
        </div>
        <div class="col col-lg-2">
            <select class="form-select set-filter-status" name="filter[status]" >
                <option value="all">Все</option>
                <?php if(isset($statuses->app)) foreach ($statuses->app as $code=>$status): ?>
                    <option value="<?=$code?>"
                        <?=(isset($filter['status']) and $filter['status']===$code)?"selected":""?>
                    >
                        <?=$status->name?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>
    </form>
</div>
