<?php

namespace App\Repository;

use App\Entity\PlayerEntity;
use App\Service\MariaDbService;
use PDO;
use Symfony\Contracts\Service\Attribute\Required;

class PlayerRepository {

  #[Required]
  public MariaDbService $dbService;

  /**
   * @return PlayerEntity[]
   */
  public function getPlayerList(): array {
    $sql = <<<'SQL'
        SELECT id, name, score
        FROM player
    SQL;

    $stmt = $this->dbService->getClient()->query($sql);
    $arrayResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $playerList = [];
    foreach ($arrayResult as $row) {
      $playerList[] = new PlayerEntity($row['id'], $row['name'], $row['score'] ?? 0);
    }
    return $playerList;
  }

  public function update(int $playerId, int $score): void {
    $sql = <<<'SQL'
        UPDATE player p
        SET p.score = :score
        WHERE id = :playerId;
    SQL;

    $stmt = $this->dbService->getClient()->prepare($sql);
    $stmt->execute(['playerId' => $playerId, 'score' => $score]);
  }

  public function resetPlayerScore(PlayerEntity $player): void {
    $sql = <<<'SQL'
        UPDATE player
        SET score = 0
        WHERE id = :id; 
    SQL;
    $stmt = $this->dbService->getClient()->prepare($sql);
    $stmt->execute(['id' => $player->getId()]);
  }
}