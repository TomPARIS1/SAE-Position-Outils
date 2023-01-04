const apiUrl = 'localhost/my-app/api-clecle/api/';


function getAtelierFromAccount (compte_id) {
    let atelier = fetch(apiUrl + 'readatelier.php/' + '?id_compte=' + compte_id);
    atelier.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getSingleAtelier (id_atelier) {
    let atelier = fetch(apiUrl + 'singleatelier.php/' + '?id_atelier=' + id_atelier);
    atelier.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getEtagere (id_atelier) {
    let etagere = fetch(apiUrl + 'readetagerefromatelier.php' + '?id_atelier=' + id_atelier);
    etagere.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getOutil (id_etagere) {
    let etagere = fetch(apiUrl + 'readetoutilfrometagere.php' + '?id_etagere=' + id_etagere);
    etagere.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function addUser (email, mdp) {
    fetch('../api-clecle/api/compte/createcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({nom: email, mdp: mdp, niveau: 1})
    }).then((res) => console.log(res.statusText));
}

function connexion (email, mdp) {
    const element = document.getElementById('errorConnexion');

    fetch('../api-clecle/api/compte/checkcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({nom: email, mdp: mdp})
    }).then((res) => res.json())
    .then(res => {
        console.log(res);
        if (res['codeErr'] === '0') {
            setCookie("id_username", res['id_client'], 2);
            window.location = "index.html";
        }
        else if (res['codeErr'] === '1') {
            element.innerHTML = "<h4>Erreur : le mot de passe est incorrect.</h4>";
        }
        else {
            element.innerHTML = "<h4>Erreur : l'adresse mail est incorrecte.</h4>"; 
        }
    });

}

// Ces fonctions ont été prise sur https://www.w3schools.com/js/js_cookies.asp, puis modifier pour notre utilisation
function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function checkCookie() {
    let id_username = getCookie("id_username");
    if (id_username == "") {
        window.location = "connexion.html";
        return false;
    }
    return true;
}
