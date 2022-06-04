<?php
session_start();
require('formulaire.php'); 
include 'basededonnees.php';

$languesError = $langues ="";

if(!empty($_POST)){

    $lin = $_SESSION['id_users'];
    $langues = checkInput($_POST['langues']);
    $isSuccess = true;
            
    if(empty($langues)){
        $languesError = 'Le champ langue ne peut pas être vide !';
    $isSuccess = false;
    }

    if($isSuccess){
        $bd=Basededonnees::connecter();
        $statement = $bd->prepare('INSERT INTO linguistiques( langues, users_id )
        VALUES (?,?)');
        $statement->execute([$langues, $lin]);
        Basededonnees::deconnecter();
        header("Location: affichelangue.php");
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
    
    <title>langue</title>
</head>
<body>
        <div class="jumbotron">
        
        </div>
    <div class="container admin">
        <h1>Langue</h1>
        <div class="row">
        
                    
                    <table class="table table-success table-striped">
                        <tbody>
                            <tr>
                                <td>
                                <div class="main">
            
                                        <form action="" method="post" class="row g-3" enctype="multipart/form-data">
                                
                                        <div class="col-6">
                                        <?php
                                            echo(inputField("text","langues", "Langue", "Langue"));
                                        ?>
                                        <span style="color:red;"><?php echo $languesError; ?></span>
                                        </div>

                                        <br><br>
                                        <div>
                                        <button type="submit" class="btn btn-success" >Valider</button>                                  
                                        <a class="btn btn-secondary" href="affichelangue.php">Afficher linguistique</a>
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