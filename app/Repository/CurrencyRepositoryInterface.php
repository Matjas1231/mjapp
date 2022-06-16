<?php

namespace App\Repository;

interface CurrencyRepositoryInterface
{
    public function getAllFiltered(?string $phrase);
    public function downloadData();
    public function getlatest();
}
