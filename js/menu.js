function openNav() {
    document.getElementById("mySidepanel").style.width = "13%";
}


function closeNav() {
    document.getElementById("mySidepanel").style.width = "0";
}

window.onload = function() {
    var count = document.getElementById('count').value;
    document.getElementById('count2').innerHTML = "Se han encontrado " + count + " mesas";

}