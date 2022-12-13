const formEl = document.querySelector('#formInscription');

formEl.addEventListener('submit', (event) => {
    // Empêche le formulaire de rafraîchir la page
    event.preventDefault();

    const values = formEl.elements;

    const email = values['emailInscription'].value;

    const mdp = values['mdpInscription'].value;

    const confirmMdp = values['confirmMdp'].value;

    const element = document.getElementById('error');

    (mdp === confirmMdp) ? addUser(email, mdp) : element.innerHTML = "<h4>Erreur : les mots de passe ne sont pas similaires.</h4>";
});