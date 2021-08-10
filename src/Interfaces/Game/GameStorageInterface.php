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

    public function save(GameInterface $game): void;

    public function get(?string $id): ?Game;

    public function delete(?string $id): void;
}
