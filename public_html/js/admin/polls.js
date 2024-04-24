document.addEventListener("DOMContentLoaded", function() {
    setPollsInteractive();
});
function setPollsInteractive(){
    let editBtnList= document.querySelectorAll(".btn-edit");
    editBtnList.forEach((el)=> el.onclick= editBtnClick);
    let removeBtnList= document.querySelectorAll(".btn-remove");
    removeBtnList.forEach((el)=> el.onclick= removeBtnClick);
    let changeStatusBtnList= document.querySelectorAll(".btnPollChangeStatus");
    changeStatusBtnList.forEach((el)=> el.onclick= pollChangeStatus);
}

function pollChangeStatus(e){
    let pid= e.target.getAttribute("data-pid");
    fetch("/admin/poll/change/status",{
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({pid: pid})
    })
        .then(response => {return response.text();})
        .then(data =>{
            window.location.reload();
        });
}
function editBtnClick(e){
    window.location.href= e.target.getAttribute("data-action");
}
function removeBtnClick(e){
    fetch(e.target.getAttribute("data-action"),{
        method: "get",
    })
        .then(response => {return response.text();})
        .then(data => {
            window.location.reload();
        });
    return false;
}