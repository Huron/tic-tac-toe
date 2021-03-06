<?php

declare(strict_types=1);

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
     * @param string $id
     * @param array  $board
     * @param string $status
     */
    public function __construct(string $id, array $board, string $status)
    {
        $this->id = $id;
        $this->board = $board;
        $this->status = $status;
    }

    /** {@inheritdoc} */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /** {@inheritdoc} */
    public function getBoard(): array
    {
        return $this->board;
    }

    /** {@inheritdoc} */
    public function setBoard(array $board): self
    {
        $this->board = $board;

        return $this;
    }

    /** {@inheritdoc} */
    public function getStatus(): string
    {
        return $this->status;
    }

    /** {@inheritdoc} */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
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
