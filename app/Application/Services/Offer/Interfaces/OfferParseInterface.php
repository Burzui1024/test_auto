<?php

namespace App\Application\Services\Offer\Interfaces;

interface OfferParseInterface
{
    public function execute(?string $path_from_file = null);
}
