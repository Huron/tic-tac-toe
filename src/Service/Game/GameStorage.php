<?php

declare(strict_types=1);

namespace App\Service\Game;

use App\Exception\FileNotFoundException;
use App\Interfaces\Game\GameInterface;
use App\Interfaces\Game\GameStorageInterface;

/**
 * GameStorage.
 */
class GameStorage implements GameStorageInterface
{
    public const DIRECTORY = __DIR__.'/../../../var/games';

    /** {@inheritdoc} */
    public function list(): array
    {
        $games = [];
        foreach (new \DirectoryIterator(self::DIRECTORY) as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }
            $content = file_get_contents($fileInfo->getPathname());
            if (!\is_string($content)) {
                continue;
            }
            $game = unserialize($content);
            if (!$game instanceof GameInterface) {
                continue;
            }
            $games[] = $game;
        }

        return $games;
    }

    /** {@inheritdoc} */
    public function save(GameInterface $game): void
    {
        file_put_contents(static::getFileName($game->getId()), serialize($game));
    }

    /** {@inheritdoc} */
    public function get(?string $id): ?GameInterface
    {
        if (null === $id) {
            return null;
        }
        $fileName = static::getFileName($id);
        if (!file_exists($fileName)) {
            return null;
        }
        $content = file_get_contents($fileName);
        if (!\is_string($content)) {
            return null;
        }
        $game = unserialize($content);

        return $game instanceof GameInterface ? $game : null;
    }

    /**
     * @param null|string $id
     *
     * @throws FileNotFoundException
     */
    public function delete(?string $id): void
    {
        if (null === $id) {
            throw new FileNotFoundException();
        }
        $fileName = static::getFileName($id);
        if (!file_exists($fileName)) {
            throw new FileNotFoundException();
        }
        unlink($fileName);
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private static function getFileName(string $id): string
    {
        return sprintf('%s/%s', self::DIRECTORY, $id);
    }
}
