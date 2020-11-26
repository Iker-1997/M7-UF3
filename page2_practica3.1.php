<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 3.1</title>
        <style>
        table,td {
            border: 1px solid black;
            border-spacing: 0px;
        }
        </style>
    </head>
    <body>

        <?php

            $country = $_POST['country'];

            $conn = mysqli_connect('localhost','iker','iker1234');

            mysqli_select_db($conn, 'world');

            if (isset($_POST['ciudad']) && isset($_POST['poblacion']) && isset($_POST['district'])) {

                $city_name = $_POST['ciudad'];
                $distrito = $_POST['district'];
                $poblacion = $_POST['poblacion'];

                $consulta_entrada = "INSERT INTO city (Name, CountryCode, District, Population) VALUES ('$city_name', '$country', '$distrito', '$poblacion');";

                $entrar_ciudad = mysqli_query($conn, $consulta_entrada);

            }

            $consulta_pagina2 = "SELECT country.Name AS pais, city.Name AS ciutat FROM city INNER JOIN country ON city.CountryCode = country.Code WHERE country.Code = '$country' order by city.Name;";
            

            $resultat = mysqli_query($conn, $consulta_pagina2);

            if (!$resultat) {
                $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
                $message .= 'Consulta realitzada: ' . $consulta_pagina2;
                die($message);
            }
        ?>
        <center>
            <table>
                <thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>
                <?php

                    while( $registre = mysqli_fetch_assoc($resultat) )
                    {

                        echo "\t<tr>\n";
                        echo "\t\t<td>".$registre['pais']."</td>\n";
                        echo "\t\t<td>".$registre['ciutat']."</td>\n";
                        echo "\t\t<td><img src='./assets/".$registre['pais'].".svg' width='25'></td>\n";
                        echo "\t</tr>\n";
                    }
                ?>
            </table>
        </center>
    </body>
</html>