<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

use App\Service\Game\Game;

/**
 * GameStorageInterface.
 */
interface GameStorageInterface
{
    /**
     * @return GameInterface[]
     */
    public function list(): array;

    /**
     * @param GameInterface $game
     */
    public function save(GameInterface $game): void;

    /**
     * @param null|string $id
     *
     * @return null|Game
     */
    public function get(?string $id): ?Game;

    /**
     * @param null|string $id
     */
    public function delete(?string $id): void;
}
