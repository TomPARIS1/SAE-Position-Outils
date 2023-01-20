let val_button = document.getElementById("form_sav");
val_button.addEventListener("submit", function(e) {
    e.preventDefault();

    
    let probleme = document.getElementById("probleme").value;
    let client_name = document.getElementById("identifiant").value;
    let com = document.getElementById("textarea").value;

    if (client_name!=null && client_name!="")
    {
        createSavTicket(getCookie("uui_key"), probleme, client_name, com).then(data => {
            if (!data['result'])
            {
                window.location = "connexion.html";
            };
            window.location = "SAV.html";
            //todo, add ok text
        });
        
    }
});