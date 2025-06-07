<?php

namespace App\Services\Yandex\Direct\Enums;

enum CampaignType: string
{
    case TEXT_CAMPAIGN = 'TEXT_CAMPAIGN';
    case MOBILE_APP_CAMPAIGN = 'MOBILE_APP_CAMPAIGN';
    case DYNAMIC_TEXT_CAMPAIGN = 'DYNAMIC_TEXT_CAMPAIGN';
    case CPM_BANNER_CAMPAIGN = 'CPM_BANNER_CAMPAIGN';
    case SMART_CAMPAIGN = 'SMART_CAMPAIGN';
} 