<?php
namespace extas\components\terms;

use extas\components\exceptions\AlreadyExist;
use extas\components\Item;
use extas\interfaces\terms\ITerm;
use extas\interfaces\terms\ITermCalculationResult;

/**
 * Class TermCalculationResult
 *
 * @package extas\components\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
class TermCalculationResult extends Item implements ITermCalculationResult
{
    /**
     * @return array
     */
    public function getCalculatedTerms(): array
    {
        return $this->config[static::FIELD__CALCULATED_TERMS] ?? [];
    }

    /**
     * @return array
     */
    public function getSkippedTerms(): array
    {
        return $this->config[static::FIELD__SKIPPED_TERMS] ?? [];
    }

    /**
     * @return bool
     */
    public function hasCalculatedTerms(): bool
    {
        return !empty($this->config[static::FIELD__CALCULATED_TERMS]);
    }

    /**
     * @return bool
     */
    public function hasSkippedTerms(): bool
    {
        return !empty($this->config[static::FIELD__SKIPPED_TERMS]);
    }

    /**
     * @param ITerm $term
     * @param $value
     * @return $this|mixed
     * @throws AlreadyExist
     */
    public function addCalculatedTerm(ITerm $term, $value)
    {
        $calculated = $this->getCalculatedTerms();

        if (isset($calculated[$term->getName()])) {
            throw new AlreadyExist('calculated term "' . $term->getName() . '"');
        }

        $calculated[$term->getName()] = $value;
        $this->config[static::FIELD__CALCULATED_TERMS] = $calculated;

        return $this;
    }

    /**
     * @param ITerm $term
     * @param string $message
     * @param int $code
     * @return $this|TermCalculationResult
     * @throws AlreadyExist
     */
    public function addSkippedTerm(ITerm $term, string $message, int $code)
    {
        $skipped = $this->getSkippedTerms();

        if (isset($skipped[$term->getName()])) {
            throw new AlreadyExist('skipped term "' . $term->getName() . '"');
        }

        $skipped[$term->getName()] = [
            static::SKIPPED__TERM => $term,
            static::SKIPPED__MESSAGE => $message,
            static::SKIPPED__CODE => $code
        ];

        $this->config[static::FIELD__SKIPPED_TERMS] = $skipped;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
