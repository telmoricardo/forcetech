<?php

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