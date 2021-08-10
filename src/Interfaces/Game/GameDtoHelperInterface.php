<?php

declare(strict_types=1);

namespace App\Interfaces\Game;

use App\Service\Game\Game;
use App\Service\Game\GameStatus;

/**
 * GameDtoHelperInterface.
 */
interface GameDtoHelperInterface
{
    public function createGateFromDto(\stdClass $dto, ?string $id = null, string $status = GameStatus::RUNNING): GameInterface;

    public function checkMove(Game $previousGame, GameInterface $currentGame): void;
}
