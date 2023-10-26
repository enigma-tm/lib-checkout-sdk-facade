<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Entity\Collection;

use Paysera\CheckoutSdk\Entity\Translation;

/**
 * @template Translation
 * @extends Collection<Translation>
 *
 * @method TranslationCollection<Translation> filter(callable $filterFunction)
 * @method void append(Translation $value)
 * @method Translation|null get(int $index = null)
 */
class TranslationCollection extends Collection
{
    public function isCompatible(object $item): bool
    {
        return $item instanceof Translation;
    }

    public function getByLanguage(string $language): ?Translation
    {
        return $this->filter(static fn (Translation $translation) => $translation->getLanguage() === $language )->get();
    }

    public function current(): Translation
    {
        return parent::current();
    }

    protected function getItemType(): string
    {
        return Translation::class;
    }
}
