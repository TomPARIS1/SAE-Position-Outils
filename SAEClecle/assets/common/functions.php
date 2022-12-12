<?php

use App\Common\PDOSingleton;

function getDB () : PDO {
    $pdo = PDOSingleton::get();
    return $pdo;
}

