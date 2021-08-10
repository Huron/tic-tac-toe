<?php

namespace App\Controller;

use App\Exception\FileNotFoundException;
use App\Interfaces\RequestInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Game\Factory\GameObjectFactory;
use App\Service\Http\JsonResponse;
use App\Service\Routing\Route;

/**
 * GetGameController.
 *
 * @Route(pattern="^/api/v1/games/(?<game_id>[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12})$", methods={"GET"})
 */
class GetGameController extends AbstractController
{
    /** {@inheritdoc}
     *
     * @throws FileNotFoundException
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $game = GameObjectFactory::createStorage()->get($request->get('game_id'));
        if (null === $game) {
            throw new FileNotFoundException();
        }

        return new JsonResponse($game);
    }
}