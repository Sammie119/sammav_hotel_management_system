<?php

namespace App\Http\Controllers;

use App\Models\ServicePrice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
