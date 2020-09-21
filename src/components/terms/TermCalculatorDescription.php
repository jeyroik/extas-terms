<?php
namespace extas\components\terms;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\TDispatcherWrapper;
use extas\components\THasTags;
use extas\interfaces\terms\ITermCalculatorDescription;

/**
 * Class TermCalculatorDescription
 *
 * @package extas\components\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
class TermCalculatorDescription extends Item implements ITermCalculatorDescription
{
    use TDispatcherWrapper;
    use THasSampleParameters;
    use THasTags;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
