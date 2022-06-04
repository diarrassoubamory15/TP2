<?php 
session_start();
require('formulaire.php');
include_once 'basededonnees.php';

$anneeError = $ecoleError = $diplomeError = $detailError = $annee = $ecole = $diplome = $detail = "";

 
if(!empty($_POST)){

    $user = $_SESSION['id_users'];
    
            $annee = checkInput($_POST['annee']);
            $ecole = checkInput($_POST['ecole']);
            $diplome = checkInput($_POST['diplome']);
            $detail = checkInput($_POST['detail']);
            $isSuccess = true;
            

            if(empty($annee)){
                $anneeError = 'Le champ annee ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($ecole)){
                $ecoleError = 'Le champ ecole ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($diplome)){
                $diplomeError = 'Le champ diplome ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($detail)){
                $detailError = 'Le champ detail ne peut pas être vide !';
                $isSuccess = false;
            }

        if($isSuccess){
        $bd=Basededonnees::connecter();
        $statement = $bd->prepare('INSERT INTO cursusuniversitaire( annee, ecole, diplome, detail,users_id )
        VALUES (?,?,?,?,?)');
        $statement->execute([$annee, $ecole, $diplome, $detail, $user]);
        Basededonnees::deconnecter();
        header("Location: affichecursus.php");
        
        }

}
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-----------bootstrap-------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <!----------script------------>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
       crossorigin="anonymous"></script>

    <!--------police------>
    <link href='http://fonts.googleapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>  

    <!---------style-------->
    <link rel="stylesheet" href="style.css">
    <script arc="ajax.js"></script>
    
    <title>cursus universitaire</title>

    
    
</head>
    <body>
        
            <h1 style="text-align:center;">Cursus Universitaire</h1>
       
        <div class="container admin">
            <div class="row">
                    
                <table class="table table-success table-striped">
                    <tbody>
                        <tr>
                            <td>
                        
                        
                                <form class="form" role="form" action="cursus.php" method="POST" class="row g-3" enctype="multipart/form-data">
 
                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","annee", "Annee", "Annee"));
                                    ?>
                                    <span style="color:red;"><?php echo $anneeError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","ecole", "Ecole", "Ecole"));
                                    ?>
                                    <span style="color:red;"><?php echo $ecoleError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","diplome", "Diplome", "Diplome"));
                                    ?>
                                    <span style="color:red;"><?php echo $diplomeError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","detail", "Detail", "Detail"));
                                    ?>
                                    <span style="color:red;"><?php echo $detailError; ?></span>
                                    </div>
                                    <br><br>
                                    <div class="col-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-success" >Valider</button>
                                            
                                    <a class="btn btn-secondary" href="affichecursus.php">Afficher Cursus</a>
                                    </div>
                                            
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

                
            </div>
        </div>

    
    
    </body>
</html>
