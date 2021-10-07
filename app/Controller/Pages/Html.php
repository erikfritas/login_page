<?php

namespace App\Controller\Pages;

class Html extends Pages{

    /**
     * Método responsável por
     * retornar um contato de whatsapp
     * @param string $text
     * @param string|integer $number
     * @param string $class='light'
     * @return string
     */
    public static function getContato($text, $number, $class='light'){
        return "<a class=\"$class\" target=\"_blank\" href=\"https://api.whatsapp.com/send?phone=$number\">$text</a>";
    }

    /**
     * Método responsável por
     * retornar um perfil no insta
     * @param string $name
     * @param string $class='light'
     * @return string
     */
    public static function getInstagram($name, $class='light'){
        return "<a class=\"$class\" target=\"_blank\" href=\"https://instagram.com/$name\">@$name</a>";
    }
}

