<?php
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM chambre where idchambre=:id";
$requete=$pdo->prepare($sql);
                    $requete->execute([':id'=>$id]);
                    $tab=$requete->FetchAll(PDO::FETCH_ASSOC);
                    foreach($tab as $data){
                        $idchambre=$data['idchambre'];
                        $designationchambre=$data['designationchambre'];
                        $prixchambre=$data['prixchambre'];
                        $categoriechambre=$data['categoriechambre'];
                    }
?>
<main>
    <div class="gauche">
            <form action="" method="post">
                <h3>CHAMBRE</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Désignation</label> <br>
                    <input type="text" name="designation" value="<?php echo $designationchambre?>">
                    </div>
                    <div class="item">
                    <label for="">Catégorie</label>
                    <input type="text" name="categorie" value="<?php echo $categoriechambre?>">
                    </div>
                </div>
                <div class="gp">
                    <div class="item">
                    <label for="">Prix</label> <br>
                    <input type="text" name="prix" value="<?php echo $prixchambre?>">
                    </div>
                </div>
                <div class="btn">
                <button type="submit" name="modifier">Modifier</button>
                <button type="submit" name="retour">Retour</button>
                </form>
            <?php
                $designation=$_POST['designation'];
                $categorie=$_POST['categorie'];
                $prix=$_POST['prix'];
                $modifier=$_POST['modifier'];
                $retour=$_POST['retour'];
                if(isset($modifier)){
                    if((!empty($designation)) &&
                       (!empty($categorie))&& 
                       (!empty($prix)) 
                      )
                    {
                        $sql="UPDATE chambre SET designationchambre=:designationchambre,prixchambre=:prixchambre,categoriechambre=:categoriechambre where idchambre=:id";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':designationchambre'=>$designation,
                                ':prixchambre'=>$prix,
                                ':categoriechambre'=>$categorie,
                                ':id'=>$id
                                ]
                            );
                            if($requete){?>
                            <script>
                                alert("modification reussi")
                            </script>
                                <?php
                            }

                        }else{?>
                            <script>
                                alert("champs laissé vide")
                            </script>
                            <?php
                        }
                    }elseif(isset($retour)){
                        header("location:chambre.php");
                    }
                
                ?>
<style>
    main{
        display:flex;
        align-items:center;
        justify-content:center;
    }
   .gauche{
       width:700px;
   }
   .gauche form{
    width: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    background:gray;
}
h3{
    color:white;
    text-decoration:underline white;
}
body main .gauche form .gp{
    width: 100%;
    display: flex;
    margin: 10px 0;
}
body main .gauche form .gp .item{
    width: 50%;
    
}
body main .gauche form .gp .item input,select{
    width: 96%;
    margin: 5px;
    padding: 5px 0;
}
body main .gauche form .gp .item label{
    margin: 5px;
    color:white;    
}
body main .gauche form .btn{
    margin-left: 5px;
    margin-bottom: 10px;
    width: 98%;

}
body main .gauche form .btn button{
    width: 100%;
    padding: 5px 0;
    font-size: 1em;
}
body main .gauche form .btn button:hover{
    background: green;
    transition: all 0.5s;
    color:white;
}
body main .droite{
    width: 57%;
    margin-left: 10px;
}
body main .droite form input{
    padding: 7px;
    width: 500px;
    border: 1px solid blue;
    border-radius: 6px 4px;
}
body main .droite form button{
    padding: 5px 15px;
    margin: 5px;
    display: inline-block;
    background:green;
    color: white;
    border: none;
}
</style>