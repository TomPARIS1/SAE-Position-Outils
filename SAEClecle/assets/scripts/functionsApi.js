const apiUrl = '../api-clecle/api/';


function getAtelierFromAccount (uui_key) {
    let atelier = fetch(apiUrl + 'atelier/readatelierfromcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function getOutilsFromAtelier (uui_key, id_atelier, sortmode = 0) {
    let atelier = fetch(apiUrl + 'outil/getoutilsfromateliers.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key, atelier_id: id_atelier, sortmode: sortmode})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function getOutilsFromCompte(uui_key) {
    let atelier = fetch(apiUrl + 'outil/getoutilsfromcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function getReservationFromOutil(uui_key, id_outil) {
    let atelier = fetch(apiUrl + 'reservation/readreservationfromoutil.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key, id_outil: id_outil})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function createReservationFor(uui_key, id_outil, nom_client, date_deb, date_fin) {
    let atelier = fetch(apiUrl + 'reservation/createreservation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key, id_outil: id_outil, nom_client: nom_client, date_deb: date_deb, date_fin: date_fin})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function createSavTicket(uui_key, issue, nom, commentaire) {
    let atelier = fetch(apiUrl + 'sav/createticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({uui_key: uui_key, issue: issue, nom: nom, commentaire: commentaire})
    });
    return new Promise((resolve) => {
        atelier.then((response => response.json()))
            .then((data) => {
                resolve(data);
            })
    })
}

function addUser (email, mdp) {
    fetch('../api-clecle/api/compte/createcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({nom: email, mdp: mdp, niveau: 1})
    });
}

function connexion (email, mdp) {
    
    fetch('../api-clecle/api/compte/checkcompte.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({nom: email, mdp: mdp})
    }).then((res) => res.json())
    .then(res => {
        if (res['codeErr'] === '0') {
            setCookie("uui_key", res['uui_key'], 2);
            window.location = "index.html";
        }
        else if (res['codeErr'] === '1') {
            const element = document.getElementById('errorConnexion');
            element.innerHTML = "<h4>Erreur : le mot de passe est incorrect.</h4>";
        }
        else {
            const element = document.getElementById('errorConnexion');
            element.innerHTML = "<h4>Erreur : l'adresse mail est incorrecte.</h4>";
        }
    });

}


