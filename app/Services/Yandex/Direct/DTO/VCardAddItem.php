<?php

namespace App\Services\Yandex\Direct\DTO;

class VCardAddItem
{
    public function __construct(
        public readonly string $campaignId,
        public readonly string $companyName,
        public readonly string $country,
        public readonly string $city,
        public readonly string $street,
        public readonly string $house,
        public readonly ?string $building = null,
        public readonly ?string $apartment = null,
        public readonly ?string $instantMessenger = null,
        public readonly ?string $extraMessage = null,
        public readonly ?string $contactEmail = null,
        public readonly ?string $contactPerson = null,
        public readonly ?string $metroStationId = null,
        public readonly ?string $pointOnMap = null,
        public readonly ?string $ogrn = null,
        public readonly ?string $workTime = null,
        public readonly ?array $phones = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            campaignId: $data['CampaignId'],
            companyName: $data['CompanyName'],
            country: $data['Country'],
            city: $data['City'],
            street: $data['Street'],
            house: $data['House'],
            building: $data['Building'] ?? null,
            apartment: $data['Apartment'] ?? null,
            instantMessenger: $data['InstantMessenger'] ?? null,
            extraMessage: $data['ExtraMessage'] ?? null,
            contactEmail: $data['ContactEmail'] ?? null,
            contactPerson: $data['ContactPerson'] ?? null,
            metroStationId: $data['MetroStationId'] ?? null,
            pointOnMap: $data['PointOnMap'] ?? null,
            ogrn: $data['Ogrn'] ?? null,
            workTime: $data['WorkTime'] ?? null,
            phones: $data['Phones'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'CampaignId' => $this->campaignId,
            'CompanyName' => $this->companyName,
            'Country' => $this->country,
            'City' => $this->city,
            'Street' => $this->street,
            'House' => $this->house,
            'Building' => $this->building,
            'Apartment' => $this->apartment,
            'InstantMessenger' => $this->instantMessenger,
            'ExtraMessage' => $this->extraMessage,
            'ContactEmail' => $this->contactEmail,
            'ContactPerson' => $this->contactPerson,
            'MetroStationId' => $this->metroStationId,
            'PointOnMap' => $this->pointOnMap,
            'Ogrn' => $this->ogrn,
            'WorkTime' => $this->workTime,
            'Phones' => $this->phones,
        ]);
    }
} 