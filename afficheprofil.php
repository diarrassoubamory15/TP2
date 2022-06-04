<?php
  session_start();
  if($_SESSION['id_users']){
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
    <title>Afficharge Profil</title>
</head>
<body>
    <div class="container" style ="text-align:center;">
    
        <h2 style="text-align:center;">Affichage Profil</h2>
   
    
      <?php
      require ('basededonnees.php');
  
$bd = Basededonnees::connecter();
$requete =$bd->query('SELECT id_profils, nom, prenoms, date2naissance, lieu2naissance, nationalite, situationMatrimoniale,
 nce, mobile, email, image, users_id FROM profils 
 LEFT JOIN users ON id_profils = users_id WHERE users_id ="'.$_SESSION['id_users'].'"');


        while($reponse = $requete->fetch())
        {
                
        
            echo  '<p><strong> Nom :</strong>'. $reponse['nom'].'</p>';
            echo  '<p><strong>Prenoms :</strong>'. $reponse['prenoms'].'</p>';
            echo  '<p><strong>Date de naissance :</strong>'. $reponse['date2naissance'].'</p>';
            echo  '<p><strong>Lieu de naissance :</strong>'. $reponse['lieu2naissance'].'</p>';
            echo  '<p><strong>Nationalité :</strong>'. $reponse['nationalite'].'</p>';
            echo  '<p><strong>Situation Matrimoniale :</strong>'. $reponse['situationMatrimoniale'].'</p>';
            echo  '<p><strong>NCE :</strong>'. $reponse['nce'].'</p>';
            echo  '<p><strong>Mobile :</strong>'. $reponse['mobile'].'</p>';
            echo  '<p><strong>Email :</strong>'. $reponse['email'].'</p>';
            echo  '<p><strong>Image :</strong>'. $reponse['image'].'</p>';
            echo'<p width="300">';
            echo'<a style ="margin:10px;" class="btn btn-success" href="modifierprofil.php?id='. $reponse['id_profils'].'">Modifier</a>';
            echo'<a class="btn btn-primary" href="cursus.php">Prochain</a>';
            echo'<a style="margin:10px;" class="btn btn-secondary" href="index.php">Annuaire</a>';
            echo'</p>';
            
        }
        Basededonnees::deconnecter();
?>

    
    
    
</div>   
</body>
</html>
<?php
}
?>