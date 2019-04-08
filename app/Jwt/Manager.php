<?php

namespace CodeFinance\Jwt;

use Tymon\JWTAuth\Manager as JwtManager;
use Tymon\JWTAuth\Token;

class Manager extends JwtManager {

    public function refresh(Token $token, $forceForever = false) {
        $this->setRefreshFlow(); // ativa o modo de refresh
        return parent::refresh($token, $forceForever);
    }
    
}