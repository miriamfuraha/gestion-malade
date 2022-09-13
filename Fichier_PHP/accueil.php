<?php
@$connexion=$_POST['connexion'];
if(isset($connexion)){
   $username=$_POST['username'];
   $password=$_POST['password'];
    require "pdo.php";
    $sql="SELECT idutilisateur FROM utilisateur where nomutilisateur=:nomutilisateur and motdepasse=:motdepasse limit 1";
    $requette=$pdo->prepare($sql);
    $requette->execute([
        ':nomutilisateur'=>$username,
        ':motdepasse'=>$password
    ]);
    $tab=$requette->FETCHALL(PDO::FETCH_ASSOC);
    if(count($tab)==1){
        session_start();
        
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        header("location:malade.php");
    }else{
        header("location:accueil.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fichier_CSS/accueil.css?t=<?php echo time()?>">
    <title>accueil</title>
</head>
<body>
    <div class="form">
        <form action="" method="post">
        <h1>LOGIN</h1>
            <div class="user">
            <label for="username">username</label>
            <input type="text" name="username" placeholder="entrez le nom utilisateur svp"></div>
            <div class="pass">
            <label for="password">password</label>
            <input type="password" name="password" placeholder="entrez le mot de passe svp"></div>
            <div class="btn">
            <button type="submit" name="connexion">se connecter</button>
            </div>
        </form>

    </div>
</body>
</html>
