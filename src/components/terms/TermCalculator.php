<?php
namespace extas\components\terms;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\interfaces\terms\ITermCalculationResult;
use extas\interfaces\terms\ITermCalculator;

/**
 * Class TermCalculator
 *
 * @package extas\components\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
abstract class TermCalculator extends Item implements ITermCalculator
{
    use THasSampleParameters;

    /**
     * @param array $terms
     * @param array $args
     * @return ITermCalculationResult
     * @throws \extas\components\exceptions\AlreadyExist
     */
    public function calculateTerms(array $terms, array $args = []): ITermCalculationResult
    {
        $result = new TermCalculationResult();

        foreach ($terms as $term) {
            if ($this->canCalculate($term, $args)) {
                $result->addCalculatedTerm($term, $this->calculateTerm($term, $args));
            } else {
                $result->addSkippedTerm($term, 'Can not calculate', 400);
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
