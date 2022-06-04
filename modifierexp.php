<?php 
include_once 'basededonnees.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$bd = Basededonnees::connecter();
$requete =$bd->query('SELECT id_experiences,annee_travail,entreprise,mission
 FROM experiences WHERE id_experiences ="'.$id.'"');
$requete->execute();
$reponse = $requete->fetch();
Basededonnees::deconnecter();

$annee_travailError = $entrepriseError = $missionError = $annee_travail = $entreprise = $mission = "";

if(!empty($_POST)){
    
    $annee_travail = checkInput($_POST['annee_travail']);
    $entreprise = checkInput($_POST['entreprise']) ;
    $mission = checkInput($_POST['mission']); 
    $isSuccess    = true;

    if(empty($annee_travail)){
        $annee_travailError = 'Le champ annee ne peut pas être vide !';
        $isSuccess = false;
    }

    if(empty($entreprise)){
        $entrepriseError = 'Le champ ecole ne peut pas être vide !';
        $isSuccess = false;
    }

    if(empty($mission)){
        $missionError = 'le champ diplome ne peut pas être vide !';
        $isSuccess = false;
    }

    
            if($isSuccess){
            $bd=Basededonnees::connecter();
            $statement = $bd->prepare('UPDATE experiences SET annee_travail = ?, entreprise = ?, mission = ?  WHERE id_experiences = ?');

            $statement->execute(array($annee_travail, $entreprise, $mission, $id));
            Basededonnees::deconnecter();
            header('Location: afficheexp.php');
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
    
    <title>Modifier Experiences</title>

    
    
    </head>
        <body>
        
            <div class="container admin" >
                
            <h2 >Modifier Experiences</h2>
                <div class="row" >
                     <div class="col-sm-6">
                        <table class="table table-success table-striped">
                          <tbody>
                            <tr>
                              <td>
                                    
                                                    
                                <form class="form" role="form" action="" method="POST" class="row g-3" enctype="multipart/form-data">
                            
                                    <div class="col-6">
                                    <label for="annee">Annee de travail :</label>
                                    <input type="text" class="form-control" name="annee_travail" id="annee" placeholder="Annee de travail" value="<?php echo $reponse["annee_travail"]; ?>">
                                    <div style="color:red;"><?php echo $annee_travail; ?></div>
                                    </div>

                                    <div class="col-6">
                                    <label for="entreprise">Entreprise :</label>
                                    <input type="text" class="form-control" name="entreprise" id="entreprise" placeholder="Entreprise" value="<?php echo $reponse["entreprise"]; ?>">
                                    <div style="color:red;"><?php echo $entrepriseError; ?></div>
                                    </div>

                                    <div class="col-6">
                                    <label for="mission">Mission :</label>
                                    <input type="text" class="form-control" name="mission" id="mission" placeholder="Mission" value="<?php echo $reponse["mission"]; ?>">
                                    <div style="color:red;"><?php echo $missionError; ?></div>
                                    </div>
                                          <br><br>  
                                          <div class="col-6" style="text-align: center;">
                                            <button type="submit" class="btn btn-success" >Modifier</button>
                                            <a class="btn btn-secondary" href="afficheexp.php">Retour</a>
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