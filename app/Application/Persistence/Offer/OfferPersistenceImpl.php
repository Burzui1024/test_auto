<?php

namespace App\Application\Persistence\Offer;

use App\Application\Exceptions\ArrayDoesNotConsistOfIntegersException;
use App\Application\Persistence\Exceptions\DBErrorException;
use App\Application\UseCases\CheckingArrayForIntegerHandle;
use App\Application\UseCases\GetIDFromModelHandler;
use App\Application\UseCases\Offer\Exceptions\OfferBatchDTONotValid;
use App\Application\UseCases\Offer\OfferValidateBatchDTOHandler;
use App\Domain\Offer\OfferPersistenceInterface;
use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarColor;
use App\Models\CarEngineType;
use App\Models\CarGearType;
use App\Models\CarGeneration;
use App\Models\CarModel;
use App\Models\CarTransmissionType;
use App\Models\Offer;
use DB;
use Exception;

class OfferPersistenceImpl implements OfferPersistenceInterface
{
    public function __construct(private readonly OfferValidateBatchDTOHandler $validateBatchDTO,
                                private readonly GetIDFromModelHandler        $getIDFromModelHandler,
                                private readonly CheckingArrayForIntegerHandle $checkingArrayForIntegerHandle)
    {
    }

    /**
     * @throws OfferBatchDTONotValid
     * @throws DBErrorException
     */
    public function createOrUpdateBatch(array $batch): bool
    {
        $this->validateBatchDTO->make($batch);
        $insert_external_ids = [];
        try {
            DB::beginTransaction();
            $insert_batch = [];
            foreach ($batch as $offer) {
                $brand = CarBrand::firstOrCreate(['name' => $offer->getMark()]);
                $model = CarModel::firstOrCreate(['model' => $offer->getModel(), 'car_brand_id' => $brand->id]);
                $generation = null;
                if (!is_null($offer->getGeneration())) {
                    $generation = CarGeneration::firstOrCreate(
                        ['generation' => $offer->getGeneration(),
                            'car_brand_id' => $brand->id,
                            'car_model_id' => $model->id
                        ]);
                }
                $color = null;
                if (!is_null($offer->getColor())) {
                    $color = CarColor::firstOrCreate(['name' => $offer->getColor()]);
                }
                $body_type = null;
                if (!is_null($offer->getBodyType())) {
                    $body_type = CarBodyType::firstOrCreate(['type' => $offer->getBodyType()]);
                }
                $engine_type = null;
                if (!is_null($offer->getEngineType())) {
                    $engine_type = CarEngineType::firstOrCreate(['type' => $offer->getEngineType()]);
                }
                $transmission = CarTransmissionType::firstOrCreate(['type' => $offer->getTransmission()]);
                $gear_type = null;
                if (!is_null($offer->getGearType())) {
                    $gear_type = CarGearType::firstOrCreate(['type' => $offer->getGearType()]);
                }
                $insert_external_ids [] = $offer->getId();
                $insert_batch [] = [
                    'external_id' => $offer->getId(),
                    'car_brand_id' => $this->getIDFromModelHandler->make($brand),
                    'car_model_id' => $this->getIDFromModelHandler->make($model),
                    'car_generation_id' => $this->getIDFromModelHandler->make($generation),
                    'year' => $offer->getYear(),
                    'run' => $offer->getRun(),
                    'car_color_id' => $this->getIDFromModelHandler->make($color),
                    'car_body_type_id' => $this->getIDFromModelHandler->make($body_type),
                    'car_engine_type_id' => $this->getIDFromModelHandler->make($engine_type),
                    'car_transmission_type_id' => $this->getIDFromModelHandler->make($transmission),
                    'car_gear_type_id' => $this->getIDFromModelHandler->make($gear_type),
                    'external_generation_id' => $offer->getGenerationId()
                ];
                if (count($insert_batch) % config('offer.batch_size_for_createOrUpdateBatch') === 0) {
                    Offer::upsert($insert_batch, ['external_id']);
                    $insert_batch = [];
                }
            }
            if (count($insert_batch)) {
                Offer::upsert($insert_batch, ['external_id']);
            }
            if (count($insert_external_ids)) {
                $this->deleteNotUpdatedRecordsBatch($insert_external_ids);
            }

        } catch (Exception $exception) {
            DB::rollBack();
            throw new DBErrorException("Database error");
        }
        DB::commit();
        return true;
        // TODO: Implement createOrUpdateBatch() method.
    }

    /**
     * Удаление не обновленных записей.
     * Входящий параметр - массив внешних id.
     * @param array $batch
     * @return bool
     * @throws ArrayDoesNotConsistOfIntegersException
     */
    public function deleteNotUpdatedRecordsBatch(array $batch): bool
    {
        // TODO: Implement deleteBatch() method.
        if (!$this->checkingArrayForIntegerHandle->make($batch)){
            throw new ArrayDoesNotConsistOfIntegersException();
        }
        if (Offer::whereNotIn('external_id', $batch)->exists()) {
            return true;
        }
        return false;
    }
}
