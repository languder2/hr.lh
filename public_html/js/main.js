$(window).on('load', function () {
    $(".poll-box .btn_next").on("click",pollNextStep);
    $(".poll-box .btn_prev").on("click",pollPrevStep);
    $(".poll-box .radio-answer").on("click",pollSelectAnswer);
    $('#poll-form-phone').inputmask("+7(999)999-9999",{pos:0});
    $(".poll-app-from").on("submit",function(){
        let list = $(".poll-box form .form-control");
        list.removeClass(["is-valid","is-invalid"])

        let name= $("#poll-form-name");
        if(name.val().length==0)
            name.addClass("is-invalid");
        else
            name.addClass("is-valid");

        let email= $("#poll-form-email");
        if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email.val()))
            email.addClass("is-valid");
        else
            email.addClass("is-invalid");

        let phone= $("#poll-form-phone");
        if(/^(\+7|8)\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{2}[\s.-]?\d{2}$/.test(phone.val()))
            phone.addClass("is-valid");
        else
            phone.addClass("is-invalid");

        if($(".poll-box form .is-invalid").length === 0){
            pollAnswerHide("form");
            pollAnswerShow("results");
        }
        return false;
    });
});


function pollNextStep(){
    let max_step= parseInt($(".poll-box [name=max_step]").val());
    let step= parseInt($(".poll-box [name=poll_step]").val());
    if(step+1>=max_step) return false;
    $(".poll-box [name=poll_step]").val(step+1);
    pollAnswerHide(step);
    pollAnswerShow(step+1);
    changePollNavbar(step+2,max_step);
    return false;
}
function pollPrevStep(){
    let max_step= parseInt($(".poll-box [name=max_step]").val());
    let step= parseInt($(".poll-box [name=poll_step]").val());
    if(step-1<0) return false;
    $(".poll-box [name=poll_step]").val(step-1);
    pollAnswerHide(step);
    pollAnswerShow(step-1);
    changePollNavbar(step,max_step);
    return false;
}

function pollAnswerHide(step){
    let display_list= $(".poll-box [data-group="+step+"]");
    $.each(display_list,function (i,el){
        $(el).css({"animation-delay":i*0.05+"s"}).addClass("poll-hide");
        el.addEventListener("animationend", () => {
            $(el).removeClass("poll-hide").addClass("hide");
        });
    });
}
function pollAnswerShow(step){
    let next_list= $(".poll-box [data-group="+step+"]");
    $.each(next_list,function (i,el)    {
        $(el).css({"animation-delay":i*0.05+"s"}).addClass("poll-show");
        el.addEventListener("animationend", () => {
            $(el).removeClass(["poll-show","hide"]);
        });
    });
    changeZIndex(step);
}
function changeZIndex(step){
    $(".poll-box [data-step]").css({"z-index":0});
    $(".poll-box [data-step="+step+"]").css({"z-index":1});
}
function changePollNavbar(step,max){
    $(".poll-navbar .caption .current").html(step);
    $(".poll-navbar .progress-bar").css({width:100*step/max+"%"});
    checkedPollNavbarBtns();
}
function checkedPollNavbarBtns(){
    let max_step= parseInt($(".poll-box [name=max_step]").val());
    let step= parseInt($(".poll-box [name=poll_step]").val());
    let current= $(".poll-box [name=answer2q_"+step+"]:checked");
    if(step==0)
        $(".poll-navbar .btn_prev").addClass(["disabled","btn-secondary"]);
    else
        $(".poll-navbar .btn_prev").removeClass(["disabled","btn-secondary"]).addClass("btn-primary");
    if(step>=max_step || current.length>0)
        $(".poll-navbar .btn_next").removeClass(["disabled","btn-secondary"]).addClass("btn-primary");
    else
        $(".poll-navbar .btn_next").addClass(["disabled","btn-secondary"]);

}
function pollSelectAnswer(){
    let max_step= parseInt($(".poll-box [name=max_step]").val());
    let step= parseInt($(".poll-box [name=poll_step]").val())
    $(".poll-box [type=radio]:not(:checked)").closest("label").removeClass("active");
    $(".poll-box [type=radio]:checked").closest("label").addClass("active");
    $(".poll-box [name=poll_step]").val(step+1);
    pollAnswerHide(step);
    if(step+2<=max_step){
        changePollNavbar(step+2,max_step);
        pollAnswerShow(step+1);
    }
    if(step+1>=max_step){
        pollAnswerShow("form");
        $(".poll-box .poll-navbar").animate({opacity:0},500);
    }
    ordersResult();
}
function ordersResult(){
    let result= [];
    let list= document.querySelectorAll(".poll-box .poll-question [type=radio]:checked");
    list.forEach(function(entry) {
        let rid= $(entry).attr("data-result");
        let rw= parseInt($(entry).attr("data-result-weight"));
        if (typeof result[rid] === 'undefined'){
            result[rid]= rw;
        }
        else{
            result[rid]+= rw;
        }
    });
    $(".poll-box .poll-result").css({display:"none"});
    result.forEach(function (val,i){
        if(val!=0)
            $(".poll-box .poll-result[data-rid="+i+"]").css({display:"block", order:-val})
    });
    if($(".poll-box .poll-result:visible").length === 0)
        $(".poll-box .poll-base-result").css({display:"block"});
}
