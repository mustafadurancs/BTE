function validateForm(Form_Ismi) {
    var x = document.forms[Form_Ismi]["randevu"].value;
    if (x == null || x == "") 
    {
        alert("ADI ve SOYADINI GİRMEDİNİZ!!!");
        return false;
    }
}

