<?php
namespace extas\interfaces\terms;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHasTags;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ITerm
 *
 * @package extas\interfaces\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITerm extends IItem, IHasName, IHasDescription, IHasSampleParameters, IHasTags
{
    public const SUBJECT = 'extas.term';
}
