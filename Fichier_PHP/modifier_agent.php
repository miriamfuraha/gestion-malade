<?php
error_reporting(1);  
require "pdo.php";
$id=$_GET['id'];
$sql="SELECT * FROM agent where idag=:id";
$requete=$pdo->prepare($sql);
$requete->execute([':id'=>$id]);
$tab=$requete->FetchAll(PDO::FETCH_ASSOC);
foreach($tab as $data){
    $idag=$data['idag'];
    $nomsagent=$data['nomsagent'];
    $sexeag=$data['sexeag'];
    $phoneag=$data['phoneag'];
    $serviceag=$data['serviceag'];
}
$modifier=$_POST['modifier'];
$retour=$_POST['retour'];

?>
<main>
    <div class="gauche">
            <form action="" method="post">
                <h3>AGENT</h3><hr></br>
                <div class="gp">
                    <div class="item">
                    <label for="">Noms agent</label> <br>
                    <input type="text" name="noms" value="<?php echo $nomsagent?>">
                    </div>
                    <div class="item">
                    <label for="">Sexe </label>
                    <select name="sexe" id="">
                    <option value="<?php echo $sexeag ?>"><?php echo $sexeag ?></option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                    <option value="Autre">Autres</option>
                    </select>
                    </div>
                </div>
                <div class="gp">
                <div class="item">
                    <label for="">Numéro téléphone</label> <br>
                    <input type="number" name="numerotelephone" value="<?php echo $phoneag ?>">
                    </div>
                    <div class="item">
                    <label for="">Service</label> <br>
                    <input type="text" name="service" placeholder="service" value="<?php echo $serviceag?>">
                    </div>
                </div>                      
                <div class="btn">
                <button type="submit" name="modifier">Modifier</button>
                <button type="submit" name="retour">retour</button>
            </form>
            <?php
                $noms=$_POST['noms'];
                $sexe=$_POST['sexe'];
                $numerotelephone=$_POST['numerotelephone'];
                $service=$_POST['service'];
                if(isset($modifier)){
                    if((!empty($noms)) &&
                    (!empty($sexe))&& 
                    (!empty($numerotelephone))&&
                    (!empty($service)) 
                    )
                    {
                        $sql="UPDATE agent SET nomsagent=:nomsagent,sexeag=:sexeag,phoneag=:phoneag,serviceag= :serviceag where idag=:id";
                        $requete=$pdo->prepare($sql);
                        $requete->execute(
                            [
                                ':nomsagent'=>$noms,
                                ':sexeag'=>$sexe,
                                ':phoneag'=>$numerotelephone,
                                ':serviceag'=>$service,
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
                        header("location:agent.php");
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
    background: gray;
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