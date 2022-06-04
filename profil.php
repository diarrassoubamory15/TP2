<?php 
session_start();
require('formulaire.php');
include 'basededonnees.php';

 $nomError = $prenomsError = $date2naissanceError = $lieu2naissanceError = $nationaliteError = $situationMatrimonialeError = $nceError = $mobileError = $emailError = $imageError= "";
 $nom = $prenoms = $date2naissance = $lieu2naissance = $nationalite = $situationMatrimoniale = $nce = $mobile = $email = $image ="";

if(!empty($_POST)){

                $profil = checkInput($_SESSION['id_users']);
                $nom = checkInput($_POST['nom']);
                $prenoms = checkInput($_POST['prenoms']);
                $date2naissance = checkInput($_POST['date2naissance']);
                $lieu2naissance = checkInput($_POST['lieu2naissance']);
                $nationalite = checkInput($_POST['nationalite']);
                $situationMatrimoniale = checkInput($_POST['situationMatrimoniale']);
                $nce = checkInput($_POST['nce']);
                $mobile = checkInput($_POST['mobile']);
                $email = checkInput($_POST['email']);

                $image =checkInput($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'],'photo/'.basename($_FILES['image']['name']));
                $isSuccess = true;           

                if(empty($nom)){
                    $nomError = 'Le champ nom ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($prenoms)){
                    $prenomsError = 'Le champ prenoms ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($date2naissance)){
                    $date2naissanceError = 'Le champ date de naissance ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($lieu2naissance)){
                    $lieu2naissanceError = 'Le champ lieu de naissance ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($nationalite)){
                    $nationaliteError = 'Le champ nationalité ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($situationMatrimoniale)){
                    $situationMatrimonialeError = 'Le champ situation matrimoniale ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($nce)){
                    $nceError = 'Le champ nce ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($mobile)){
                    $mobileError = 'Le champ mobile ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($email)){
                    $emailError = 'Le champ email ne peut pas être vide !';
                    $isSuccess = false;
                }

                if(empty($image)){
                    $imageError = 'Le champ image ne peut pas être vide !';
                    $isSuccess = false;
                }

                if($isSuccess){
                $bd=Basededonnees::connecter();
                $statement = $bd->prepare('INSERT INTO profils( nom, prenoms, date2naissance, lieu2naissance, nationalite, situationMatrimoniale, nce, mobile, email, image, users_id ) VALUES ( ?,?,?,?,?,?,?,?, ?,?,?)');
                $statement->execute([$nom, $prenoms, $date2naissance, $lieu2naissance, $nationalite, $situationMatrimoniale, $nce, $mobile, $email, $image, $profil]);  
                $bd = Basededonnees::deconnecter();
                header("Location: afficheprofil.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous">

    <!----------script------------>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
       crossorigin="anonymous"></script>

    <!--------police------>
    <link href='http://fonts.googleapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>  

    <!---------style-------->
    <link rel="stylesheet" href="style.css">
    
    <title>Profil</title>
</head>
<body>
        <div class="jumbotron">
            <h1 style="text-align:center;">Profil</h1>
        </div>
    <div class="container admin">
        <div class="row">
                    
        <table class="table table-success table-striped">
            <tbody>
              <tr>
                <td>
                 <div class="main">
                            
                    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

                    <div class="col-md-6">
                    <?php
                    echo(inputField("text","nom", "Nom", "Nom"));
                    ?>
                    <span style="color:red;"><?php echo $nomError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","prenoms", "Prenoms", "Prenoms"));
                    ?>
                    <span style="color:red;"><?php echo $prenomsError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("date","date2naissance", "Date de naissance", ""));
                    ?>
                    <span style="color:red;"><?php echo $date2naissanceError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","lieu2naissance", "Lieu de naissance", "Lieu de naissance"));
                    ?>
                    <span style="color:red;"><?php echo $lieu2naissanceError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","nationalite", "Nationalite", "Nationalite"));
                    ?>
                    <span style="color:red;"><?php echo $nationaliteError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","situationMatrimoniale", "Situation Matrimoniale", "Situation Matrimoniale"));
                    ?>
                    <span style="color:red;"><?php echo $situationMatrimonialeError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","nce", "NCE", "Numéro de carte étudiant"));
                    ?>
                    <span style="color:red;"><?php echo $nceError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("text","mobile", "Téléphone", "Téléphone"));
                    ?>
                    <span style="color:red;"><?php echo $mobileError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("email","email", "Email", "Email"));
                    ?>
                    <span style="color:red;"><?php echo $emailError; ?></span>
                    </div>

                    <div class="col-6">
                    <?php
                    echo(inputField("file","image", "image", ""));
                    ?>
                    <span style="color:red;"><?php echo $imageError; ?></span>
                    </div>
                                        
                    <div class="col-6">
                    <button type="submit" class="btn btn-success" >Valider</button>
                    <a class="btn btn-secondary float-right" href="index.php">Annuaire</a>
                    </div> 
                </div>
                        
                </form>
                </div>
                </td>
                </tr>
                </tbody>

                </table>
                
               
        </div>
    </div>

    
    
</body>
</html>