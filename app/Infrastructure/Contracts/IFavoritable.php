<?php

namespace App\Infrastructure\Contracts;

interface IFavoritable
{
  public function getTitle(): string;
  public function getLink(): string;
  public function getImage(): string|null;
}
