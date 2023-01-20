function addStatsInfos(oname, outilis)
{
    let comTemp = document.querySelector(".box_reservation").cloneNode(true);
    comTemp.style = '';
    comTemp.id = 'unwantedChild';
    comTemp.querySelector(".name_outil").innerHTML = oname;
    comTemp.querySelector(".utilistion_outil").innerHTML = "Nombre d'utilisation: " + outilis;
    
    const ordreList = document.getElementById("ordre");
    if (ordreList.value == "asc")
        document.querySelector("#listoutil").append(comTemp);
    else
        document.querySelector("#listoutil").prepend(comTemp);
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

function loadStats(id_atelier)
{
    clearUnwantedChild();

    if (id_atelier=="-1")
    {
        getOutilsFromCompte(getCookie("uui_key")).then(data => {
            if (!data['result'])
            {
                window.location = "connexion.html";
            }
            else
            {
                for (let i = 0; i < data['itemCount']; i++) {
                    addStatsInfos(data['body'][i]['type'], data['body'][i]['nbr_utilisations']);
                }
            }
        });
    }
    else
    {
        getOutilsFromAtelier(getCookie("uui_key"), id_atelier).then(data => {
            if (!data['result'])
            {
                window.location = "connexion.html";
            }
            else
            {
                for (let i = 0; i < data['itemCount']; i++) {
                    addStatsInfos(data['body'][i]['type'], data['body'][i]['nbr_utilisations']);
                }
            }
        });
    }
}

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
        

        selectList.addEventListener("change", function() {
            loadStats(selectList.value);
        });

        let ordreList = document.getElementById("ordre");
        ordreList.addEventListener("change", function() {
            loadStats(selectList.value);
        });

        loadStats("-1");
    });
}