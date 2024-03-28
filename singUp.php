<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a button {
            background-color: #008CBA;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        a button:hover {
            background-color: #005f6b;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    

<form action="#" method="post">

    <input type="hidden" name="id" value="0">
    Name: <input type="text" name="name"><br>
    Prénom: <input type="text" name="prenom"><br>
    Email: <input type="text" name="email"><br>
    Mot de passe: <input type="password" name="password"><br> <!-- Utilisation de type="password" pour masquer le mot de passe -->
    Confirmer le mot de passe: <input type="password" name="confirm_password"><br> <!-- Ajout d'un champ pour confirmer le mot de passe -->
    <input type="submit" name="submit">
    
</form>
<a href="Login.php"><button> Login</button></a>
<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$data = 'login';
$port ='3307';

$cont = new mysqli($server, $user, $pass, $data, $port);


if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($name != '' && $prenom != '' && $email != '' && $password != '' && $password === $confirm_password) {
        $sql = "INSERT INTO utilisateur1 (name, prenom, passwordU, email) VALUES (?, ?, ?, ?)";
        $prepa = $cont->prepare($sql);

        $prepa->bind_param("ssss", $name, $prenom, $password, $email);

        if($prepa->execute()) {
            $last_id = $cont->insert_id;
            echo 'bien' ;
        } else {
            echo '<p class="error">Erreur lors de l\'insertion de l\'utilisateur: </p>' . $prepa->error;
        }
        
        $prepa->close();
    } else {
        echo "<p class='error'>Veuillez remplir tous les champs et vérifier que les mots de passe correspondent.";
    }
}

$cont->close();
?>
</body>
</html>
