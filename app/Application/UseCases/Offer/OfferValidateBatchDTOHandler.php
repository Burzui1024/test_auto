<?php
declare(strict_types=1);

namespace App\Application\UseCases\Offer;

use App\Application\DTOs\Offer\OfferDTO;
use App\Application\UseCases\Offer\Exceptions\OfferBatchDTONotValid;
use App\Application\UseCases\Offer\Exceptions\OfferXMLInvalidFileExtension;

class OfferValidateBatchDTOHandler
{

    /**
     * @param array $batch
     * @return bool
     * @throws OfferBatchDTONotValid
     */
    public function make(array $batch): bool
    {
        foreach ($batch as $item) {
            if (!($item instanceof OfferDTO)){
                throw new OfferBatchDTONotValid("Bad OfferDTO not valid");
            }
        }
        return true;
    }
}
