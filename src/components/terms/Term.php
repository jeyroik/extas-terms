<?php
namespace extas\components\terms;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\TDispatcherWrapper;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasTags;
use extas\interfaces\terms\ITerm;

/**
 * Class Term
 *
 * @package extas\components\terms
 * @author jeyroik <jeyroik@gmail.com>
 */
class Term extends Item implements ITerm
{
    use THasName;
    use THasDescription;
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
