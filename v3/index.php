
<?php
session_start();

//CONNEXION A LA BASE
require('php/connexionBDD.php');

//actualités
$reqActu = "SELECT actu_titre, actu_texte, actu_date, com_pseudo
            FROM t_actualite_actu
            WHERE actu_etat='A';";
$resActu = $mysqli->query($reqActu);

if(!$resActu){
   echo "Error: La requête a echoué \n";
   echo "Errno: " . $mysqli->errno . "\n";
   echo "Error: " . $mysqli->error . "\n";
   exit();
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/home.css" />
   <link rel="stylesheet" href="css/navBar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <title>Focus</title>
</head>

<body>

   <aside>
      <ul class="navBar" >
         <li><a href="index.php" class="bouton">Home</a></li>
         <li><a href="php/selections/selection.php">Sélections</a></li>
         <?php
         if(isset($_SESSION['login'])){
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bc.png'></img></a>";
         }else{
            echo "<li class='menu compte'><a>Compte<img class='lock' src='assets/logos/padlock_bo.png'></img></a>";
         }
         ?>
            <ul class="sous">
               <?php
               if(isset($_SESSION['login'])){
                  echo "<li><a href='php/compte/admin_accueil.php?'>Profil</a></li>
                  <li><a href='php/compte/admin_actualite.php?#admin'>Actualités</a></li>
                  <li><a href='php/compte/admin_selection.php?#admin'>Sélections</a></li>
                  <li><a href='php/compte/admin_element.php?#admin'>Éléments</a></li>
                  <li><a href='php/compte/admin_lien.php?#admin'>Liens</a></li>
                  <li><a id='deconnexion' href='php/connexion/deconnexion.php?#admin'>Déconnexion</a></li>";
               }
               else{
                  echo "<li><a href='php/connexion/inscription.php'>Inscription</a></li>
                  <li><a href='php/connexion/session.php'>Connexion</a></li>";
               }
               ?>

            </ul>
         </li>
      </ul>
   </aside>


   <div class="utilisateur">
      <?php
      if(!isset($_SESSION['login'])){
         echo "<a href='php/connexion/session.php'><img src='assets/logos/padlock_wo.png'></img>Connexion</a>";
      }
      ?>
      <a href="#contact"><img src="assets/logos/information.png"></img>Contact</a>
   </div>

   <header>
      <h1>Focus</h1>
   </header>

   <h2>Dernières Actualité :</h2>

   <section>
      <?php
         while ($actu = $resActu->fetch_assoc()) {
            echo "<article class='actuUser'>
                     <div class='headerPublic'>
                        <a href='#''>".$actu['com_pseudo']."</a>
                        <h3>".$actu['actu_titre']."</h3>
                     </div>
                     <p>".$actu['actu_texte']."</p>
                     <p>".$actu['actu_date']."</p>
                  </article>";
         }
      ?>
   </section>

   <?php require('php/footer.php'); ?>

   <script type="text/javascript" src="js/navBar.js"></script>
</body>

</html>
