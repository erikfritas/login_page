<?php

/**
 * Redireciona para a url
 * colocada
 * @param string $url
 * @return void
 */
function redirect($url){
    echo "<script>window.location.href='$url'</script>";
}

/**
 * Cria a query, muito
 * útil para fazer redirect
 * de forma rápida e dinâmica
 * @param array $query
 * @return string
 */
function createQuery($query){
    $queries = [];

    foreach ($query as $value){
        $key = array_keys($value)[0];
        $value = $value[$key];
        $queries = array_merge($queries, [$key => $value]);
    }

    return "?".http_build_query($queries);
}

/**
 * Retorna a um array
 * preparado para o
 * createQuery
 * @param array $query
 * @return array
 */
function getQuery($query){
    $key = array_keys($query)[0];
    $value = $query[$key];

    if (isset($_GET[$key]))
        return [$key => $_GET[$key]];
    else
        return [$key => $value];
}

/**
 * Método responsável por
 * filtrar a váriavel
 * @param mixed $var
 * @param int $filter (optional)
 * @return mixed
 */
function filter_($var, $filter=FILTER_SANITIZE_STRIPPED){
    return filter_var(htmlspecialchars($var), $filter);
}

/**
 * Método de debugs
 */
function debug($var, ...$args){
    echo "<pre>";
    var_dump($var);
    foreach ($args as $value)
        var_dump($value);
    echo "</pre>";
}

/**
 * retorna a var caso cumpra os requisitos
 * @param mixed $var
 * @param mixed $returnable
 * @param mixed $requisitos (optional)
 * @return mixed
 */
function get_var($var, $returnable, $requisitos=''){
    return $var != $requisitos ? $var : $returnable;
}

/**
 * Método responsável por
 * retornar um tempo, retorna
 * default == 1 min
 * @param int $secs (optional)
 * @param int $mins (optional)
 * @param int $hours (optional)
 * @param int $days (optional)
 * @param int $months (optional)
 * @return int
 */
function newtime($secs=60, $mins=1, $hours=1, $days=1, $months=1){
    $nsecs = get_var($secs, 60);
    $nmins = get_var($mins, 1);
    $nhours = get_var($hours, 1);
    $ndays = get_var($days, 1);
    $nmonths = get_var($months, 1);

    return time() + $nsecs * $nmins * $nhours * $ndays * $nmonths;
}
