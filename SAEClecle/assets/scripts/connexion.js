const formEl = document.querySelector('#formConnexion');

formEl.addEventListener('submit', (event) => {
    // Empêche le formulaire de rafraîchir la page
    event.preventDefault();

    const values = formEl.elements;

    const email = values['email'].value;

    const mdp = values['mdp'].value;

    connexion(email, mdp);
});