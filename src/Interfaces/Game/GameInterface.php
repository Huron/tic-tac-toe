<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

/**
 * GameInterface.
 */
interface GameInterface extends \JsonSerializable
{
    public function getId(): string;

    public function getBoard(): array;

    public function getStatus(): string;

    /**
     * @return $this
     */
    public function setBoard(array $board): self;

    /**
     * @return $this
     */
    public function setStatus(string $status): self;

    public function isFinished(): bool;
}
