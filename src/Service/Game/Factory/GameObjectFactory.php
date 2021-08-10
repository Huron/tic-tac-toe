<?php

namespace App\Service\Game\Factory;

use App\Interfaces\Game\GameAIInterface;
use App\Interfaces\Game\GameDtoHelperInterface;
use App\Interfaces\Game\GameInterface;
use App\Interfaces\Game\GameStorageInterface;
use App\Service\Game\Game;
use App\Service\Game\GameAI;
use App\Service\Game\GameDtoHelper;
use App\Service\Game\GameStorage;
use Ramsey\Uuid\Uuid;

/**
 * GameObjectFactory.
 */
class GameObjectFactory
{
    /**
     * @return GameStorageInterface
     */
    public static function createStorage(): GameStorageInterface
    {
        return new GameStorage();
    }

    /**
     * @return GameDtoHelperInterface
     */
    public static function createDtoHelper(): GameDtoHelperInterface
    {
        return new GameDtoHelper();
    }

    /**
     * @return GameAIInterface
     */
    public static function createGameAI(): GameAIInterface
    {
        return new GameAI();
    }

    /**
     * @param string|null $id
     * @param array $board
     * @param string $status
     *
     * @return GameInterface
     */
    public static function createGame(?string $id, array $board, string $status): GameInterface
    {
        return new Game($id ?? Uuid::uuid4(), $board, $status);
    }
}