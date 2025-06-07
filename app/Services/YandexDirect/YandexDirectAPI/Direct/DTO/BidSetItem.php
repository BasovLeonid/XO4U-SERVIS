<?php

namespace App\Services\Yandex\Direct\DTO;

class BidSetItem
{
    public function __construct(
        public readonly int $keywordId,
        public readonly ?int $searchBid = null,
        public readonly ?int $networkBid = null,
        public readonly ?array $contextBid = null,
        public readonly ?array $strategyPriority = null,
        public readonly ?array $competitorsBids = null,
        public readonly ?array $searchPrices = null,
        public readonly ?array $contextCoverage = null,
        public readonly ?array $minSearchPrice = null,
        public readonly ?array $currentSearchPrice = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            keywordId: $data['KeywordId'],
            searchBid: $data['SearchBid'] ?? null,
            networkBid: $data['NetworkBid'] ?? null,
            contextBid: $data['ContextBid'] ?? null,
            strategyPriority: $data['StrategyPriority'] ?? null,
            competitorsBids: $data['CompetitorsBids'] ?? null,
            searchPrices: $data['SearchPrices'] ?? null,
            contextCoverage: $data['ContextCoverage'] ?? null,
            minSearchPrice: $data['MinSearchPrice'] ?? null,
            currentSearchPrice: $data['CurrentSearchPrice'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'KeywordId' => $this->keywordId,
            'SearchBid' => $this->searchBid,
            'NetworkBid' => $this->networkBid,
            'ContextBid' => $this->contextBid,
            'StrategyPriority' => $this->strategyPriority,
            'CompetitorsBids' => $this->competitorsBids,
            'SearchPrices' => $this->searchPrices,
            'ContextCoverage' => $this->contextCoverage,
            'MinSearchPrice' => $this->minSearchPrice,
            'CurrentSearchPrice' => $this->currentSearchPrice,
        ]);
    }
} 