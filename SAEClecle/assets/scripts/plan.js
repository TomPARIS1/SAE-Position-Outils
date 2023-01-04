var imgg = document.createElement("img");
imgg.id = "imgplan";
imgg.src = "assets/images/plan2.jpg";
imgg.style ='display:none;'
var t = document.getElementById("plan");
t.appendChild(imgg);

var selectList = document.getElementById("atelier");
for (var i = 1; i < 3; i++) {
    var option = document.createElement("option");
    option.value = "assets/images/plan" + (i+1) + ".jpg";
    option.text = "Atelier " + i;
    selectList.appendChild(option);
}

var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
c.width = 700;
c.height = 500
function fillCircle(x, y, radius, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, radius, 0, 2 * Math.PI);
    ctx.fill();
}
function drawBackground(){
    var img = document.getElementById("imgplan");
    ctx.drawImage(img, 0, 0, c.width, c.height);
}

imgg.addEventListener("load", function () {
    drawBackground();
    fillCircle(50, 30, 10, 'red');
    fillCircle(200, 30, 10, 'red');
});
