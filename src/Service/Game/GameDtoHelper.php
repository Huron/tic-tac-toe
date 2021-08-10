<?php

declare(strict_types=1);

namespace App\Service\Game;

use App\Exception\Validation\AbstractValidationException;
use App\Exception\Validation\PropertyIsRequiredException;
use App\Exception\Validation\UnexpectedPropertyException;
use App\Exception\Validation\WrongGameStageException;
use App\Exception\Validation\WrongMoveException;
use App\Exception\Validation\WrongValueException;
use App\Interfaces\Game\GameDtoHelperInterface;
use App\Interfaces\Game\GameInterface;
use App\Service\Game\Factory\GameObjectFactory;

/**
 * GameDtoHelper.
 */
class GameDtoHelper implements GameDtoHelperInterface
{
    /** {@inheritdoc}
     *
     * @throws AbstractValidationException
     */
    public function createGateFromDto(\stdClass $dto, ?string $id = null, string $status = GameStatus::RUNNING): GameInterface
    {
        $this->validateDto($dto);

        return GameObjectFactory::createGame($id, $this->convertStringToBoard($dto->board), $status);
    }

    /**
     * @param GameInterface $previousState
     * @param GameInterface $currentState
     *
     * @throws WrongGameStageException
     * @throws WrongMoveException
     */
    public function checkMove(GameInterface $previousState, GameInterface $currentState): void
    {
        if ($previousState->isFinished()) {
            throw new WrongGameStageException();
        }
        $diff = [];
        $previousBoard = $previousState->getBoard();
        $currentBoard = $currentState->getBoard();
        foreach ($previousBoard as $index => $previousCell) {
            $currentCell = $currentBoard[$index];
            if ($previousCell === $currentCell) {
                continue;
            }
            $diff[] = [$previousCell, $currentCell];
        }
        if (1 !== \count($diff) || GameMoveSymbol::EMPTY !== $diff[0][0] || GameMoveSymbol::X !== $diff[0][1]) {
            throw new WrongMoveException();
        }
    }

    /**
     * @param \stdClass $dto
     *
     * @throws AbstractValidationException
     */
    private function validateDto(\stdClass $dto): void
    {
        if (isset($dto->id)) {
            throw new UnexpectedPropertyException('id');
        }
        if (isset($dto->status)) {
            throw new UnexpectedPropertyException('status');
        }
        if (!isset($dto->board)) {
            throw new PropertyIsRequiredException('board');
        }
        if (!preg_match(sprintf('/[%s%s%s]{9}/', GameMoveSymbol::O, GameMoveSymbol::X, GameMoveSymbol::EMPTY), $dto->board)) {
            throw new WrongValueException('board');
        }
    }

    /**
     * @param string $stringBoard
     *
     * @return array
     */
    private function convertStringToBoard(string $stringBoard): array
    {
        return str_split($stringBoard);
    }
}
