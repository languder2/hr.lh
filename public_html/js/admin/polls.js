document.addEventListener("DOMContentLoaded", function() {
    setPollsInteractive();
});
function setPollsInteractive(){
    let editBtnList= document.querySelectorAll(".btn-edit");
    editBtnList.forEach((el)=> el.onclick= editBtnClick);
    let removeBtnList= document.querySelectorAll(".btn-remove");
    removeBtnList.forEach((el)=> el.onclick= removeBtnClick);
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
            document.querySelector("tr[data-pid='"+e.target.getAttribute("data-pid")+"']").remove();
        });
    return false;
}