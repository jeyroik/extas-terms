<?php
namespace tests\terms;

use Dotenv\Dotenv;
use extas\components\terms\TermCalculatorDescription;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\terms\Term;
use extas\components\THasMagicClass;
use extas\interfaces\terms\ITermCalculationResult;
use extas\interfaces\terms\ITermCalculator;
use PHPUnit\Framework\TestCase;
use tests\terms\misc\ExampleCalculator;

class TermsTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([

        ]);
    }

    protected function tearDown(): void
    {
        $this->unregisterSnuffRepos();
    }

    public function testCalculation()
    {
        $term2 = new Term([
            Term::FIELD__NAME => 'test2',
            Term::FIELD__TITLE => 'failed'
        ]);

        $terms = [
            new Term([
                Term::FIELD__NAME => 'test',
                Term::FIELD__TITLE => 'is ok'
            ]),
           $term2
        ];

        $desc = new TermCalculatorDescription([
            TermCalculatorDescription::FIELD__CLASS => ExampleCalculator::class
        ]);

        $calculated = [];

        /**
         * @var ITermCalculator $calculator
         */
        $calculator = $desc->buildClassWithParameters([]);

        $result = $calculator->calculateTerms($terms);

        $this->assertInstanceOf(ITermCalculationResult::class, $result, 'Incorrect result');
        $this->assertTrue(
            $result->hasCalculatedTerms(),
            'Missed calculated terms: ' . print_r($result->__toArray(), true)
        );
        $this->assertTrue(
            $result->hasSkippedTerms(),
            'Missed skipped terms: ' . print_r($result->__toArray(), true)
        );
        $this->assertEquals(
            [
                'test' => 'is ok'
            ],
            $result->getCalculatedTerms(),
            'Incorrect calculated terms: ' . print_r($result->getCalculatedTerms(), true)
        );
        $this->assertEquals(
            [
                'test2' => [
                    ITermCalculationResult::SKIPPED__TERM => $term2,
                    ITermCalculationResult::SKIPPED__MESSAGE => 'Can not calculate',
                    ITermCalculationResult::SKIPPED__CODE => 400
                ]
            ],
            $result->getSkippedTerms(),
            'Incorrect skipped terms: ' . print_r($result->getSkippedTerms(), true)
        );
    }

    public function testAlreadyHasCalculatedTerm()
    {
        $terms = [
            new Term([
                Term::FIELD__NAME => 'test',
                Term::FIELD__TITLE => 'is ok'
            ]),
            new Term([
                Term::FIELD__NAME => 'test',
                Term::FIELD__TITLE => 'is ok'
            ]),
        ];

        $desc = new TermCalculatorDescription([
            TermCalculatorDescription::FIELD__CLASS => ExampleCalculator::class
        ]);

        $calculated = [];

        /**
         * @var ITermCalculator $calculator
         */
        $calculator = $desc->buildClassWithParameters([]);

        $this->expectExceptionMessage('Calculated term "test" already exists');
        $result = $calculator->calculateTerms($terms);
    }

    public function testAlreadyHasSkippedTerm()
    {
        $terms = [
            new Term([
                Term::FIELD__NAME => 'test',
                Term::FIELD__TITLE => 'failed'
            ]),
            new Term([
                Term::FIELD__NAME => 'test',
                Term::FIELD__TITLE => 'failed'
            ]),
        ];

        $desc = new TermCalculatorDescription([
            TermCalculatorDescription::FIELD__CLASS => ExampleCalculator::class
        ]);

        $calculated = [];

        /**
         * @var ITermCalculator $calculator
         */
        $calculator = $desc->buildClassWithParameters([]);

        $this->expectExceptionMessage('Skipped term "test" already exists');
        $result = $calculator->calculateTerms($terms);
    }
}
