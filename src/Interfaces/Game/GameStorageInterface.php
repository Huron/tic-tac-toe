<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

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
     * @return null|GameInterface
     */
    public function get(?string $id): ?GameInterface;

    /**
     * @param null|string $id
     */
    public function delete(?string $id): void;
}
