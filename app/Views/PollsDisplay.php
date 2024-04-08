<?php if(isset($header)) echo $header; ?>
<div class="poll-box mx-auto mt-5 position-relative" style="width: <?=$width??600?>px; height: <?=$height??600?>px">
    <div class="poll-questions position-relative">
        <?php if(isset($poll)) foreach ($poll->questions as $qk=>$question):?>
            <div class="poll-quetion position-absolute w-100 <?=$qk?"hide":""?> group-<?=$qk?>">
                <h4 class="poll-caption">
                    <?=$question->question??""?>
                </h4>
                <?php foreach ($question->answers as $ak=>$answer):?>
                    <div class="poll-answer">
                        <label class="form-check-label d-block border border-1 border-custom1 rounded-3 p-3 mb-2" for="a_<?=$question->id?>_<?=$ak?>">
                            <input class="form-check-input mr-5" type="radio" name="q_<?=$question->id?>" id="a_<?=$question->id?>_<?=$ak?>">
                            <span class="d-inline-block ml-10">
                                        <?=$answer->answer??""?>
                                    </span>
                        </label>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    </div>
    <div class="poll-status position-absolute bottom-0">
        <input type="text" value="0">
        <button class="btn btn-primary btn_prev">prev</button>
        <button class="btn btn-primary btn_next">next</button>
    </div>
</div>
<?php if(isset($footer)) echo $footer; ?>
