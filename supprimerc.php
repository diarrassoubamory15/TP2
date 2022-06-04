<?php 
session_start();
include_once 'basededonnees.php';

if(!empty($_GET['id'])){
    $id= checkInput($_GET['id']);
}

if(!empty($_POST)){
    $id = checkInput($_POST['id']);
    $bd = Basededonnees::connecter();
    $requete = $bd->prepare('DELETE  FROM cursusuniversitaire WHERE id_cursus = ?');
    $requete->execute(array($id));
    Basededonnees::deconnecter();
    header('Location: affichecursus.php');
    die();
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
    
    <title>Supprimer cursus </title>

    
    
</head>
    <body>
        
            <h1 style="text-align:center;">Supprimer Cursus Universitaire</h1>
       
        <div class="container admin">
            <div class="row">
                    
                <table class="table table-success table-striped">
                    <tbody>
                        <tr>
                            <td>
                        
                        
                                <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
 
                                    
                                    <input type="hidden" name="id" value ="<?php echo $id; ?>" >
                                    <p class="alert alert-warning">Etre vous sur de vouloir supprimer ? </p>
                                    <br><br>
                                    <div class="col-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-warning" >Oui</button>
                                            
                                    <a class="btn btn-default" href="affichecursus.php">Non</a>
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
