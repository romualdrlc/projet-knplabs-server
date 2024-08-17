<?php

namespace App\Entity;

class PlayerEntity implements \JsonSerializable {
  
  private int $id;
  private string $name;
  private int $score;
  
  /**
   * @param int $id
   * @param string $name
   * @param int $score
   */
  public function __construct(int $id, string $name, int $score) {
    $this->id = $id;
    $this->name = $name;
    $this->score = $score;
  }
  
  public function getName(): string {
    return $this->name;
  }
  
  public function setName(string $name): void {
    $this->name = $name;
  }
  
  public function getScore(): int {
    return $this->score;
  }
  
  public function setScore(int $score): void {
    $this->score = $score;
  }
  
  /**
   * @return array{
   *   id: int,
   *   name: string,
   *   score: int
   * }
   */
  public function jsonSerialize(): array {
    return ['id' => $this->id, 'name' => $this->name, 'score' => $this->score,];
  }
}