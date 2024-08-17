<?php

namespace App\Controller;

use App\Manager\ManagerPlayer;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PlayerController extends ControllerAbstract {

  /**
   * @param ManagerPlayer $managerPlayer
   * @return JsonResponse
   */
  #[Route('/player', name: 'getPlayerList', methods: ['GET'])]
  public function getPlayerList(ManagerPlayer $managerPlayer): JsonResponse {
    return $this->jsonCallable(fn() => $managerPlayer->getPlayerList());
  }

  /**
   * @param int $player_id
   * @param Request $request
   * @param ManagerPlayer $managerPlayer
   * @return JsonResponse
   */
  #[Route('/player/update/{player_id}', name: 'updateScoreById', methods: ['POST'])]
  public function updateScoreById(int $player_id, Request $request, ManagerPlayer $managerPlayer): JsonResponse {
    $array = $request->toArray();
    $score = $array['score'];
    return $this->jsonCallable(fn() => $managerPlayer->updatePlayerById($player_id, $score));
  }

  /**
   * @param Request $request
   * @param ManagerPlayer $managerPlayer
   * @return JsonResponse
   */
  #[Route('/player/resetScore', name: 'resetScoreByPlayerList', methods: ['POST'])]
  public function resetScoreByPlayerList(Request $request, ManagerPlayer $managerPlayer): JsonResponse {
    $array = $request->toArray();
    $playerList = $array['playerList'];
    return $this->jsonCallable(fn() => $managerPlayer->resetScoreByPlayerList($playerList));
  }
}
