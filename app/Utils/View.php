<?php

namespace App\Utils;

class View{

    /**
     * Método responsável por
     * retornar uma img
     * @param string $name
     * @param string $id (optional)
     * @return string
     */
    public static function getImage($name, $id=''){
        return "<img id=\"$id\" src=\"".T_PATH."resources/view/images/$name\" alt=\"Imagem $name\">";
    }

    /**
     * Método responsável por
     * retornar o favicon
     * @param string $name
     * @return string
     */
    public static function getFavicon($name){
        return "<meta rel=\"shortcut icon\" href=\"".T_PATH."resources/view/images/$name.ico\">";
    }

    /**
     * Retorna um arquivo
     * @param string $name
     * @param string $dir
     * @return string
     */
    private static function getFilesByString($name, $dir){
        $local = __DIR__ . "/../../resources/view/$name/$dir";
        $dir_ = scandir($local);
        if ($dir_){
            $files_dir = sizeof($dir_)-2;

            $file_txt = "<!-- ".strtoupper($name)." (files = $files_dir) -->";
            foreach ($dir_ as $value){
                # verifica se o arquivo tem uma extensão do tipo $name
                if (pathinfo($value)['extension'] === $name)
                    $file_txt .= "<script src=\"".T_PATH."resources/view/$name/$dir/$value\"></script>";
            }
            $file_txt .= "<!-- END ".strtoupper($name)." -->";
            return $file_txt;
        } else return '';
    }

    /**
     * Retorna um arquivo
     * @param string $name
     * @param array $dir
     * @return string
     */
    private static function getFilesByArray($name, $dir){
        $locals = $dir;
        $local_ = __DIR__ . "/../../resources/view/$name/";
        $size_dirs = 0;

        // pega a quantidade de arquivos na pasta
        foreach ($locals as $value)
            $size_dirs += sizeof(scandir($local_.$value))-2;
        
        $file_txt = "<!-- ".strtoupper($name)." (files = $size_dirs) -->";

        // percorre os diretórios
        foreach ($locals as $dir_name) {
            $local = $local_ . $dir_name;
            $dir_array = scandir($local);
            if ($dir_array){
                // percorre um diretório de dentro
                foreach ($dir_array as $value){
                    # verifica se o arquivo tem uma extensão do tipo $name
                    if (pathinfo($value)['extension'] === $name){
                        if ($name === "js"){
                            $file_txt .= "<script src=\"".T_PATH."resources/view/$name/$dir_name/$value\"></script>";
                        } elseif ($name === "css"){
                            $file_txt .= "<link rel=\"stylesheet\" href=\"".T_PATH."resources/view/$name/$dir_name/$value\">";
                        }
                    }
                }
            }
        }
        $file_txt .= "<!-- END ".strtoupper($name)." -->";
        return $file_txt;
    }

    /**
     * Método responsável por
     * retornar um ou mais 
     * arquivos da página, tipo 
     * css e js por exemplo
     * @param string $name
     * @param string|array $dir
     * @return string
     */
    public static function getFiles($name, $dir){
        // se $dir for uma string
        if (gettype($dir) === "string"){
            return self::getFilesByString($name, $dir);

        // se $dir for um array
        } elseif (gettype($dir) === "array") {
            return self::getFilesByArray($name, $dir);

        } else return '';
    }
    /**
     * Método responsável por retornar
     * o conteúdo da view se ela existir
     * @param string $view (tem que ter ext, ex: view.html ou view.css)
     * @return string
     */
    private static function getContentView($view){
        $file = __DIR__."/../../resources/view/$view.html";
        return (file_exists($file)) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por renderiar o conteúdo
     * @param string $view
     * @param array $vars
     * @return string
     */
    public static function render($view, $vars=[]){
        $contentView = self::getContentView($view);

        $vars_keys = array_map(function($v){
            return "{{{$v}}}";
        }, array_keys($vars));

        $vars_values = array_values($vars);

        return str_replace($vars_keys, $vars_values, $contentView);
    }

}
