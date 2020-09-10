<?php
namespace extas\interfaces\terms;

use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ITermCalculator
 *
 * @package extas\interfaces\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITermCalculator extends IItem, IHasSampleParameters
{
    public const SUBJECT = 'extas.term.calculator';

    /**
     * @param ITerm $term
     * @param array $args
     * @return bool
     */
    public function canCalculate(ITerm $term, array $args = []): bool;

    /**
     * Return a term value.
     *
     * @param ITerm $term
     * @param array $args
     * @return mixed
     */
    public function calculateTerm(ITerm $term, array $args = []);

    /**
     * @param ITerm[] $terms
     * @param array $args
     * @return ITermCalculationResult
     */
    public function calculateTerms(array $terms, array $args = []): ITermCalculationResult;
}
