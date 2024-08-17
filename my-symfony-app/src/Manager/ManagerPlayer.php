<?php

namespace App\Manager;

use App\Entity\PlayerEntity;
use App\Repository\PlayerRepository;

class ManagerPlayer {

  public function __construct(private readonly PlayerRepository $playerRepository) {
  }

  /**
   * @return PlayerEntity[]
   */
  public function getPlayerList(): array {
    return $this->playerRepository->getPlayerList();
  }

  /**
   * @param int $playerId
   * @param int $score
   * @return bool
   */
  public function updatePlayerById(int $playerId, int $score): bool {
    $this->playerRepository->update($playerId, $score);
    return true;
  }

  /**
   * @param PlayerEntity[] $playerList
   * @return void
   */
  public function resetScoreByPlayerList(array $playerList): void {
    foreach ($playerList as $player) {
      $playerEntity = new PlayerEntity($player['id'], $player['name'], $player['score']);
      $this->playerRepository->resetPlayerScore($playerEntity);
    }
  }
}