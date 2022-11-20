<?php

$site_name = "Géstion d'étudiants";


define('SITE_NAME', $site_name);

$ds = DIRECTORY_SEPARATOR;
define('PAGES', dirname(__DIR__) . $ds . 'assets/pages' . $ds);
define('FUNCTIONS', dirname(__DIR__) . $ds . 'assets/functions' . $ds);
define('PARTIALS', dirname(__DIR__) . $ds . 'assets/Partials' . $ds);
define('ROOT', $_SERVER['SCRIPT_NAME']);
define('IMG', dirname(__DIR__) . $ds .  'public/img/avatars' . $ds);



$pages = scandir(PAGES);
if (isset($_GET['page']) && !empty($_GET['page'])) {
    if (in_array($_GET['page'] . '.php', $pages)) {
        $page = $_GET['page'];
    } else {

        $page = "404";
    }
} else {
    $page = "home";
}

require_once(FUNCTIONS . 'db.php');

if ($page != 'login') {
    require_once(FUNCTIONS . 'function.php');
} else {

    require_once(FUNCTIONS . 'auths.func.php');
}


function myDate($str)
{
    list($annee, $mois, $jour) =  explode("-", $str);

    if ($jour == "00") $jour = "";
    elseif (substr($jour, 0, 1) == "0") $jour = substr($jour, 1, 1);

    $moisli[1] = "Janvier";
    $moisli[2] = "Février";
    $moisli[3] = "Mars";
    $moisli[4] = "Avril";
    $moisli[5] = "Mai";
    $moisli[6] = "Juin";
    $moisli[7] = "Juillet";
    $moisli[8] = "Aôut";
    $moisli[9] = "Septembre";
    $moisli[10] = "Octobre";
    $moisli[11] = "Novembre";
    $moisli[12] = "Décembre";
    if (substr($mois, 0, 1) == "0") $mois = substr($mois, 1, 1);
    $mois = $moisli[$mois];
    $str = $jour . ' ' . $mois . ' ' . $annee;
    return $str;
}
