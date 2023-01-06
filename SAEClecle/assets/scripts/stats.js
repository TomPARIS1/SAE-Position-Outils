function addStatsInfos(oname, outilis)
{
    let comTemp = document.querySelector(".box_reservation").cloneNode(true);
    comTemp.style = '';
    comTemp.querySelector(".name_outil").innerHTML = oname;
    comTemp.querySelector(".utilistion_outil").innerHTML = "Nombre d'utilisation: " + outilis;
    document.querySelector("#statistiques").append(comTemp);
}


var selectList = document.getElementById("atelier");
for (var i = 1; i < 3; i++) {
    var option = document.createElement("option");
    option.value = i;
    option.text = "Atelier " + i;
    selectList.appendChild(option);
}

/* /////////////////////////////////////
        Ajouter la liaison bdd
///////////////////////////////////// */
addStatsInfos("Marteaux", 322);
addStatsInfos("Tournevis", 32);