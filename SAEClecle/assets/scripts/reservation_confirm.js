function addReservationInfos(cname, date_deb, date_fin)
{
    let comTemp = document.querySelector(".box_reservation").cloneNode(true);
    comTemp.style = '';
    comTemp.id = 'unwantedChild';
    comTemp.querySelector(".name_client").innerHTML = cname;

    let arr = date_deb.split(' ');
    let date_deb_day = arr[0];
    let date_deb_hour = arr[1].split(':')[0] + "h" + arr[1].split(':')[1];

    arr = date_fin.split(' ');
    let date_fin_day = arr[0];
    let date_fin_hour = arr[1].split(':')[0] + "h" + arr[1].split(':')[1];
    
    comTemp.querySelector(".utilistion_outil").innerHTML = "Du " + date_deb_day + " (" + date_deb_hour + ") au " + date_fin_day + " (" + date_fin_hour + ")";
    
    document.querySelector("#listreservation").append(comTemp);
}

function clearUnwantedChild()
{
    const parent = document.getElementById("listreservation");

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

function removeAll(selectBox) {
    while (selectBox.options.length > 0) {
        selectBox.remove(0);
    }
}

function adaptFin(selectList2, selectList)
{
    valueselected = selectList.value;
    max = Number(selectList2.value)
    removeAll(selectList);
    for (let i = max+1; i <= 20; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = i + "h";
        selectList.appendChild(option);
    }
    if (max<=valueselected)
        selectList.value = valueselected;
}

function adaptDebut(selectList, selectList2)
{
    valueselected = selectList.value;
    max = Number(selectList2.value)
    removeAll(selectList);
    for (let i = 6; i <= max-1; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = i + "h";
        selectList.appendChild(option);
    }

    if (max>=valueselected)
        selectList.value = valueselected;
}


if (checkCookie())
{
    
    getReservationFromOutil(getCookie("uui_key"), getCookie("outil_for_res")).then(data => {
        if (!data['result'])
        {
            window.location = "connexion.html";
        }
        
        if (data['noreservation'])
        {
            clearUnwantedChild()
            document.getElementById("reserv_title").style = 'display:none;';
        }
        else
        {
            clearUnwantedChild()
            document.getElementById("reserv_title").style = ''; 
            for (let i = 0; i < data['itemCount']; i++) {
                addReservationInfos(data['body'][i]['nom_client'], data['body'][i]['date_debut'], data['body'][i]['date_fin']);
            }
        }

        let selectList = document.getElementById("date_deb");
        for (let i = 6; i <= 20; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.text = i + "h";
            selectList.appendChild(option);
        }

        let selectList2 = document.getElementById("date_fin");
        for (let i = 7; i <= 20; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.text = i + "h";
            selectList2.appendChild(option);
        }

        selectList.addEventListener("change", function() {
            adaptFin(selectList, selectList2);
        });

        selectList2.addEventListener("change", function() {
            adaptDebut(selectList, selectList2);
        });

        let val_button = document.getElementById("valide_resev");
        val_button.addEventListener("submit", function(e) {
            e.preventDefault();
            
            let datedeb = document.getElementById("date_reserv").value + " " + selectList.value + ":00:00";
            let datefin = document.getElementById("date_reserv").value + " " + selectList2.value + ":00:00";

            let client_name = document.getElementById("nom_client").value;

            if (selectList.value!=null && selectList.value!=null && (client_name!=null && client_name!=""))
            {
                createReservationFor(getCookie("uui_key"), getCookie("outil_for_res"), client_name, datedeb, datefin).then(data2 => {
                    if (!data['result'])
                    {
                        window.location = "connexion.html";
                    }
                    
                    //TODO: Add ok text, tu peux véridier avec data['created'] 
                    
                    window.location = "confirm_reservation.html";
                });
            }
        });
    });
}