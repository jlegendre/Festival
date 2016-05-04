<?php
	include ("_debut.inc.php");
	session_unset ();
	session_destroy ();
	echo ("Déconnexion réussie !");
	header ("refresh:1; url=index.php");