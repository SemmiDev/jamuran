<?php

namespace App\Models;

class CurrencyHelper
{
  public static function formatRupiah($number)
  {
    return 'Rp. ' . number_format($number, 0, ',', '.');
  }
}
