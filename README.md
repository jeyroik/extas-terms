![tests](https://github.com/jeyroik/extas-terms/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-terms/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 

[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-terms/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-terms/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-terms/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)


# Описание

Пакет предоставляет модель для работы с термами (слагаемыми).

Терм - именованный вычисляемый параметр.

# Использование

Получаем список термов:

```php
use \extas\interfaces\terms\ITerm;
$terms = $this->terms()->all([ITerm::FIELD__TAGS => 'some.tag']);
```

Получаем список калькуляторов:

```php
use extas\interfaces\terms\ITermCalculatorDescription;
$calculators = $this->termsCalculators()->all();
```

Вычисляем термы:

```php
use extas\interfaces\terms\ITerm;
use extas\interfaces\terms\ITermCalculatorDescription;
use extas\interfaces\terms\ITermCalculationResult;
use extas\interfaces\terms\ITermCalculator;

/**
 * @var ITerm[] $terms
 * @var ITermCalculatorDescription[] $calculators
 */

$calculated = [];

foreach ($calculators as $calculatorDescription) {
    /**
     * @var ITermCalculationResult $result
     * @var ITermCalculator $calculator
     */
    $calculator = $calculatorDescription->buildClassWithParameters([]);
    $result = $calculator->calculateTerms($terms, ['some' => 'args']);

    /**
     * Or you can just 
     * $result = $calculatorDescription->runWithParameters([], 'calculateTerms', $terms);
     */

    /**
     * You should iterate terms if you need to pass different arguments to each of them:
     * foreach($terms as $terms) {
     *      if ($calculator->canCalculate($term, ['some1' => 'arg1'])) {
     *          $calculated[] = $calculator->calculateTerm($term, ['some1' => 'arg1']);
     *      } 
     * }
     */

    $calculated = array_merge($calculated, $result->getCalculatedTerms());
    $terms = array_column($result->getSkippedTerms(), ITermCalculationResult::SKIPPED__TERM);

    if (empty($terms)) {
        break;
    }
}
```