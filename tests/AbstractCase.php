<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Tests;

use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

abstract class AbstractCase extends MockeryTestCase
{
    protected const VALUE_MUST_BE_EQUAL_TO_PROVIDER_MESSAGE =
        'The property value must be equal to the provider data value.';
    protected const COUNT_MUST_BE_EQUAL_TO_PROVIDER_MESSAGE =
        'The property items count must be equal to the provider data items count.';

    protected $preserveGlobalState = false;

    protected $runTestInSeparateProcess = true;

    public function mockeryTestTearDown(): void
    {
        parent::mockeryTestTearDown();

        m::close();
    }
}

