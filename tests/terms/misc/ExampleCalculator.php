<?php
namespace tests\terms\misc;

use extas\components\terms\TermCalculator;
use extas\interfaces\terms\ITerm;

/**
 * Class ExampleCalculator
 *
 * @package tests\terms\misc
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExampleCalculator extends TermCalculator
{
    /**
     * @param ITerm $term
     * @param array $args
     * @return bool
     */
    public function canCalculate(ITerm $term, array $args = []): bool
    {
        return $term->getTitle() === 'is ok';
    }

    /**
     * @param ITerm $term
     * @param array $args
     * @return mixed|string
     */
    public function calculateTerm(ITerm $term, array $args = [])
    {
        return $term->getTitle();
    }
}
