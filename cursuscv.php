<?php
include_once('basededonnees.php');
$bd = Basededonnees::connecter();
$requete =$bd->prepare('SELECT id_cursus,annee,ecole,diplome,detail,users_id
 FROM cursusuniversitaire LEFT JOIN users ON id_cursus = users_id WHERE users_id = ?');
$requete->execute(array($id));

Basededonnees::deconnecter();


?>
    <div class="row">
        <?php
            while($reponse = $requete->fetch()){
        
         ?>
         <div class="col-sm-3">
             <div class="card" style="margin-bottom:20px;">
                 <div class="card-body">
                        <p><strong>Annee : </strong><?php echo $reponse['annee'];?></p>
                        <p><strong>Ecole : </strong><?php echo $reponse['ecole'];?></p>
                        <p><strong>Diplome : </strong><?php echo $reponse['diplome'];?></p>
                        <p><strong>Detail : </strong><?php echo $reponse['detail'];?></p>
                 </div>
             </div>
         </div>

        <?php
        }
        ?>
    </div>