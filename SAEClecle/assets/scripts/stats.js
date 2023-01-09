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

function loadStats()
{
    clearUnwantedChild();

    getAllOutil().then(data => {
        for (let i = 0; i < 4 /*data['itemCount']*/; i++) {
            addStatsInfos(data['body'][i]['type'], data['body'][i]['nbr_utilisations']);
        }
    });
}

if (checkCookie())
{
    let selectList = document.getElementById("atelier");
    for (let i = 1; i < 3; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = "Atelier " + i;
        selectList.appendChild(option);
    }

    selectList.addEventListener("change", function() {
        loadStats();
    });

    let ordreList = document.getElementById("ordre");
    ordreList.addEventListener("change", function() {
        loadStats();
    });

    loadStats();
}