<?php

namespace App\Controller\Pages;

use \App\Controller\Pages\Pages;
use \App\Controller\Pages\Html;
use \App\Utils\View;

class Home extends Pages{

    /**
     * Método responsável por
     * retornar a página ajuda
     * @param string $page
     * @param array $arr (optional)
     * @return string
     */
    private static function getRenderedPage($page, $arr=[]){
        return View::render("pages/$page", $arr);
    }

    /**
     * Método responsável por
     * retornar o content_top
     * @return array
     */
    private static function getContent(){
        return [];
    }

    /**
     * Método responsável por retornar
     * a Home
     * @return string
     */
    public static function getHome(){
        $content = [];

        if ($_GET['local'] === 'login')
            array_push($content, View::render("pages/login", self::getContent()));
        elseif ($_GET['local'] === 'logged')
            array_push($content, View::render("pages/logged", self::getContent()));
        else
            array_push($content, '<section id="login">Error 404</section>');


        return self::getPage("Home", $content);
    }

}
