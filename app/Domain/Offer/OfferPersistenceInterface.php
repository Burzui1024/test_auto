<?php

namespace App\Domain\Offer;

use App\Application\DTOs\Offer\OfferDTO;
use App\Application\UseCases\Offer\Exceptions\OfferBatchDTONotValid;

interface OfferPersistenceInterface
{
    /**
     * @param array<OfferDTO> $batch
     * @return bool
     * @throws OfferBatchDTONotValid
     */
    public function createOrUpdateBatch(array $batch): bool;

    /**
     * Удаляет записи которые которые не были обновлены или созданы.
     * Входящий параметр - массив внешних id.
     * @param array<OfferDTO> $batch
     * @return bool
     */
    public function deleteNotUpdatedRecordsBatch(array $batch): bool;
}
