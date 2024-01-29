<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Connexion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav>
            <div class=wrapper>
                <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" alt="Logo 1P'titJob"/>
                <h1 class="titre">1P'titJob</h1>
                <a href="Connexion.php" class="connexion">Connexion</a>
            </div>
        </nav>
        
        <H1>Connexion</H1>
        <form action="idk.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <th><label for="mail">Adresse e-mail :</label></th>
                        <td><input type="email" id="mail" name="mail" placeholder="exemple@domaine" required/></td>
                    </tr>
                    <tr>
                        <th><label for="MdP">Mot de passe :</label></th>
                        <td><input type="password" id="MdP" name="MdP" required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a>Mot de passe oublié ?</a></br>
                            Pas de compte ? <a href="Inscription.php">S'inscrire</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="notrobot" required/>
                            <label for="notrobot">Je ne suis pas un robot</label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Se connecter">
        </form>
    </body>
</html>
=======
<?

require ("../../ressources/donnees/BDD/bdd.php");
session_start();

if (isset($_POST['connexion'])) {

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $mail = $_POST['mail'];
    $mdp = hash('sha1', $_POST['MdP']);

    $queryEntr = 'SELECT * FROM Entreprise WHERE mailResponsable = "'.$mail.'" AND mdpResponsable = "'.$mdp.'";';
    $resultEntr = mysqli_query($link, $queryEntr);    

    if ($link) {    // si la requête a fonctionné
        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement
            while ($donnees=mysqli_fetch_assoc($resultEntr)) {
                $_SESSION['siren'] = $donnees["siren"];
                header ('location: ../Entreprise/FormDepotOffre.php');
            }
        }
        $queryEtud = 'SELECT * FROM Etudiant WHERE mailEtud = "'.$mail.'" AND mdpEtud = "'.$mdp.'";';
        $resultEtud = mysqli_query($link, $queryEtud);  

        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement
            while ($donnees=mysqli_fetch_assoc($resultEtud)) {
                $_SESSION['ine'] = $donnees["ine"];
                header ('location: ../Etudiant/FormulaireEtudiant.php');
            }
        } 
    }
    else {
        echo "<p>Aucun compte lié au mail et mdp saisis</p>";
    }
}
    

?>
>>>>>>> depotOffreBDD
