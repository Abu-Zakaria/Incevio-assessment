<?php

namespace App\Repositories;

use App\Exceptions\BidDeadlineReachedException;
use App\Models\Bid;
use App\Models\Product;
use App\Services\BidderSessionService;
use Carbon\Carbon;

class UserProductRepository
{
    public function placeBid(Product $product, int $price): bool
    {
        $bigger_price_exists = $product->bids()->where('price', '>=', $price)->count();

        if ($bigger_price_exists) {
            return false;
        }

        if ($product->minimum_bidding_price >= $price) {
            return false;
        }

        $deadline = Carbon::createFromFormat("Y-m-d H:i:s", $product->deadline);
        $now = Carbon::now();

        if ($deadline->lessThanOrEqualTo($now)) {
            throw new BidDeadlineReachedException;
        }

        $bid = new Bid;

        $bid->product_id = $product->id;
        $bid->bidder_id = BidderSessionService::getBidder()->id;
        $bid->price = $price;

        return $bid->save();
    }
}
