<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/localheinz/phpstan-rules
 */

namespace Localheinz\PHPStan\Rules\Test\Integration\Expressions;

use Localheinz\PHPStan\Rules\Expressions\NoEmptyRule;
use Localheinz\PHPStan\Rules\Test\Integration\AbstractTestCase;
use PHPStan\Rules\Rule;

/**
 * @internal
 *
 * @covers \Localheinz\PHPStan\Rules\Expressions\NoEmptyRule
 */
final class NoEmptyRuleTest extends AbstractTestCase
{
    public function providerAnalysisSucceeds(): iterable
    {
        $paths = [
            'empty-not-used' => __DIR__ . '/../../Fixture/Expressions/NoEmptyRule/Success/empty-not-used.php',
        ];

        foreach ($paths as $description => $path) {
            yield $description => [
                $path,
            ];
        }
    }

    public function providerAnalysisFails(): iterable
    {
        $paths = [
            'empty-used-with-correct-case' => [
                __DIR__ . '/../../Fixture/Expressions/NoEmptyRule/Failure/empty-used-with-correct-case.php',
                [
                    'Language construct empty() should not be used.',
                    7,
                ],
            ],
            'empty-used-with-incorrect-case' => [
                __DIR__ . '/../../Fixture/Expressions/NoEmptyRule/Failure/empty-used-with-incorrect-case.php',
                [
                    'Language construct empty() should not be used.',
                    7,
                ],
            ],
        ];

        foreach ($paths as $description => [$path, $error]) {
            yield $description => [
                $path,
                $error,
            ];
        }
    }

    protected function getRule(): Rule
    {
        return new NoEmptyRule();
    }
}