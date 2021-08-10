<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

/**
 * GameInterface.
 */
interface GameInterface extends \JsonSerializable
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return array
     */
    public function getBoard(): array;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return $this
     */
    public function setBoard(array $board): self;

    /**
     * @return $this
     */
    public function setStatus(string $status): self;

    /**
     * @return bool
     */
    public function isFinished(): bool;
}
