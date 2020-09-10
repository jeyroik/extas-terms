<?php
namespace extas\interfaces\terms;

use extas\components\exceptions\AlreadyExist;
use extas\interfaces\IItem;

/**
 * Interface ITermCalculationResult
 *
 * @package extas\interfaces\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITermCalculationResult extends IItem
{
    public const SUBJECT = 'extas.term.calculation.result';

    public const FIELD__CALCULATED_TERMS = 'calculated';
    public const FIELD__SKIPPED_TERMS = 'skipped';

    public const SKIPPED__TERM = 'term';
    public const SKIPPED__MESSAGE = 'message';
    public const SKIPPED__CODE = 'code';

    /**
     * @return array
     */
    public function getCalculatedTerms(): array;

    /**
     * @return array
     */
    public function getSkippedTerms(): array;

    /**
     * @return bool
     */
    public function hasCalculatedTerms(): bool;

    /**
     * @return bool
     */
    public function hasSkippedTerms(): bool;

    /**
     * @param ITerm $term
     * @param $value
     * @return mixed
     * @throws AlreadyExist
     */
    public function addCalculatedTerm(ITerm $term, $value);

    /**
     * @param ITerm $term
     * @param string $message
     * @param int $code
     * @return $this
     * @throws AlreadyExist
     */
    public function addSkippedTerm(ITerm $term, string $message, int $code);
}
