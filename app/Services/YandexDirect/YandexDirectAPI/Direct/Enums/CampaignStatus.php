<?php

namespace App\Services\Yandex\Direct\Enums;

enum CampaignStatus: string
{
    case ACCEPTED = 'ACCEPTED';
    case DRAFT = 'DRAFT';
    case MODERATION = 'MODERATION';
    case PREACCEPTED = 'PREACCEPTED';
    case REJECTED = 'REJECTED';
} 