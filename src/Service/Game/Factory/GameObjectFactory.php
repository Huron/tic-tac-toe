<?php

declare(strict_types=1);

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
    public static function createStorage(): GameStorageInterface
    {
        return new GameStorage();
    }

    public static function createDtoHelper(): GameDtoHelperInterface
    {
        return new GameDtoHelper();
    }

    public static function createGameAI(): GameAIInterface
    {
        return new GameAI();
    }

    public static function createGame(?string $id, array $board, string $status): GameInterface
    {
        return new Game($id ?? Uuid::uuid4(), $board, $status);
    }
}
