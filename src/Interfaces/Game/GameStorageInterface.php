<?php

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
     * @param string|null $id
     *
     * @return Game|null
     */
    public function get(?string $id): ?Game;

    /**
     * @param string|null $id
     */
    public function delete(?string $id): void;
}