<?php

namespace App\Repositories\Contracts;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
  public function getLines(): Collection;

  public function get($create = false): Cart|null;

  public function computeAmount();

  public function computeDiscount();

  public function hasCoupon(): bool;

  public function getCoupon(): Coupon|null;

  public function add($id, $type = "price"): void;

  public function remove($cartLineId, $isFull = false);

  public function getCount(): int;

  public function removeAll();

  public function getLinesByProducts($productId): array;


}
