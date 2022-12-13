const apiUrl = 'localhost/my-app/api-clecle/api/';
console.log("hello")

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
    console.log("bonjour")
    fetch('localhost/my-app/api-clecle/api/compte/createcompte.php', {
        method: "POST",
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({"nom": email, "mdp": mdp, "niveau": 1})
    }).then((res) => res.json().then((res) => console.log(res)));
}
