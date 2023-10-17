<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Entity;

use Paysera\CheckoutSdk\Entity\Collection\TranslationCollection;

class PaymentMethod extends AbstractPaymentMethod
{
    /**
     * Assigned key for this payment method.
     */
    protected string $key;

    /**
     * Logo collection of objects with urls.
     * Usually logo is same for all languages, but exceptions exist.
     */
    protected TranslationCollection $logos;

    public function __construct(
        string $key,
        string $defaultLanguage = self::DEFAULT_LANGUAGE
    ) {
        $this->key = $key;

        $this->logos = new TranslationCollection();
        $this->titleTranslations = new TranslationCollection();

        $this->setDefaultLanguage($defaultLanguage);
    }

    /**
     * Get assigned payment method key.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Returns collection of objects with country codes (country code ISO2) and logo urls.
     */
    public function getLogos(): TranslationCollection
    {
        return $this->logos;
    }

    /**
     * Gets logo url for this payment method. Uses specified language or default one.
     * If logotype is not found for specified language, null is returned.
     *
     * @param string|null $language [Optional] (country code ISO2)
     */
    public function getLogoUrl(string $language = null): ?string
    {
        return $this->translate($this->logos, $language, $this->defaultLanguage, null);
    }

    /**
     * Gets title for this payment method. Uses specified language or default one.
     *
     * @param string|null $language [Optional]
     */
    public function getTitle(string $language = null): string
    {
        return $this->translate($this->titleTranslations, $language, $this->defaultLanguage, $this->key);
    }
}
