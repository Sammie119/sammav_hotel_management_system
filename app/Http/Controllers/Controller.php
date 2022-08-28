<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use App\Models\ServicePrice;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function servicePricing($service, $description, $setPrice)
    {
        $price = new ServicePrice;
        
        $price->service = $service;
        $price->description = $description;
        $price->price = $setPrice;

        $price->save();
    }

    protected function trackPriceChanges($service, $description, $price)
    {
        $history = new PriceHistory;
        $history->service = $service;
        $history->description = $description;
        $history->price = $price;
        $history->created_by = Auth()->user()->user_id;
        $history->save();
    }
}
