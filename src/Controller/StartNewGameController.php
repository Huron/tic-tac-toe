<?php

namespace App\Controller;

use App\Interfaces\RequestInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Game\Factory\GameObjectFactory;
use App\Service\Http\HttpStatusCode;
use App\Service\Http\JsonResponse;
use App\Service\Routing\Route;

/**
 * StartNewGameController.
 *
 * @Route(pattern="^/api/v1/games$", methods={"POST"})
 */
class StartNewGameController extends AbstractController
{
    public function execute(RequestInterface $request): ResponseInterface
    {
        $game = GameObjectFactory::createDtoHelper()->createGateFromDto($request->getJsonData());
        GameObjectFactory::createStorage()->save($game);
        $location = \sprintf('/api/v1/games/%s', $game->getId());

        return new JsonResponse(
            [
                'location' => $location,
            ],
            HttpStatusCode::CREATED,
            ['Location' => $location]
        );
    }
}