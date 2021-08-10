<?php

declare(strict_types=1);

namespace App\Service\Game;

use App\Interfaces\Game\GameAIInterface;
use App\Interfaces\Game\GameInterface;

/**
 * GameAI.
 */
class GameAI implements GameAIInterface
{
    private const LINES = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6],
    ];
    private const EMPTY_SCORE = 0b000;
    private const X_SCORE = 0b001;
    private const O_SCORE = 0b100;
    private const DRAW_SCORE = 0b011;

    private const CELL_SCORE = [
        GameMoveSymbol::EMPTY => self::EMPTY_SCORE,
        GameMoveSymbol::X => self::X_SCORE,
        GameMoveSymbol::O => self::O_SCORE,
    ];

    private const SCORE_TO_STATUS = [
        self::EMPTY_SCORE => GameStatus::RUNNING,
        self::X_SCORE => GameStatus::X_WON,
        self::O_SCORE => GameStatus::O_WON,
        self::DRAW_SCORE => GameStatus::DRAW,
    ];

    private const X_WON_RATING = self::X_SCORE << 3;
    private const O_WON_RATING = self::O_SCORE << 3;
    private const DRAW_RATING = self::DRAW_SCORE << 3;

    private const STATUS_TO_RATING = [
        GameStatus::RUNNING => 0,
        GameStatus::X_WON => self::X_WON_RATING,
        GameStatus::O_WON => self::O_WON_RATING,
        GameStatus::DRAW => self::DRAW_RATING,
    ];

    private const SWAP_SYMBOL = [
        GameMoveSymbol::O => GameMoveSymbol::X,
        GameMoveSymbol::X => GameMoveSymbol::O,
    ];

    /** {@inheritdoc}
     *
     * @throws \Exception
     */
    public function move(GameInterface $game, string $symbol): void
    {
        $board = $game->getBoard();
        $scores = [];
        foreach ($board as $index => $cell) {
            $scores[$index] = GameMoveSymbol::EMPTY === $cell ? static::getNextStepRating($board, $index, GameMoveSymbol::O) : 0;
        }
        $board[static::selectCell($scores)] = GameMoveSymbol::O;
        $game->setBoard($board);
        static::checkGameStatus($game);
    }

    /** {@inheritdoc} */
    public function checkGameStatus(GameInterface $game): void
    {
        $status = static::getStatus($game->getBoard());
        $game->setStatus($status);
    }

    private static function getStatus(array $board): string
    {
        $totalScore = static::X_SCORE | static::O_SCORE;
        $result = static::EMPTY_SCORE;
        foreach (static::LINES as $line) {
            $totalLineScore = static::X_SCORE | static::O_SCORE;
            $allLineScores = static::EMPTY_SCORE;
            foreach ($line as $index) {
                $cellScore = static::CELL_SCORE[$board[$index]];
                $totalLineScore &= $cellScore;
                $allLineScores |= $cellScore;
            }
            $result |= $totalLineScore;
            $totalScore &= $allLineScores;
        }
        if ((static::O_SCORE | static::X_SCORE) === $totalScore) {
            $result = static::DRAW_SCORE;
        }

        return static::SCORE_TO_STATUS[$result];
    }

    private static function getNextStepRating(array $board, int $index, string $symbol): int
    {
        $ratings = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        $board[$index] = $symbol;
        $symbol = static::SWAP_SYMBOL[$symbol];
        $status = static::getStatus($board);
        $result = static::STATUS_TO_RATING[$status];
        if (GameStatus::RUNNING === $status) {
            foreach ($board as $index => $cell) {
                if (GameMoveSymbol::EMPTY === $cell) {
                    $ratings[$index] = static::getNextStepRating($board, $index, $symbol);
                    if ($ratings[$index] < 16) {
                        ++$ratings[$index];
                    } elseif ($ratings[$index] > 24) {
                        --$ratings[$index];
                    }
                }
            }
            if (GameMoveSymbol::X === $symbol) {
                $result = static::O_WON_RATING;
                foreach ($board as $index => $cell) {
                    if (GameMoveSymbol::EMPTY === $cell && $result > $ratings[$index]) {
                        $result = $ratings[$index];
                    }
                }
            } else {
                $result = static::X_WON_RATING;
                foreach ($board as $index => $cell) {
                    if (GameMoveSymbol::EMPTY === $cell && $result < $ratings[$index]) {
                        $result = $ratings[$index];
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @throws \Exception
     */
    private static function selectCell(array $moveScores): int
    {
        $maxScore = 0;
        $moves = [];
        foreach ($moveScores as $score) {
            if ($score <= $maxScore) {
                continue;
            }
            $maxScore = $score;
        }
        foreach ($moveScores as $index => $score) {
            if ($score === $maxScore) {
                $moves[] = $index;
            }
        }
        $randomMove = random_int(0, \count($moves) - 1);

        return $moves[$randomMove];
    }
}
