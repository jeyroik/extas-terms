<?php
namespace extas\interfaces\terms;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IHasTags;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ITermCalculator
 *
 * @package extas\interfaces\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITermCalculatorDescription extends IItem, IDispatcherWrapper, IHasSampleParameters, IHasTags
{
    public const SUBJECT = 'extas.term.calculator.description';
}
