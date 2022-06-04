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
    <title>Affichage Langue</title>
</head>
<body>
    <div class="container">
    
        <h2 style="text-align:center;">Affichage Langues</h2>
   

        <table class="table table-bordered">
        <thead>
    <tr>
    <th>Langue</th>
    <th>Actions</th>
            </tr>
                </thead>
                    <tbody>
                     <?php
                        require ('basededonnees.php');
  
                        $bd = Basededonnees::connecter();
                        $requete =$bd->query('SELECT id_linguistiques, langues, users_id
                        FROM linguistiques LEFT JOIN users ON id_linguistiques = users_id WHERE users_id ="'.$_SESSION['id_users'].'"');


                        while($reponse = $requete->fetch())
                        {

                        echo' <tr>';
                            echo  '<td scope="row">'. $reponse['langues'].'</td>';
                            echo'<td width="300">';
                                echo'<a class="btn btn-success" href="modifierlangue.php?id='. $reponse['id_linguistiques'].'">Modifier</a>';
                                echo' ';
                                echo'<a class="btn btn-danger" href="supprimerlangue.php?id='. $reponse['id_linguistiques'].'">Supprimer</a>';
                            echo'</td>';
                            echo'</tr>';
                            
                        }
                        Basededonnees::deconnecter();
                        ?>

                        </tbody>

                                </table>

                            <a class="btn btn-info" href="linguistique.php">+Ajouter</a>
                            <a class="btn btn-primary" href="loisir.php">Prochain</a> 
                            <a style= "margin-left:10px;" class="btn btn-primary float-right" href="experience.php">Retour</a> 
                            <a style="margin-right:10px;" class="btn btn-secondary float-right" href="index.php">Annuaire</a>   
                            
                        </div>   
    </body>
</html>
<?php
}
?>