document.addEventListener("DOMContentLoaded", function() {
    let appDetailBox= document.querySelector(".box-app-detail");
    let appID= parseInt(appDetailBox.querySelector("[name='form[appID]']").value);

    appDetailBox.querySelector(".btn-add-comment").onclick= addComment;
    appDetailBox.querySelector("[name='new-comment']").onkeydown= (e)=> e.target.classList.remove("is-invalid");

    function addComment(){
        let newComment= appDetailBox.querySelector("[name='new-comment']");
        if(!newComment.value.length){
            newComment.classList.add("is-invalid");
            return false;
        }

        let boxComments= appDetailBox.querySelector(".box-app-detail-comments");
        let data= new FormData();
        data.append("comment",newComment.value);
        data.append("appID",appID);
        fetch("/admin/app/addComment",{
            method: "post",
            body: data,
        })
            .then(response => {return response.text();})
            .then(data => {
                console.log(data);
            });
        return false;
    }
});

