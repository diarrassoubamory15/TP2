<?php 
include_once 'basededonnees.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$bd = Basededonnees::connecter();
$requete =$bd->query('SELECT id_profils,nom, prenoms, date2naissance, lieu2naissance,
 nationalite, situationMatrimoniale, nce, mobile, email, image
 FROM profils WHERE id_profils ="'.$id.'"');
$requete->execute();
$reponse = $requete->fetch();
Basededonnees::deconnecter();

$nomError = $prenomsError = $date2naissanceError = $lieu2naissanceError
 = $nationaliteError = $situationMatrimonialeError = $nceError = $mobileError 
 = $emailError = $imageError= "";
 $nom = $prenoms = $date2naissance = $lieu2naissance = $nationalite = $situationMatrimoniale
  = $nce = $mobile = $email = $image ="";

if(!empty($_POST)){
    
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
            $statement = $bd->prepare('UPDATE profils SET nom = ?, prenoms = ?, date2naissance = ?
            , lieu2naissance = ? , nationalite = ? , situationMatrimoniale = ? , nce = ? ,
             mobile = ? , email = ? , image = ? WHERE id_profils = ?');

            $statement->execute(array($nom, $prenoms, $date2naissance, $lieu2naissance, 
            $nationalite, $situationMatrimoniale, $nce, $mobile, $email, $image, $id));
            Basededonnees::deconnecter();
            header('Location: afficheprofil.php');
        
           
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
                     
                        <table class="table table-success table-striped">
                          <tbody>
                            <tr>
                              <td>
                                    
                                                    
                                <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
                            
                                <div class="col-md-6">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" placeholder="nom" value="<?php echo $reponse['nom']; ?>">
                    <span style="color:red;"><?php echo $nomError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="prenoms">Prenoms :</label>
                    <input type="text" name="prenoms" id="prenoms" value="<?php echo $reponse['prenoms']; ?>">
                    <span style="color:red;"><?php echo $prenomsError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="date2naissance">Date de naissance :</label>
                    <input type="date" name="date2naissance" id="date2naissance" value="<?php echo $reponse['date2naissance']; ?>">
                    <span style="color:red;"><?php echo $date2naissanceError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="lieu2naissance">Lieu de naissance :</label>
                    <input type="text" name="lieu2naissance" id="lieu2naissance" value="<?php echo $reponse['lieu2naissance']; ?>">
                    <span style="color:red;"><?php echo $lieu2naissanceError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="nationalite">Nationalite :</label>
                    <input type="text" name="nationalite" id="nationalite" value="<?php echo $reponse['nationalite']; ?>">
                    <span style="color:red;"><?php echo $nationaliteError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="situationMatrimoniale">Situation Matrimoniale :</label>
                    <input type="text" name="situationMatrimoniale" id="situationMatrimoniale" value="<?php echo $reponse['situationMatrimoniale']; ?>">
                    <span style="color:red;"><?php echo $situationMatrimonialeError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="nce">NCE :</label>
                    <input type="text" name="nce" id="nce" value="<?php echo $reponse['nce']; ?>">
                    <span style="color:red;"><?php echo $nceError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="mobile">Telephone :</label>
                    <input type="text" name="mobile" id="mobile" value="<?php echo $reponse['mobile']; ?>">
                    <span style="color:red;"><?php echo $mobileError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="<?php echo $reponse['email']; ?>">
                    <span style="color:red;"><?php echo $emailError; ?></span>
                    </div>

                    <div class="col-6">
                    <label for="image">Photo :</label>
                    <input type="file" name="image" id="image" accept="image/png,image/jpeg" class="form-control-file" value="<?php echo $reponse['image'] ; ?>">
                    <span style="color:red;"><?php echo $imageError; ?></span>
                    </div>
                                        
                    <div class="col-6">
                    <button type="submit" class="btn btn-success" >Modifier</button>
                    <a class="btn btn-secondary float-right" href="afficheprofil.php">Retour</a>
                    </div> 
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