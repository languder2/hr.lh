
$(document).ready(function(){
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
