<?php

namespace App\Interfaces\Game;

/**
 * GameAIInterface.
 */
interface GameAIInterface
{
    /**
     * @param GameInterface $game
     * @param string $symbol
     */
    public function move(GameInterface $game, string $symbol): void;

    /**
     * @param GameInterface $game
     */
    public function checkGameStatus(GameInterface $game): void;
}