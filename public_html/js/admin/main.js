jQuery(function($){
    $(window).on('load', function () {
        $(".poll-box .btn_next").on("click",pollNextStep);
        $(".poll-box .btn_prev").on("click",pollPrevStep);
        $(".poll-box .radio-answer").on("click",pollSelectAnswer);


        $(".formResultStatus").change(function (){
            $.ajax({
                type: "POST",
                url: "/admin/results/status",
                data: {
                    "id":$(this).attr('data-id'),
                    "status":$(this).is(":checked")?1:0
                },
                success: function(data){
                }
            });
            return false;
        });
        $(".btnResultDelete").click(function (){
            console.log($(this).attr("href"));
            $("#modal-message .modal-title").html("Удалить результат #"+$(this).attr("data-id"));
            $("#modal-message .modal-body").html($(this).attr("data-name"));
            let modal_message_link= $("#modal-message #messageLink");
            modal_message_link.html("Удалить");
            modal_message_link.attr({
                href: $(this).attr("href"),
                class: "btn btn-danger"
            });
            $("#modal-message").modal("show");
            return false;
        });

        $(".addQuestion").click(function(){
            let current= $("[name='form[nq]']");
            let nq= current.val();
            current.val("n"+(parseInt(nq.replace("n",""))+1));
            let question= $(".example-question").html();
            question= question.replaceAll("replace-qid",nq);
            $(".questions").append(question);
            addAnswer(nq);
            return false;
        });

    });

    function addAnswer(qid){
        let answer= $(".example-answer tbody").html();
        let question= $("[data-qid="+qid+"]");
        answer= answer.replaceAll("replace-qid",qid);
        question.find(".answers tbody").append(answer);
        return false;
    }

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
            $(el).css({"animation-delay":i*0.05+"s"}).addClass("poll-hide1");
            el.addEventListener("animationend", () => {
                $(el).removeClass("poll-hide1").addClass("hide");
            });
        });
    }
    function pollAnswerShow(step){
        let next_list= $(".poll-box [data-group="+step+"]");
        $.each(next_list,function (i,el){
            $(el).css({"animation-delay":i*0.05+"s"}).addClass("poll-show1");
            el.addEventListener("animationend", () => {
                $(el).removeClass(["poll-show1","hide"]);
                if(i+1==next_list.length){
                    let step= parseInt($(".poll-box [name=poll_step]").val());
                    $(".poll-box .poll-quetion").css({"z-index":0});
                    $(".poll-box .poll-quetion").eq(step).css({"z-index":1});
                }
            });
        });
    }
    function changePollNavbar(step,max){
        $(".poll-navbar .caption .current").html(step);
        $(".poll-navbar .progress-bar").css({width:100*step/max+"%"});
        checkedPollNavbarBtns();
    }
    function checkedPollNavbarBtns(){
        let max_step= parseInt($(".poll-box [name=max_step]").val());
        let step= parseInt($(".poll-box [name=poll_step]").val())+1;
        $(".poll-navbar .btn").removeClass(["disabled","btn-secondary"]).addClass("btn-primary");
        if(step==1)
            $(".poll-navbar .btn_prev").addClass(["disabled","btn-secondary"]);
        if(step==max_step)
            $(".poll-navbar .btn_next").addClass(["disabled","btn-secondary"]);

    }

    function pollSelectAnswer(){
        let max_step= parseInt($(".poll-box [name=max_step]").val());
        let step= parseInt($(".poll-box [name=poll_step]").val())+1;
        console.log("test");
    }

});
