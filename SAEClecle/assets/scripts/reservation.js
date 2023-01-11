function addReservationInfos(oname, ostock, odispo)
{
    let comTemp = document.querySelector(".box_reservation").cloneNode(true);
    comTemp.style = '';
    comTemp.querySelector(".name_outil").innerHTML = oname;
    comTemp.querySelector(".stock_outil").innerHTML = "Stock: " + ostock;
    comTemp.querySelector(".dispo_outil").innerHTML = odispo ? "Disponible" : "Indisponible";
    document.querySelector("#reservation").append(comTemp);
}

/* /////////////////////////////////////
        Ajouter la liaison bdd
///////////////////////////////////// */
if (checkCookie())
{
    let selectList = document.getElementById("atelier");
    for (let i = 1; i < 3; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = "Atelier " + i;
        selectList.appendChild(option);
    }

    addReservationInfos("Marteau", 6, true)
    addReservationInfos("Tournevis", 0, false)
}