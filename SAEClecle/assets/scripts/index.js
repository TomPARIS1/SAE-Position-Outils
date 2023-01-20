function reloadImg(imgPath, id_atelier, xmax, ymax)
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
        c.height = 500;
        x_mult = 700/xmax;
        y_mult = 500/ymax;

        let ctx = c.getContext("2d");
        drawBackground(ctx, c);

        getOutilsFromAtelier(getCookie("uui_key"), id_atelier).then(data => {
            if (!data['result'])
            {
                window.location = "connexion.html";
            }
            else
            {
                for (let i = 1; i <= data['itemCount']; i++) {
                    fillCircle(ctx, (data['body'][i-1]['x'])*x_mult, (data['body'][i-1]['y'])*y_mult, 10, 'red');
                }
            }
        });
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
        
        reloadImg("assets/" + data['body'][0]['plan'], data['body'][0]['id_atelier'], data['body'][0]['x'], data['body'][0]['y']);

        

        selectList.addEventListener("change", function() {
            let arr = selectList.value.split(',');
            reloadImg("assets/" + arr[4], arr[1], arr[2], arr[3]);
        });
    });
}



