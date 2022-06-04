<?php
require('formulaire.php');
require('fonction/connexion.class.php');

if(isset($_POST['user']) AND isset($_POST['mdp'])){
    $connexion = new connexion($_POST['user'], $_POST['mdp']);
    $verif = $connexion->verif($bd);
    if($verif === 'ok'){
        if($connexion->session($bd)){
            header('Location: index.php');
        }
    }else{
         $erreur = $verif;
    }
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
    <title>Connexion</title>
</head>
<body>

    <h1 style="text-align: center;">Connexion</h1>
    
<div class="container admin">
    <section>
        <div class="row">           
            <table class="table table-success table-striped">
             <tbody>
                 <tr>
                    <td>
                        <div class="main">
                            
                                <form action="" method="post" enctype="multipart/form-data">
                                <?php
                                echo(inputField("text","user", "Nom d'utilisateur", "Nom utilisateur"));
                                echo(inputField("password","mdp", "Mot de passe", "Mot de passe"));
                                echo '<br><br>';
                                echo'<button type="submit" class="btn btn-success" >Valider</button>';
                                if(isset($erreur)){
                                echo '<span style ="color:red;">'.$erreur.'</span>';
                            } 
                                ?>
                </form>
             </div>
         </td>
      </tr>
    </tbody>

  </table>

         
     </div>
  </div>
</section>


</body>
</html>