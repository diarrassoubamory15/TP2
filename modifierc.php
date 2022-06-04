<?php 
include_once 'basededonnees.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$bd = Basededonnees::connecter();
$requete =$bd->query('SELECT id_cursus,annee,ecole,diplome,detail
 FROM cursusuniversitaire WHERE id_cursus ="'.$id.'"');
$requete->execute();
$reponse = $requete->fetch();
Basededonnees::deconnecter();

$anneeError = $ecoleError = $diplomeError = $detailError = $annee = $ecole = $diplome = $detail ="";

if(!empty($_POST)){
    
    $annee = checkInput($_POST['annee']);
    $ecole = checkInput($_POST['ecole']) ;
    $diplome = checkInput($_POST['diplome']); 
    $detail = checkInput($_POST['detail']);
    $isSuccess    = true;

    if(empty($annee)){
        $anneeError = 'Le champ annee ne peut pas être vide !';
        $isSuccess = false;
    }

    if(empty($ecole)){
        $ecoleError = 'Le champ ecole ne peut pas être vide !';
        $isSuccess = false;
    }

    if(empty($diplome)){
        $diplomeError = 'le champ diplome ne peut pas être vide !';
        $isSuccess = false;
    }

    if(empty($detail)){
        $detailError = 'Le champ detail ne peut pas être vide !';
        $isSuccess = false;
    }
    

            if($isSuccess){
            $bd=Basededonnees::connecter();
            $statement = $bd->prepare('UPDATE cursusuniversitaire SET annee = ?, ecole = ?, diplome = ?, detail = ? WHERE id_cursus = ?');

            $statement->execute(array($annee, $ecole, $diplome, $detail, $id));
            Basededonnees::deconnecter();
            header('Location: affichecursus.php');
        
           
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
    
    <title>Modifier cursus</title>

    
    
    </head>
        <body>
        
            <div class="container admin" >
                
            <h2 >Modifier Cursus</h2>
                <div class="row" >
                     <div class="col-sm-6">
                        <table class="table table-success table-striped">
                          <tbody>
                            <tr>
                              <td>
                                    
                                                    
                                <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
                            
                                    <div class="col-6">
                                    <label for="annee">Annee :</label>
                                    <input type="text" class="form-control" name="annee" id="annee" placeholder="Annee" value="<?php echo $reponse["annee"]; ?>">
                                    <div style="color:red;"><?php echo $anneeError; ?></div>
                                    </div>

                                    <div class="col-6">
                                    <label for="ecole">Ecole :</label>
                                    <input type="text" class="form-control" name="ecole" id="ecole" placeholder="Ecole" value="<?php echo $reponse["ecole"]; ?>">
                                    <div style="color:red;"><?php echo $ecoleError; ?></div>
                                    </div>

                                    <div class="col-6">
                                    <label for="diplome">Diplome :</label>
                                    <input type="text" class="form-control" name="diplome" id="diplome" placeholder="Diplome" value="<?php echo $reponse["diplome"]; ?>">
                                    <div style="color:red;"><?php echo $diplomeError; ?></div>
                                    </div>

                                    <div class="col-6">
                                    <label for="detail">detail :</label>
                                    <input type="text" class="form-control" name="detail" id="detail" placeholder="Detail" value="<?php echo $reponse["detail"]; ?>">
                                    <div style="color:red;"><?php echo $detailError; ?></div>
                                    </div>

                                    <br><br>  
                                    <div class="col-6" style="text-align: center;">
                                    <button type="submit" class="btn btn-success" >Modifier</button>
                                    <a class="btn btn-secondary" href="affichecursus.php">Retour</a>
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