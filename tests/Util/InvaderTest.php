<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Tests\Util;

use Paysera\CheckoutSdk\Tests\AbstractCase;
use Paysera\CheckoutSdk\Entity\Order;
use Paysera\CheckoutSdk\Util\Invader;

class InvaderTest extends AbstractCase
{
    public function testGetProperties(): void
    {
        $object = new Order(1, 1, 'test');
        $properties = $this->container->get(Invader::class)->getProperties($object);

        $this->assertEquals(
            [
                'orderId' => 1,
                'currency' => 'TEST',
                'amount' => 1,
                'payerFirstName' => null,
                'payerLastName' => null,
                'payerEmail' => null,
                'payerStreet' => null,
                'payerCity' => null,
                'payerState' => null,
                'payerZip' => null,
                'payerCountryCode' => null,
            ],
            $properties,
            'Stolen properties must be equal to the data set.'
        );
    }
}
