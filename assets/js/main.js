function check()
{
    checkbox = document.getElementById("accept-check");


    return checkbox.checked;
}


$("#myModal").on("shown.bs.modal", function () 
{
    $("#myInput").focus();
});


function calcolaCF()
{
    debugger;
    nome = $("#nomeCF").val();
    cognome = $("#cognomeCF").val();
    sesso = $("input[name='sessoCF']");
    for(i = 0; i < sesso.length; i ++)
    {
        if(sesso[i].checked)
        {
            sesso = sesso[i].value;
        }
    }
    giorno = parseInt($("#dataNascitaCF").val().split("-")[2]);
    mese = parseInt($("#dataNascitaCF").val().split("-")[1]);
    anno = parseInt($("#dataNascitaCF").val().split("-")[0]);
    luogoNascita = $("#luogoNascitaCF").val();
    provincia = $("#provinciaCF").val();

    
    try
    {
        cf = new CodiceFiscale(
        {
            name: nome,
            surname: cognome,
            gender: sesso,
            day: giorno,
            month: mese,
            year: anno,
            birthplace: luogoNascita, 
            birthplaceProvincia: provincia // Optional
        });
    }
    catch(exception)
    {
        return false;
    }


    $("input[name='txtCF']").val(cf);
    $('#myModal').modal("toggle");


    $("#formCF").find("input[type='text'], input[type='date']").val("");
    $("input[name='sessoCF']").prop("checked", false);



    return false;
}
