<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

/**
 * GameAIInterface.
 */
interface GameAIInterface
{
    public function move(GameInterface $game, string $symbol): void;

    public function checkGameStatus(GameInterface $game): void;
}
