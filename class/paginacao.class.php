<?php

class paginacao{
    public function paginar($array,$numeroItens){
    
       // $arquivo = glob('img/*.*');
        $arquivo = $array;
        $quantidade = $numeroItens;
        $atual = (isset($_GET['pg'])) ? intval($_GET['pg']) : 1;
        $pagArquivo = array_chunk($arquivo, $quantidade);

        //echo '<pre>';
        //print_r($pagArquivo);

        $contar = count($pagArquivo);
        $resultado = $pagArquivo[$atual-1];
    }   
}
