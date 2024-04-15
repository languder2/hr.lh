document.addEventListener("DOMContentLoaded", function() {
    let form= document.querySelector(".poll-box form");
    form.addEventListener("submit",(e)=>{
        let check= checkForm();
        if(check){
            sortResults();
            pollHide("form");
            pollShow("results");
        }
        //const form = document.querySelector('form');
        const params = new FormData(form);
//        const request = new XMLHttpRequest();
//        request.send(params);
        console.log(params);
        return false;
    });
    document.getElementById('poll-form-name').addEventListener("keyup",(e)=>{
        checkFormField(e.target,"name");
    });

    let email= document.getElementById('poll-form-email');
    email.addEventListener("keypress",(e)=>{
        checkFormField(e.target,"email");
    });
    email.addEventListener("change",(e)=>{
        checkFormField(e.target,"email");
    });

    let phone= document.getElementById('poll-form-phone');
    const phoneMask = IMask(phone, {
        mask: '+{7} (000) 000-00-00',
    });
    phoneMask.on('accept', (e) => {
        e.target.classList.remove("is-valid","is-invalid");
    });
    phoneMask.on('complete', () => {phone.classList.add("is-valid")});
    phone.addEventListener("change",(e)=>{
        checkFormField(e.target,"phone");
    });

    document.querySelector(".poll-box .btn_prev").addEventListener("click",() => pollPrevStep())
    document.querySelector(".poll-box .btn_next").addEventListener("click",() => pollNextStep())

});

function checkFormField(el,type){
    el.classList.remove("is-valid","is-invalid");
    switch (type){
        case "name":
            el.classList.add(el.value.length?"is-valid":"is-invalid");
        break;
        case "email":
            el.classList.add(/^\w+@\w+[.][a-z]{2,3}$/i.test(el.value)?"is-valid":"is-invalid");
        break;
        case "phone":
            el.classList.add(/^\+7 \([0-9]{3}\) [0-9]{3}(-[0-9]{2}){2}$/.test(el.value)?"is-valid":"is-invalid");
        break;
    }
}
function answerBySelected(el){
    let current= parseInt(el.getAttribute("data-qid"));
    let max= parseInt(document.querySelector(".poll-box [name=max]").value);
    let next= getNextStep(current,max);
    document.querySelector(".poll-box [name=step]").value= next;
    pollHide(current);
    pollShow(next);
    changeProgressBar(next,max);
    pollCheckedBtn(next,max);
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
        el.style.animationDelay= (0.15*i)+"s";
        el.addEventListener("animationend", () => {
            el.classList.remove("poll-animation-hide");
            el.classList.add("poll-hidden");
        });
    });
    return false;
}
function pollShow(step){
    document.querySelector(".poll-box [data-step-box='"+step+"']").classList.add("poll-step-active");
    let list= document.querySelectorAll(".poll-box [data-step='"+step+"']");
    list.forEach((el,i) => {
        el.classList.add("poll-animation-show");
        el.style.animationDelay= (0.5+0.15*i)+"s";
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
function pollPrevStep(){
    let step= parseInt(document.querySelector(".poll-box [name=step]").value);
    let max= parseInt(document.querySelector(".poll-box [name=max]").value);
    if(step<=1) return false;
    document.querySelector(".poll-box [name=step]").value= step-1;
    pollHide(step);
    pollShow(step-1);
    changeProgressBar(step-1,max);
    pollCheckedBtn(step-1,max);
    sortResults();
}
function pollNextStep(){
    let current= parseInt(document.querySelector(".poll-box [name=step]").value);
    let max= parseInt(document.querySelector(".poll-box [name=max]").value);
    let next= getNextStep(current,max);
    document.querySelector(".poll-box [name=step]").value= next;
    pollHide(current);
    pollShow(next);
    changeProgressBar(next,max);
    pollCheckedBtn(next,max);
    sortResults();
    return false;
}

function pollCheckedBtn(step,max){
    let btnPrev= document.querySelector(".poll-box .btn_prev").classList;
    if(step>1){
        btnPrev.remove("disabled","btn-secondary");
        btnPrev.add("btn-purple");
    }
    else{
        btnPrev.add("disabled","btn-secondary");
        btnPrev.remove("btn-purple");
    }
    let list= document.querySelectorAll(".poll-box [data-step='"+step+"'] .radio-answer:checked");
    let btnNext= document.querySelector(".poll-box .btn_next").classList;
    if(list.length>0 && step<max){
        btnNext.remove("disabled","btn-secondary");
        btnNext.add("btn-purple");
    }else{
        btnNext.add("disabled","btn-secondary");
        btnNext.remove("btn-purple");
    }
}
function sortResults(){
    let list= document.querySelectorAll(".poll-box .radio-answer:checked");
    let order= [];
    let answers = [];
    list.forEach((el)=>{
        let rid= parseInt(el.getAttribute("data-rid"));
        let rw = parseInt(el.getAttribute("data-rw"));
        let qid = parseInt(el.getAttribute("data-qid"));
        let aid = parseInt(el.getAttribute("data-aid"));
        if(rid!=0){
            if(order[rid])
                order[rid]+= rw
            else
                order[rid]= rw
        }
        answers.push({
            qid: qid,
            aid: aid
        });
    });
    let results= [];
    order.forEach((weight,rid)=>{
        let resEl= document.querySelector(".poll-box .poll-result[data-rid='"+rid+"']");
        resEl.style.order= -weight;
        resEl.classList.remove("d-none");
        results.push({rid: rid,weight: weight});
    });
    if(results.length == 0){
        let el= document.querySelector(".poll-box .poll-base-result");
        el.classList.remove("d-none");
        results.push({rid: el.getAttribute("data-rid"),weight: 1});
    }
    document.querySelector(".poll-box input[name='form[results]']").value= JSON.stringify(results);
    document.querySelector(".poll-box input[name='form[answers]']").value= JSON.stringify(answers);
}
function checkForm(){
    checkFormField(document.getElementById('poll-form-name'),"name");
    checkFormField(document.getElementById('poll-form-email'),"email");
    checkFormField(document.getElementById('poll-form-phone'),"phone");
    return document.querySelectorAll('.poll-box .poll-form .is-invalid').length?false:true;
}
