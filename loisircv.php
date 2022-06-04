<?php


$bd = Basededonnees::connecter();
$requete =$bd->prepare('SELECT id_loisirs, loisir, users_id
 FROM loisirs LEFT JOIN users ON id_loisirs = users_id WHERE users_id = ?');
$requete->execute(array($id));

Basededonnees::deconnecter();

?>
    <div class="row">
        <?php
            while($reponse = $requete->fetch()){
        
         ?>
         <div class="col-sm-3">
            <p><?php echo $reponse['loisir'];?></p>
           
            
         </div>

        <?php
        }
        ?>
    </div>