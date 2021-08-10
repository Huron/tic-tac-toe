<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\JsonEncodingException;
use App\Interfaces\RequestInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Game\Factory\GameObjectFactory;
use App\Service\Http\JsonResponse;
use App\Service\Routing\Route;

/**
 * GetGamesListController.
 *
 * @Route(pattern="^/api/v1/games$", methods={"GET"})
 */
class GetGamesListController extends AbstractController
{
    /** {@inheritdoc}
     *
     * @throws JsonEncodingException
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $games = GameObjectFactory::createStorage()->list();

        return new JsonResponse($games);
    }
}
