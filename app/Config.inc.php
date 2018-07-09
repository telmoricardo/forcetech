<?php

/* * **********SESSION***************** */
session_start();
ob_start();

/* * **********CONFIGURANTION URL***************** */
define('HOME', 'http://localhost/works/cel');
define('BASEADMIN', 'http://localhost/works/cel/admin');
//define('HOME', 'https://forcetech.com.br');
define('THEME', 'forcetech');

/* * **********CONFIGURANTION THEMES***************** */
define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes/' . THEME);

////CONFIGURAÇÕES DA URL AMIGAVEL
$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode('/', $setUrl);

//require_once '../Util/Link.php';
// DEFINE IDENTIDADE DO SITE ################
//define('SITENAME', 'Loja');
//define('SITEDESC', 'coloca aqui a descrição da loja');
//------------------------AUTOLOAD PARA NÃO INSTANCIAR O REQUIRE EM ALGUMAS PAGINAS------------------------ //
function __autoload($Class) {
    $cDir = ['Util', 'DAL', 'Model', 'Controller', 'Interfaces', 'CorreiosConsulta', 'phpquery'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.php')):
            include_once (__DIR__ . '/' . $dirName . '/' . $Class . '.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.php", E_USER_ERROR);
        die;
    endif;
}
