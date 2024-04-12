document.addEventListener("DOMContentLoaded", function(event) {
});
function answerbySelected(el){
    let current= parseInt(el.getAttribute("data-qid"));
    let max= parseInt(document.querySelector(".poll-box [name=max]").value);
    let next= getNextStep(current,max);
    document.querySelector(".poll-box [name=step]").value= next;
    pollHide(current);
    pollShow(next);
    changeProgressBar(next,max);
    pollCheckedBtn(next);
    return false;
}
function getNextStep(current,max){
    if(current+1<=max)
        return current+1;
    else
        return "form";
}
function pollHide(step){
    document.querySelector(".poll-box [data-step-box='"+step+"']").classList.remove("poll-step-active");
    let list= document.querySelectorAll(".poll-box [data-step='"+step+"']");
    list.forEach((el,i) => {
        el.classList.add("poll-animation-hide");
        el.style.animationDelay= (0.3*i)+"s";
        el.addEventListener("animationend", () => {
            el.classList.remove("poll-animation-hide");
            el.classList.add("poll-hidden");
        });
    });
    return false;
}
function pollShow(step){
    if(step== "form") return false;
    document.querySelector(".poll-box [data-step-box='"+step+"']").classList.add("poll-step-active");
    let list= document.querySelectorAll(".poll-box [data-step='"+step+"']");
    list.forEach((el,i) => {
        el.classList.add("poll-animation-show");
        el.style.animationDelay= (0.5+0.3*i)+"s";
        el.addEventListener("animationend", () => {
            el.classList.remove("poll-animation-show");
            el.classList.remove("poll-hidden");
        });
    });
    return false;
}
function changeProgressBar(step,max) {
    if (step <= max){
        document.querySelector(".poll-box .progress-bar").style.width = Math.ceil(100 * step / (max + 1)) + "%";
        document.querySelector(".poll-box .current").innerText = step;
    }
    else{
        let navbar= document.querySelector(".poll-box .poll-navbar");
        navbar.classList.add("poll-bar-hide");
        navbar.addEventListener("animationend", () => {
            navbar.classList.remove("poll-bar-hide");
            navbar.classList.add("d-none");
        });
    }
}

function pollCheckedBtn(step){
    if(step!=0){
        document.querySelector(".poll-box .btn_prev").classList.remove("disabled");
        document.querySelector(".poll-box .btn_prev").classList.remove("btn-secondary");
        document.querySelector(".poll-box .btn_prev").classList.add("btn-purple");
    }
}