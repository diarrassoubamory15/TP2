<?php 
include_once 'basededonnees.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$bd = Basededonnees::connecter();
$requete =$bd->query('SELECT id_linguistiques, langues
 FROM linguistiques WHERE id_linguistiques ="'.$id.'"');
$requete->execute();
$reponse = $requete->fetch();
Basededonnees::deconnecter();

$languesError = $langues ="";

if(!empty($_POST)){
    
            $langues = checkInput($_POST['langues']);
            $isSuccess = true;

            if(empty($langues)){
                $languesError = 'Le champ langue ne peut pas être vide !';
                $isSuccess = false;
            }

    
            if($isSuccess){
            $bd=Basededonnees::connecter();
            $statement = $bd->prepare('UPDATE linguistiques SET langues = ? WHERE id_linguistiques = ?');

            $statement->execute(array($langues, $id));
            Basededonnees::deconnecter();
            header('Location: affichelangue.php');
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
    
    <title>Modifier Langue</title>

    </head>
        <body>
        
            <div class="container admin" >
                
            <h2 >Modifier Langue</h2>
                <div class="row" >
                     <div class="col-sm-6">
                        <table class="table table-success table-striped">
                          <tbody>
                            <tr>
                              <td>
                                    
                                                    
                                           <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
                                    
                                            <div class="col-6">
                                            <label for="langue">Langue :</label>
                                            <input type="text" class="form-control" name="langues" id="langue" placeholder="Langue" value="<?php echo $reponse['langues']; ?>">
                                            <span style="color:red;"><?php echo $languesError; ?></span>
                                            </div>

                                          <br><br>  
                                          <div class="col-6" style="text-align: center;">
                                            <button type="submit" class="btn btn-success" >Modifier</button>
                                            <a class="btn btn-secondary" href="affichelangue.php">Retour</a>
                                            </div>
                                         
                                </form>
                                    
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                
                </div>
            </div>

    
    
    </body>
</html>