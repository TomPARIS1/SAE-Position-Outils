function reloadImg(imgPath)
{
    let oldImg = document.getElementById("imgplan");
    if (oldImg != null)
    {
        let plan = document.getElementById("plan");
        plan.removeChild(oldImg);
    }

    let imgg = document.createElement("img");
    imgg.id = "imgplan";
    imgg.src = imgPath;
    imgg.style ='display:none;';

    let t = document.getElementById("plan");
    t.appendChild(imgg);
    

    imgg.addEventListener("load", function () {
        let c = document.getElementById("myCanvas");
        c.width = 700;
        c.height = 500

        let ctx = c.getContext("2d");
        drawBackground(ctx, c);
        
        if (document.getElementById("atelier").value=="assets/images/plan.jpg")
        {
            fillCircle(ctx, 50, 30, 10, 'red');
            fillCircle(ctx, 200, 30, 10, 'red');
        }
        else
        {
            fillCircle(ctx, 75, 30, 10, 'red');
            fillCircle(ctx, 150, 100, 10, 'red');
        }
    });
}

function fillCircle(ctx, x, y, radius, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, radius, 0, 2 * Math.PI);
    ctx.fill();
}

function drawBackground(ctx, c){
    let img = document.getElementById("imgplan");
    ctx.drawImage(img, 0, 0, c.width, c.height);
}





if (checkCookie())
{
/* /////////////////////////////////////
        Ajouter la liaison bdd
///////////////////////////////////// */
    reloadImg("assets/images/plan.jpg");

    getAtelierFromAccount(getCookie("uui_key")).then(data => {
        if (!data['result'])
        {
            window.location = "connexion.html";
        }

        let selectList = document.getElementById("atelier");
        for (let i = 1; i <= data['itemCount']; i++) {
            let option = document.createElement("option");
            option.value = Object.values(data['body'][i-1]);
            option.text = "Atelier " + i;
            selectList.appendChild(option);
        }
        /* ////////////////////////////////// */

        selectList.addEventListener("change", function() {
            let arr = selectList.value.split(',');
            reloadImg("assets/" + arr[4]);
        });
    });
}



