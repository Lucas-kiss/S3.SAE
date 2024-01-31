<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>1P'titJob</title>
    <link href="../Internaute/style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
  <nav>
    <div class=wrapper>
        <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60"/>
        <h1 class="titre">1P'titJob</h1>
        <a class="connexion">Mon compte</a>
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
      <label for="DateDeb">Date de début:<br></label>
      <input class="boiteTexte" type="date" id="dateDeb" name="dateDeb">
    </div>

    <div class="heureDeFin">
      <label for="dateFin">Date de fin:<br></label>
      <input class="boiteTexte" type="date" id="dateFin" name="dateFin">
    </div>

    <div class="villeOffre">
    <label for="ville">Ville:<br></label>
      <select class="boiteTexte" value="ville" id="ville">
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
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
  </div>

  </body>
</html>