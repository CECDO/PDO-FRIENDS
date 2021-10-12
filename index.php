<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

if (isset($_POST["firstname"]) && isset($_POST["lastname"]))
    {
        if (empty($_POST["firstname"]) || ($_POST["lastname"]))
        {
            echo "<p>Ce champ doit être complété</p>";
        }
        else {
            $firstname = ($_POST["firstname"]);
            $lastname = ($_POST["lastname"]);
            $query = "INSERT INTO friend ( firstname, lastname)
            VALUES (:firstname, :lastname)";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $statement->execute();
            header('Location: index.php');
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>
    
    <form>
        <div>
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname"></input>
        </div>
        <div>
            <label for="firstname">firstname</label>
            <input type="text" name="firstname" id="firstname"></input>
        </div>
        <div>
            <button type="submit">Valider</button>
        </div>
    </form>  
    <?php

    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friends = $statement->fetchall();
    echo "<ul>";
    foreach($friends as $friend) {
        echo "<li>firstname: " . $friend['firstname'] . " lastname: " . $friend['lastname'] . "</li><br>";
    }
        echo "</ul>";

    ?>
</body>
</html>
