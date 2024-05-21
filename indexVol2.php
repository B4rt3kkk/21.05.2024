<?php $polaczenie=new mysqli("localhost","root","", "praca", 3306); ?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ćwiczenia</title>
</head>

    <body style="font-family:sans-serif;">

        <fieldset style="border-radius: 20px;width: 600px;padding: 20px;margin: auto; text-align: center; color: olive; margin-top: 10%;">

            <legend><b>JavaScript to super język</b></legend>

            <div style="width: 600px; padding: 20px; border-radius: 20px; background-color: olive; color: white;box-shadow: 0px 3px 3px gray;">

                <form name="dane" id="dane">

                    <select name="dane" id="dane" style="width: 30%; height: 50px; text-align: center;background-color:goldenrod; color: white; border-radius: 20px;">

                    <option value="Wybierz">Wybierz</option>

                        <?php $zapytanie = $polaczenie->query("SELECT `id`, `m`, `g`, `h`, `v` FROM `energia`;") ?>

                        <?php 
                            while($wiersz = $zapytanie->fetch_assoc()){
                                $energia = json_encode($wiersz);
                                echo("
                                    <option value='$energia'>{$wiersz['id']}</option>
                                ");
                            }
                        ?>

                    </select>

                </form>

            </div>

        </fieldset>

        <div id="wynik" style="box-shadow: 0px 3px 3px gray; border-radius: 20px; width: 644px; padding: 20px; margin: auto; text-align: center; background-color:goldenrod; color: white; margin-top: 5%;">
        
        </div>

        <script>
                let mySelect = document.getElementById("dane");
                mySelect.addEventListener("change",(event)=>{
                let energia = JSON.parse(event.target.value);
                let masa = parseFloat(energia.m);
                let grawitacja = parseFloat(energia.g);
                let wysokosc = parseFloat(energia.h);
                let predkosc = parseFloat(energia.v);

                let Ek = (masa * Math.pow(predkosc,2)) / 2;
                let Ep = masa * grawitacja * wysokosc;
                let Em = Ek + Ep;
                let wynik = document.getElementById("wynik");
                wynik.innerHTML = `
                    Energia kinetyczna = ${Ek} <br>
                    Energia kinetyczna = ${Ep} <br>
                    Energia kinetyczna = ${Em} <br>
                `;
            })

        </script>

    </body>

</html>

<?php $polaczenie->close(); ?>