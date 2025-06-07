<?php

namespace App\Services\Yandex\Direct\DTO;

class SitelinksSetAddItem
{
    public function __construct(
        public readonly array $sitelinks,
    ) {
        if (count($this->sitelinks) < 1 || count($this->sitelinks) > 8) {
            throw new \InvalidArgumentException('Sitelinks array must contain from 1 to 8 elements');
        }
    }

    public static function fromArray(array $data): self
    {
        $sitelinks = array_map(
            fn(array $item) => Sitelink::fromArray($item),
            $data['Sitelinks']
        );

        return new self(
            sitelinks: $sitelinks,
        );
    }

    public function toArray(): array
    {
        return [
            'Sitelinks' => array_map(
                fn(Sitelink $item) => $item->toArray(),
                $this->sitelinks
            ),
        ];
    }
} 