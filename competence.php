<?php 
session_start();
require('formulaire.php');
include_once 'basededonnees.php';

$domaineError = $specialiteError = $domaine = $specialite ="";

 
if(!empty($_POST)){

            $comp = $_SESSION['id_users'];
            $domaine = checkInput($_POST['domaine']);
            $specialite = checkInput($_POST['specialite']);
            $isSuccess = true;
            

            if(empty($domaine)){
                $domaineError = 'Le champ domaine ne peut pas être vide !';
                $isSuccess = false;
            }

            if(empty($specialite)){
                $specialiteError = 'Le champ specialite ne peut pas être vide !';
                $isSuccess = false;
            }


            

        if($isSuccess){
        $bd=Basededonnees::connecter();
        $statement = $bd->prepare('INSERT INTO competences( domaine, specialite, users_id )
        VALUES (?,?,?)');
        $statement->execute([$domaine, $specialite, $comp]);
        Basededonnees::deconnecter();
        header("Location: affichecomp.php");
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
    
    <title>competences</title>

    
    
</head>
    <body>
        
            <h1 style="text-align:center;">Competences</h1>
       
        <div class="container admin">
            <div class="row">
                    
                <table class="table table-success table-striped">
                    <tbody>
                        <tr>
                            <td>
                        
                        
                                <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
 
                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","domaine", "Domaine", "Domaine"));
                                    ?>
                                    <span style="color:red;"><?php echo $domaineError; ?></span>
                                    </div>

                                    <div class="col-6">
                                    <?php
                                    echo(inputField("text","specialite", "Specialite", "Specialite"));
                                    ?>
                                    <span style="color:red;"><?php echo $specialiteError; ?></span>
                                    </div>

                                    <br><br>
                                    <div class="col-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-success" >Valider</button>
                                    <a class="btn btn-secondary" href="affichecomp.php">Afficher Competence</a>
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
