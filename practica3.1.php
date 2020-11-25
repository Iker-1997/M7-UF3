<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 3.1</title>
    </head>
    <body>

        <?php

            $conn = mysqli_connect('localhost','iker','iker1234');

            mysqli_select_db($conn, 'world');

            $consulta = "SELECT Name, Code FROM country ORDER BY Name;";

            $resultat = mysqli_query($conn, $consulta);

            if (!$resultat) {
                $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
                $message .= 'Consulta realitzada: ' . $consulta;
                die($message);
            }
        ?>

        <form action="page2_practica3.1.php" method="POST">
            <label for="country">Choose country:</label>
            <select name="country" id="country">
                <?php

                    while( $registre = mysqli_fetch_assoc($resultat) ){
                        
                        echo "<option value=".$registre["Code"].">".$registre["Name"]."</option>";

                    }
                ?>
                <input type="submit" value="Select Country">
            </select>
        </form>	
    </body>
</html>