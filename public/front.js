var sittings = document.querySelector(".settings");

var darkbtn = document.getElementById("dark");

var not = document.querySelector(".not");

var ins = document.querySelector(".ins");

var vids =document.querySelector(".vids");


function settingstoggle(){
    sittings.classList.toggle("settingsheight");/*tehabet we tala3 leblaka taa deconexion */
}
function  notstoggle(){
    not.classList.toggle("notheight");
}
function  instoggle(){
    ins.classList.toggle("insheight");
}
function  vidstoggle(){
    vids.classList.toggle("vidsheight");
}

darkbtn.onclick = function(){
    darkbtn.classList.toggle("dark1");    /*tbadel itheme  */
    document.body.classList.toggle("darkthe")

}
