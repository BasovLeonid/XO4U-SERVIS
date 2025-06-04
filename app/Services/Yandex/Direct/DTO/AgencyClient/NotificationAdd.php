<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class NotificationAdd
{
    public function __construct(
        public readonly string $lang,
        public readonly string $email,
        public readonly array $emailSubscriptions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            lang: $data['Lang'],
            email: $data['Email'],
            emailSubscriptions: array_map(
                fn(array $item) => EmailSubscriptionItem::fromArray($item),
                $data['EmailSubscriptions']
            ),
        );
    }

    public function toArray(): array
    {
        return [
            'Lang' => $this->lang,
            'Email' => $this->email,
            'EmailSubscriptions' => array_map(
                fn(EmailSubscriptionItem $item) => $item->toArray(),
                $this->emailSubscriptions
            ),
        ];
    }
} 