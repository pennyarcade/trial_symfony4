<?php
/**
 * Created by PhpStorm.
 * User: standard
 * Date: 4/26/18
 * Time: 2:36 PM
 */

namespace App\Sorter;



class NewsSorter
{
    /**
     * News Entities to sort
     */
    private $news;

    /**
     * Field to sort by
     */
    private $criterion;

    /**
     * Direction to sort
     */
    private $direction;


    /**
     * skip sorting if already done
     */
    private $sorted = false;


    /**
     * Setup Sorter
     */
    public function __construct($news=[], $criterion='date', $direction='ASC')
    {
        $this->news = $news;
        $this->criterion = $criterion;
        $this->direction = $direction;
    }

    /**
     * @param mixed $news
     */
    public function setNews($news): void
    {
        $this->news = $news;
        $this->sorted = false;
    }

    /**
     * @param string $criterion
     */
    public function setCriterion(string $criterion): void
    {
        $this->criterion = $criterion;
        $this->sorted = false;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
        $this->sorted = false;
    }

    /**
     * Quicksort algorithm
     *
     * @param $left
     * @param $right
     * @return array
     */
    private function quicksort($left=null, $right=null): array
    {
        if (is_null($left)) $left = 0;
        if (is_null($right)) $right = count($this->news);

        if (!$this->sorted) {
            $divisor = $this->divide($left, $right);
            $this->quicksort($left, $divisor);
            $this->quicksort($divisor, $right);
            $this->sorted = true;
        }

        return $this->news;
    }

    /**
     * Quicksort algorithm
     *
     * @param $left
     * @param $right
     * @return int
     */
    private function divide($left, $right): int
    {
        $i = $left;
        $j = $right -1;
        $pivot = $this->news[rechts];

        do {
            while (
                $this->news[$i]->lt($pivot, $this->criterion, $this->direction) and $i < $right - 1
            ) $i += 1;

            while (
                $this->news[$i]->gte($pivot, $this->criterion, $this->direction) and $i < $right - 1
            ) $j -=  1;

            if ($i < $j) {
                $temp = $this->news[$i];
                $this->news[$i] = $this->news[$j];
                $this->news[$j] = $temp;
            }

        } while ($i < $j);

        if($this->news[$i]->gt($pivot, $this->criterion, $this->direction)) {
            $temp = $this->news[$i];
            $this->news[$i] = $this->news[$right];
            $this->news[$right] = $temp;
        }

        return $i;
    }

}