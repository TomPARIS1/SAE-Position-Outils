<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Site Cléclé</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="icon" type="image/png" href="images/outils.png">
        <script src="https://unpkg.com/konva@8/konva.min.js"></script>
    </head>

    <body>
        
        <header>
            <?php include('header.php'); ?>
        </header>

        <div id="corps">
            <h2>Localisation des outils</h2>

            <div id="container">
                <!--<script>
                    var WIDTH = 1000;
                    var HEIGHT = 1000;
                    var NUMBER = 10;

                    var stage = new Konva.Stage({
                        container: 'container',
                        width: WIDTH,
                        height: HEIGHT,
                    });

                    var text = new Konva.Text({
                        x: 10,
                        y: 10,
                        fontFamily: 'Calibri',
                        fontSize: 24,
                        text: '',
                        fill: 'black',
                    });

                    var layer = new Konva.Layer();
                    layer.add(text);
                    stage.add(layer);

                    function generateNode() {
                        return new Konva.Circle({
                            x: WIDTH * Math.random(),
                            y: HEIGHT * Math.random(),
                            radius: 5,
                            fill: 'red',
                        });
                    }

                    function point_hover(event)
                    {
                        let point = event.currentTarget;
                        document.body.style.cursor = 'pointer';
                        text.text = "nom outil";
                    }

                    function point_leave(event)
                    {
                        let point = event.currentTarget;
                        document.body.style.cursor = 'default';
                        text.text = "";
                    }

                    for (var i = 0; i < NUMBER; i++) {
                        let point = generateNode();
                        point.addEventListener("mouseover", point_hover);
                        point.addEventListener("mouseout", point_leave);
                        layer.add(point);
                    }
                </script>-->
            </div>

        </div>

        <footer id="pied_de_page">
            <?php include('footer.php'); ?>
        </footer>
    
    </body>
</html>