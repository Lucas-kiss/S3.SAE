<?php
    /* 
        CETTE PAGE A POUR BUT DE :
            - DETRUIRE LA SESSION
            - REDIRIGER VERS LA PAGE DE CONNEXION
    */
    // Terminer la session
    session_start();
    session_destroy();
    // Rediriger vers la page de login
    header("Location: Internaute/index.php");
?>