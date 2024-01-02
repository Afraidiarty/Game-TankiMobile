<?
include_once '../system/core.php';
ProtectedAuth();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <br>
    <div class="trnt-block">
    <center>
    <div class="wrap1" >
    <div class="wrap2">
        <div class="wrap3">
            <div class="wrap4">
                <div class="wrap5">
                    <div class="wrap6">
                        <div class="wrap7">
                            <div class="wrap8">
                                <div class="wrap-content cntr white bold">
                                    <div class="medium green2 sh_b mb5">Выбери себе танк!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <div class="trnt-block">
    <div class="wrap1" >
    <div class="wrap2">
        <div class="wrap3">
            <div class="wrap4">
                <div class="wrap5">
                    <div class="wrap6">
                        <div class="wrap7">
                            <div class="wrap8">
                                <div class="wrap-content cntr white bold">
                                        <div class="countries">
        <div class="germany">
            <span>Германия</span>
            <a href="#" onclick="changeOpacity('germ')">
                 <img id="germ" style="width: 54%; opacity: 0.4" src="img/countr/germany.png" alt="">
            </a>
        </div>
        <div class="ssr">
            <span>СССР</span><br>
            <a href="#" onclick="ssr('ussr')">
                <img id="ussr" style="width: 113%;" src="img/countr/ussr.png" alt="">
            </a>
        </div>
        <div class="usa">
            <span>США</span><br>
            <a href="#" onclick = "ussa('usa')">
                <img  id="usa" style="width: 113%; opacity: 0.4;" src="img/countr/usa.png" alt="">
            </a>
        </div>
    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>        
        var randomNumber = Math.floor(Math.random() * 3) + 1;
        
        console.log(randomNumber)

        function changeOpacity(id) {
        var elements = document.getElementsByClassName("tank-image");
        var tankfl = document.getElementById("tank-id");
        
        ussr.style.opacity = "0.4";
        tankfl.classList.remove("tanks-ussr");
        tankfl.classList.remove("tanks-usa");
        tankfl.classList.add("tanks-germ");
        document.getElementById(id).style.opacity = "1";

        var img = document.getElementById("myImage");
        var TypeTank =document.getElementById("type-tanks");
        if(randomNumber == 1){
        img.src = "img/countr/tanks/ger-tt.png";
        TypeTank.textContent = "Тяжелый танк ";
        document.getElementById("tankImageField").value = "img/countr/tanks/ger-tt.png";
        }
        if(randomNumber == 2){
        img.src = "img/countr/tanks/ger-istr.png";
        TypeTank.textContent = "Истрибитель"; 
        document.getElementById("tankImageField").value = "img/countr/tanks/ger-istr.png";

        }
        if(randomNumber == 3){
        img.src = "img/countr/tanks/ger-sred.png";
        TypeTank.textContent = "Средний танк"; 
        document.getElementById("tankImageField").value = "img/countr/tanks/ger-sred.png";

        }
    }
        function ssr(id) {
            var tankfl = document.getElementById("tank-id");
            tankfl.classList.remove("tanks-germ");
            tankfl.classList.remove("tanks-usa");
            tankfl.classList.add("tanks-ussr");
            randomNumber = Math.floor(Math.random() * 3) + 1;
            germ.style.opacity = "0.4";
            ussr.style.opacity = "1";
            usa.style.opacity = "0.4";
            document.getElementById(id).style.opacity = "1";
            var img = document.getElementById("myImage");
            var TypeTank =document.getElementById("type-tanks");

             img.src = "img/countr/tanks/ssr-tt.png";
             if(randomNumber == 1){
            img.src = "img/countr/tanks/ssr-tt.png";
            TypeTank.textContent = "Тяжелый танк "; 
            document.getElementById("tankImageField").value = "img/countr/tanks/ssr-tt.png";
            }
            if(randomNumber == 2){
            img.src = "img/countr/tanks/ssr-ist.png";
            TypeTank.textContent = "Истрибитель";
            document.getElementById("tankImageField").value =  "img/countr/tanks/ssr-ist.png";

            }
            if(randomNumber == 3){
            img.src = "img/countr/tanks/ssr-sredniy.png";
            TypeTank.textContent = "Средний танк";
            document.getElementById("tankImageField").value =  "img/countr/tanks/ssr-sredniy.png";

            }
        }
        function ussa(id){
            var tankfl = document.getElementById("tank-id");
            tankfl.classList.remove("tanks-germ");
            tankfl.classList.add("tanks-usa");
            tankfl.classList.remove("tanks-ussr");
            randomNumber = Math.floor(Math.random() * 3) + 1;
            usa.style.opacity = "1";
            germ.style.opacity = "0.4";
            ussr.style.opacity = "0.4";
            document.getElementById(id).style.opacity = "1";
            var img = document.getElementById("myImage");
            var TypeTank =document.getElementById("type-tanks");
            if(randomNumber == 2){
            img.src = "img/countr/tanks/tankimg-usa-ist.png";
            TypeTank.textContent = "Истрибитель"; 
            document.getElementById("tankImageField").value =  "img/countr/tanks/tankimg-usa-ist.png";

            }
            if(randomNumber == 3 || randomNumber == 1){
            img.src = "img/countr/tanks/usa-sred.png";
            TypeTank.textContent = "Средний танк"; 
            document.getElementById("tankImageField").value =  "img/countr/tanks/usa-sred.png";
            }
        }
        
    </script>
    <br><br>
    <?php
        echo '
            <div id = "tank-id" class="tanks-ussr"><br>
            <b><span id ="type-tanks">Тяжелый танк</span></b><br>
                <img id="myImage" class="tank-image" style="margin-top: 4px;" src="img/countr/tanks/ssr-tt.png" alt="">
            </div>
        ';
    ?>
    <form action="2.php" method="post" >
        <input value="img/countr/tanks/ssr-tt.png" type="hidden" name="myImage" id="tankImageField">
        <button style ="white-space:nowrap;" class="simple-but border mb5 btn1 tut">Выбрать этот танк</button>

    </form>
    <script type="module" src="ajax/scripts.js"></script>
</body>
</html>
<?php
echo '<link rel="stylesheet" type="text/css" href="http://wartank.ru/images/style.css"/>';
include_once '../tanks/foots.php';
exit();
?>
