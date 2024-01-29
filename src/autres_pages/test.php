<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>1P'titJob</title>
    <link href="Internaute/style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
  <nav>
    <div class=wrapper>
        <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60"/>
        <h1 class="titre">1P'titJob</h1>
      </div>
  </nav>
  
  <div class="grilleBoutons">

    <div class="boutonDeposerOffre">
      <button style="width:100%">Déposer une offre d'emploi</button>
    </div>

    <div class="boutonMesMessages">
    </div>

    <div class="nbMinEtudJour">
      <p>Nombre min. d'étudiants par jour:</p>
      <input type="number" id="minEtudJour" name="minEtudJour" value="1" min="1" max="24" />
    </div>

    <div class="nbMinHeuresEtud">
      <p>Nombre min. d'heures par étudiant:</p>
      <input type="number" id="minHeuresEtud" name="minHeuresEtud" value="1" min="1" max="24" />
    </div>

    <div class="nbMinEtudOffre">
      <p>Nombre min. d'étudiants sur l'offre:</p>
      <input type="number" id="minEtudOffre" name="minEtudOffre" value="1" min="1" max="24" />
    </div>

  </div>