<?php

declare(strict_types=1);

namespace App\Controller;

use App\Interfaces\RequestInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Game\Factory\GameObjectFactory;
use App\Service\Http\Response;
use App\Service\Routing\Route;

/**
 * DeleteGameController.
 *
 * @Route(pattern="^/api/v1/games/(?<game_id>[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12})$", methods={"DELETE"})
 */
class DeleteGameController extends AbstractController
{
    /** {@inheritdoc} */
    public function execute(RequestInterface $request): ResponseInterface
    {
        GameObjectFactory::createStorage()->delete($request->get('game_id'));

        return new Response();
    }
}
