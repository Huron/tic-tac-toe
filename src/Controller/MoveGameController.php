<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\FileNotFoundException;
use App\Interfaces\RequestInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Game\Factory\GameObjectFactory;
use App\Service\Game\GameMoveSymbol;
use App\Service\Http\JsonResponse;
use App\Service\Routing\Route;

/**
 * MoveGameController.
 *
 * @Route(pattern="^/api/v1/games/(?<game_id>[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12})$", methods={"PUT"})
 */
class MoveGameController extends AbstractController
{
    /** {@inheritdoc} */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $storage = GameObjectFactory::createStorage();
        $helper = GameObjectFactory::createDtoHelper();
        $id = $request->get('game_id');
        $previousGame = $storage->get($id);
        if (null === $id || null === $previousGame) {
            throw new FileNotFoundException();
        }
        $currentGame = $helper->createGateFromDto($request->getJsonData(), $id);
        $helper->checkMove($previousGame, $currentGame);
        $ai = GameObjectFactory::createGameAI();
        $ai->checkGameStatus($currentGame);
        if (!$currentGame->isFinished()) {
            $ai->move($currentGame, GameMoveSymbol::O);
        }
        $storage->save($currentGame);

        return new JsonResponse($currentGame);
    }
}
