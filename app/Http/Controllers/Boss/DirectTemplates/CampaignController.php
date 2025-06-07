<?php

namespace App\Http\Controllers\Boss\DirectTemplates;

use App\Http\Controllers\Controller;
use App\Models\DirectTemplate;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function restrictions(DirectTemplate $template, Campaign $campaign)
    {
        return view('boss.direct-templates.campaigns.restrictions', compact('template', 'campaign'));
    }
} 