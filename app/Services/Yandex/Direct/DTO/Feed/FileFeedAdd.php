<?php

namespace App\Services\Yandex\Direct\DTO\Feed;

class FileFeedAdd
{
    public function __construct(
        public readonly string $data,
        public readonly string $filename,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data: $data['Data'],
            filename: $data['Filename'],
        );
    }

    public function toArray(): array
    {
        return [
            'Data' => $this->data,
            'Filename' => $this->filename,
        ];
    }
} 