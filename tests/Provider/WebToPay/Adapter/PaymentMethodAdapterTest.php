<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Tests\Provider\WebToPay\Adapter;

use Mockery as m;
use Paysera\CheckoutSdk\Provider\WebToPay\Adapter\PaymentMethodAdapter;
use Paysera\CheckoutSdk\Tests\AbstractCase;
use Paysera\CheckoutSdk\Util\Invader;
use WebToPay_PaymentMethod;

class PaymentMethodAdapterTest extends AbstractCase
{
    public function testConvert(): void
    {
        $providerData = [
            'key' => 'method test key',
            'defaultLanguage' => 'en',
            'logoList' => [
                'en' => 'http://en_logo.paysera.net',
                'lt' => 'http://lt_logo.paysera.net',
                'lv' => 'http://lv_logo.paysera.net',
            ],
            'titleTranslations' => [
                'en' => 'en title',
                'lt' => 'lt title',
                'lv' => 'lv title',
            ],
        ];

        $providerEntity = m::mock(WebToPay_PaymentMethod::class);
        $invaderMock = m::mock(Invader::class)
            ->expects()
            ->getProperties($providerEntity)
            ->andReturn($providerData)
            ->getMock();
        $this->container->set(Invader::class, $invaderMock);

        $adapter = $this->container->get(PaymentMethodAdapter::class);

        $paymentMethod = $adapter->convert($providerEntity);

        $this->assertEquals(
            $providerData['key'],
            $paymentMethod->getKey(),
            static::VALUE_MUST_BE_EQUAL_TO_PROVIDER_MESSAGE
        );
        $this->assertEquals(
            count($providerData['logoList']),
            $paymentMethod->getLogos()->count(),
            static::COUNT_MUST_BE_EQUAL_TO_PROVIDER_MESSAGE
        );
        $this->assertEquals(
            count($providerData['titleTranslations']),
            $paymentMethod->getTitleTranslations()->count(),
            static::COUNT_MUST_BE_EQUAL_TO_PROVIDER_MESSAGE
        );
    }
}
