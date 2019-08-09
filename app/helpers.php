<?php
/**
 * Quando for adicionar arquivos isolados, deve-se carregar no autoload da aplicação
 * Esta configuração pode ser feita no composer.json na sessão autoload > files.
 * @param $name
 * @return mixed
 * Função que retorna true ou false conforme a rota passada
 */
function isRouteActive($name) {
    return Route::currentRouteNamed($name);
}