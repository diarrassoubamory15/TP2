<?php 
session_start();
require('formulaire.php');
include_once 'basededonnees.php';

$annee_travailError = $entrepriseError = $missionError = $annee_travail = $entreprise = $mission = "";

 
if(!empty($_POST)){

            $exp = $_SESSION['id_users'];
            $annee_travail = checkInput($_POST['annee_travail']);
            $entreprise = checkInput($_POST['entreprise']);
            $mission = checkInput($_POST['mission']);
           
            $isSuccess = true;
            

            if(empty($annee_travail)){
                $annee_travailError = 'Le champ Annee de travail ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($entreprise)){
                $entrepriseError = 'Le champ Entreprise ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($mission)){
                $missionError = 'Le champ Mission ne peut pas être vide !';
                $isSuccess = false;
            }

            

        if($isSuccess){
        $bd=Basededonnees::connecter();
        $statement = $bd->prepare('INSERT INTO experiences( annee_travail, entreprise, mission, users_id )
        VALUES (?,?,?,?)');
        $statement->execute([$annee_travail, $entreprise, $mission, $exp]);
        Basededonnees::deconnecter();
        header("Location: afficheexp.php");
        die();
        
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
    
    <title>cursus universitaire</title>

    
    
</head>
    <body>
        
            <h1 style="text-align:center;">Experiences</h1>
       
        <div class="container admin">
            <div class="row">
                    
                <table class="table table-success table-striped">
                    <tbody>
                        <tr>
                            <td>
                        
                        
                                <form class="form" role="form" action="experience.php" method="POST" class="row g-3" enctype="multipart/form-data">
 
                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","annee_travail", "Annee de travail", "Annee"));
                                    ?>
                                    <span style="color:red;"><?php echo $annee_travailError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","entreprise", "Entreprise", "Entreprise"));
                                    ?>
                                    <span style="color:red;"><?php echo $entrepriseError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","mission", "Mission", "Mission"));
                                    ?>
                                    <span style="color:red;"><?php echo $missionError; ?></span>
                                    </div>

                                    <br><br>
                                    <div class="col-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-success" >Valider</button>
                                            
                                    <a class="btn btn-secondary" href="afficheexp.php">Afficher Experience</a>
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
