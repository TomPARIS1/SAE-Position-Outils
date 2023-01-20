const formEl = document.querySelector('#formInscription');

formEl.addEventListener('submit', (event) => {
    // Empêche le formulaire de rafraîchir la page
    event.preventDefault();

    const values = formEl.elements;

    const email = values['emailInscription'].value;

    const mdp = values['mdpInscription'].value;

    mdp.minLength = 8;
    mdp.maxLength = 30;

    const confirmMdp = values['confirmMdp'].value;

    const element = document.getElementById('error');

    if ((mdp === confirmMdp) && (typeof mdp !== 'undefined') && (typeof email !== 'undefined')) {
        addUser(email, mdp);
        window.location = "connexion.html";
    }
    else {
        element.innerHTML = "<h4>Erreur : les mots de passe ne sont pas similaires.</h4>";
    }
});