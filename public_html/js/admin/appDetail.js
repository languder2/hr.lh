document.addEventListener("DOMContentLoaded", function() {
    let appDetailBox= document.querySelector(".box-app-detail");
    let boxComments= appDetailBox.querySelector(".box-app-detail-comments");
    let formNewComment= appDetailBox.querySelector(".form-app-detail-new-comment");
    formNewComment.onsubmit= addComment;

    reownRemoveBtnOnClick();
    function addComment(){
        let newComment= appDetailBox.querySelector("[name='form[comment]']");
        if(!newComment.value.length){
            newComment.classList.add("is-invalid");
            return false;
        }
        newComment.classList.remove("is-invalid");
        let data= new FormData(formNewComment);
        newComment.value= "";
        fetch(formNewComment.action,{
            method: "post",
            body: data,
        })
            .then(response => {return response.text();})
            .then(data => {
                boxComments.querySelector(".comments").innerHTML= data;
                reownRemoveBtnOnClick();
            });
        return false;
    }

    function reownRemoveBtnOnClick(){
        let commentRemoveBtns= boxComments.querySelectorAll(".btn-remove-comment");
        commentRemoveBtns.forEach((btn) => btn.onclick= removeComment);
    }

    function removeComment(e){
        fetch(e.target.href,{
            method: "get",
        })
            .then(response => {return response.text();})
            .then(data => {
                boxComments.querySelector(".comments").innerHTML= data;
                reownRemoveBtnOnClick();
            });
        return false;
    }
});

