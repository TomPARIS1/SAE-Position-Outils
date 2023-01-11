const apiUrl = '../api-clecle/api/';


function getAtelierFromAccount (uui_key) {
    let atelier = fetch(apiUrl + 'atelier/readatelier.php' + '?id_compte=' + uui_key);
    atelier.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getSingleAtelier (id_atelier) {
    let atelier = fetch(apiUrl + 'atelier/singleatelier.php' + '?id_atelier=' + id_atelier);
    atelier.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getEtagere (id_atelier) {
    let etagere = fetch(apiUrl + 'etagere/readetagerefromatelier.php' + '?id_atelier=' + id_atelier);
    etagere.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getOutil (id_etagere) {
    let etagere = fetch(apiUrl + 'outil/readoutilfrometagere.php' + '?id_etagere=' + id_etagere);
    etagere.then((response => response.json()))
        .then((data) => {
            return data;
        })
}

function getAllOutil () {
    let outils = fetch(apiUrl + 'outil/readoutil.php');
    return new Promise((resolve) => {
        outils.then((response => response.json()))
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


