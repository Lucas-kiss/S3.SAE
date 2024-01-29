<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>1P'titJob</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
  <nav>
    <div class=wrapper>
        <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60"/>
        <h1 class="titre">1P'titJob</h1>
        <a href="Connexion.php" class="connexion">Connexion</a>
      </div>
  </nav>
  
  <div class="grilleBoutons">

    <div class="boutonDeposerOffre">
      <button style="width:100%">Déposer une offre d'emploi</button>
    </div>

    <div class="boutonMesMessages">
      <button style="width:100%">Mes messages</button>
    </div>

    <div class="heureDeDebut">
      <label for="DateDeb">Heure de début:<br></label>
      <input type="date" id="dateDeb" name="dateDeb">
      <p>
        à <input style="width:34px" type="number" id="heureDeb" value="12" name="heureDeb" min="0", max="23"> h
      </p>
    </div>

    <div class="heureDeFin">
      <label for="dateFin">Heure de fin:<br></label>
      <input type="date" id="dateFin" name="dateFin">
      <p>
        à <input style="width:34px" type="number" id="heureFin" value="12" name="heureFin" min="0", max="23"> h
      </p>
    </div>

    <div class="villeOffre">
    <label for="ville">Ville:<br></label>
      <select value="ville", id="ville">
        <option value="Bayonne">Bayonne</option>
        <option value="Anglet">Anglet</option>
        <option value="Biarritz">Biarritz</option>
      </select>
    </div>

  </div>

  <div class="annonces">
    <h4>Annonces :</h4>
    <div class="uneannonce">
      <h3>Annonce</h3>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
    </div>
  </div>

  </body>
</html>