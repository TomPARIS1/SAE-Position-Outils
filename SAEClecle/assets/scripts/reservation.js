function addReservationInfos(oname, id)
{
    let comTemp = document.querySelector(".box_reservation").cloneNode(true);
    comTemp.style = '';
    comTemp.id = 'unwantedChild';
    comTemp.querySelector(".name_outil").innerHTML = oname;
    
    let selectbutton = comTemp.querySelector(".reservation_selector");
    selectbutton.id = id;

    document.querySelector("#listoutil").append(comTemp);

    selectbutton.addEventListener("click", function(e) {
        e.preventDefault();
        setCookie("outil_for_res", selectbutton.id, 1);
        window.location = "confirm_reservation.html";
    });
}

function clearUnwantedChild()
{
    const parent = document.getElementById("listoutil");

    let firstIsWanted = false;
    if (parent.firstChild && parent.firstChild.id != 'unwantedChild')
        firstIsWanted = true;

    if (!firstIsWanted)
    {
        while (parent.firstChild && parent.firstChild.id == 'unwantedChild') {
            parent.firstChild.remove();
        }
    }
    else
    {
        while (parent.lastChild && parent.lastChild.id == 'unwantedChild') {
            parent.lastChild.remove();
        }
    }
}

function loadReservation(id_atelier)
{
    getOutilsFromAtelier(getCookie("uui_key"), id_atelier, 1).then(data => {
        
        if (!data['result'])
        {
            window.location = "connexion.html";
        }
        else
        {
            clearUnwantedChild();
            for (let i = 0; i < data['itemCount']; i++) {
                addReservationInfos(data['body'][i]['type'], data['body'][i]['id']);
            }
        }
    });
}

/* /////////////////////////////////////
        Ajouter la liaison bdd
///////////////////////////////////// */
if (checkCookie())
{
    getAtelierFromAccount(getCookie("uui_key")).then(data => {
        if (!data['result'])
        {
            window.location = "connexion.html";
        }

        let selectList = document.getElementById("atelier");
        for (let i = 1; i <= data['itemCount']; i++) {
            let option = document.createElement("option");
            option.value = Object.values(data['body'][i-1]['id_atelier']);
            option.text = "Atelier " + i;
            selectList.appendChild(option);
        }

        loadReservation(data['body'][0]['id_atelier']);

        selectList.addEventListener("change", function() {
            loadReservation(selectList.value);
        });
    });
}