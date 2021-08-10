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
    /**
     * @param \stdClass   $dto
     * @param null|string $id
     * @param string      $status
     *
     * @return GameInterface
     */
    public function createGateFromDto(\stdClass $dto, ?string $id = null, string $status = GameStatus::RUNNING): GameInterface;

    /**
     * @param Game          $previousState
     * @param GameInterface $currentState
     */
    public function checkMove(Game $previousState, GameInterface $currentState): void;
}
