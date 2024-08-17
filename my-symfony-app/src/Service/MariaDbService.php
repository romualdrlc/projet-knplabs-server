<?php

namespace App\Service;

use Exception;
use PDO;

class MariaDbService {
  private PDO $pdo;
  
  public function __construct() {
    //    var_dump(getenv('MARIADB_HOST'), getenv('MARIADB_PORT'), getenv('MARIADB_DB'), getenv('MARIADB_USER'), getenv('MARIADB_PASSWORD'));
    
    try {
      $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', getenv('MARIADB_HOST'), getenv('MARIADB_PORT'), getenv('MARIADB_DB'));
      $this->pdo = new PDO($dsn, getenv('MARIADB_USER'), getenv('MARIADB_PASSWORD'), [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    } catch (Exception $exception) {
      throw new \RuntimeException("Pas de connexion bdd : " . $exception->getMessage());
    }
  }
  
  /**
   * @return PDO
   */
  public function getClient(): PDO {
    return $this->pdo;
  }
}