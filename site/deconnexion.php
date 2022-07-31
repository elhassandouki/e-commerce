<?php 
namespace GestionStock\Site;
use GestionStock\DA\LigneDA as LigneDA;
require_once '../DA/LigneDA.php';
session_start();
$lDA = new LigneDA();
$lDA->supprimerLignesSession(session_id());
session_destroy();
header("location:moncompte.php");

