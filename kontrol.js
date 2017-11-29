function validateForm(Form_Ismi) {
    var x = document.forms[Form_Ismi]["randevu"].value;
    if (x == null || x == "") 
    {
        alert("ADI ve SOYADINI GİRMEDİNİZ!!!");
        return false;
    }
}

function Mesaj(message){
    setTimeout(function(){
        alert(message);
    }, 1000);
}

function test() {
    var cboxes = document.getElementsByName('mailId[]');
    var len = cboxes.length;
    for (var i=0; i<len; i++) {
        alert(i + (cboxes[i].checked?' checked ':' unchecked ') + cboxes[i].value);
    }
}