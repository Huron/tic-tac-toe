<?php

namespace App\Interfaces\Game;

use App\Service\Game\Game;
use App\Service\Game\GameStatus;

/**
 * GameDtoHelperInterface.
 */
interface GameDtoHelperInterface
{
    /**
     * @param \stdClass $dto
     * @param string|null $id
     * @param string $status
     *
     * @return GameInterface
     */
    public function createGateFromDto(\stdClass $dto, ?string $id = null, string $status = GameStatus::RUNNING): GameInterface;

    /**
     * @param Game $previousGame
     * @param GameInterface $currentGame
     */
    public function checkMove(Game $previousGame, GameInterface $currentGame): void;
}