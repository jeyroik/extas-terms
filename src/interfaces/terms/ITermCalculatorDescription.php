<?php
namespace extas\interfaces\terms;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ITermCalculator
 *
 * @package extas\interfaces\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITermCalculatorDescription extends IItem, IDispatcherWrapper, IHasSampleParameters
{
    public const SUBJECT = 'extas.term.calculator.description';
}
