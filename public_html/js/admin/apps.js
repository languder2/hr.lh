document.addEventListener("DOMContentLoaded", function() {
    setAppsInteractive();
    let filterPhone= document.querySelector(".filter-box [name='filter[phone]']");
    let formPhone= document.querySelector("form [name='form[phone]']");
    let phoneMask = {mask: '+{7} (000) 000-00-00'};
    if(filterPhone)IMask(filterPhone,phoneMask);
    if(formPhone)IMask(formPhone,phoneMask);
    $("form.apps-filter")
        .on("submit",()=>{return false;})
        .on("change",function(){
            let formData= $(this).serialize();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function (data) {
                    $(".apps-box").html(data);
                    setAppsInteractive();
                }
            });
        });
});
function setAppsInteractive(){
    let duplicateEmails= document.querySelectorAll(".duplicate-email");
    duplicateEmails.forEach((el)=>{
        el.onclick= ()=>{
            return setFilter("email",el.getAttribute("href"));
        };
    });

    let duplicatePhones= document.querySelectorAll(".duplicate-phone");
    duplicatePhones.forEach((el)=>{
        el.onclick= ()=>{
            return setFilter("phone",el.getAttribute("href"));
        };
    });

    let appStatuses= document.querySelectorAll("select.set-status");
    appStatuses.forEach((el)=> el.onchange= changeAppStatus);
}
function changeAppStatus(e){
    if(e.target.getAttribute("data-access") === "0") return false;
    let data= new FormData();
    data.append("id",e.target.getAttribute("data-app"));
    data.append("status",e.target.value);
    fetch("/admin/apps/change/status",{
        method: "post",
        body: data
    })
    .then(response => {return response.text();});
    return false;
}
function getFormData(type,op){
    let filter= document.querySelector("form.apps-filter");
    let input= new FormData(filter);
    let output= new FormData();
    input.forEach((val,key)=>{
        filter.querySelector("[name='"+key+"']").value="";
        output.append(key,"");
    });
    output.append("filter["+type+"]",op);
    filter.querySelector("[name='filter["+type+"]']").value= op;
    output.append("filter[status]","all");
    filter.querySelector("[name='filter[status]']").value= "all";
    return output;
}
function setFilter(type,op){
    let filter= document.querySelector("form.apps-filter");
    let data= getFormData(type,op);
    fetch(filter.action,{
        method: "post",
        body: data,
    })
        .then(response => {return response.text();})
        .then(data => {
            document.querySelector(".apps-box").innerHTML= data;
            setAppsInteractive();
        });
    return false;
}