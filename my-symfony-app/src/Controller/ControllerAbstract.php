<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ControllerAbstract extends AbstractController {

  /**
   * @param mixed                 $data
   * @param int                   $status
   * @param array<string, string> $headers
   * @param array<string, mixed>  $context
   * @return JsonResponse
   */
  protected function json(mixed $data, int $status = Response::HTTP_OK, array $headers = [], array $context = []): JsonResponse {
    return parent::json($data, $status < 100 || $status >= 600 ? Response::HTTP_INTERNAL_SERVER_ERROR : $status, $headers, $context);
  }

  protected function jsonCallable(callable $callable, bool $content = true): JsonResponse {
    try {
      $result = $callable();
      return $content ? $this->json($result) : $this->json([], Response::HTTP_NO_CONTENT);
    }catch(Exception $exception) {
      return $this->json($exception->getMessage(), (int) $exception->getCode() ?: Response::HTTP_BAD_REQUEST);
    }
  }

}