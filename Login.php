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
            width: 100%;
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

<h1>Login</h1>
<hr>
Email : <input type="text" name="email"><br>
Mot de passe : <input type="password" name="password"><br>
<input type="submit" name='submit'>
    
</form>
<a href="singUp.php"><button> Créer un compte</button></a><br><br>
<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$data = 'login';
$port ='3307';

$email = isset( $_POST['email']) ? $_POST['email'] : '' ;
$password =isset( $_POST['password']) ? $_POST['password'] : '';

$cont = new mysqli($server, $user, $pass, $data, $port);

if(isset($_POST['submit']) and $email !='' and $password != ''){

    $sql = "SELECT email, passwordU FROM utilisateur1 WHERE email = ? AND passwordU = ?";
    
    $prepa = $cont->prepare($sql);

    $prepa->bind_param("ss", $email, $password);

    $prepa->execute();

    $result = $prepa->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            header("location: singUp.php");
        }
    } else {
        echo "<p class='error'>Aucun utilisateur trouvé avec cet email et ce mot de passe.";
    }

    $prepa->close();
}

$cont->close();
?>

</body>
</html>


