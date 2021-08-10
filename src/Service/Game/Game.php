<?php

namespace App\Service\Game;

use App\Interfaces\Game\GameInterface;

/**
 * Game.
 */
class Game implements GameInterface
{
    private string $id;
    private array $board;
    private string $status;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Game
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param array $board
     * @return Game
     */
    public function setBoard(array $board): self
    {
        $this->board = $board;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Game
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $id
     * @param array $board
     * @param string $status
     */
    public function __construct(string $id, array $board, string $status)
    {
        $this->id = $id;
        $this->board = $board;
        $this->status = $status;
    }

    /** {@inheritdoc} */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'board' => implode('', $this->board),
            'status' => $this->status,
        ];
    }

    /** {@inheritdoc} */
    public function isFinished(): bool
    {
        return GameStatus::RUNNING !== $this->status;
    }
}