<?php

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
     * @param array $board
     *
     * @return $this
     */
    public function setBoard(array $board): self;

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): self;

    /**
     * @return bool
     */
    public function isFinished(): bool;
}
