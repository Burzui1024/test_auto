<?php

declare(strict_types=1);

namespace App\Application\Services\Offer\XMLParse;

use App\Application\DTOs\Offer\OfferDTO;
use App\Application\Services\Offer\Interfaces\OfferParseInterface;
use App\Application\Services\Offer\XMLParse\Exceptions\OfferXMLFileHasAnIncorrectStructureOrIsEmpty;
use App\Application\UseCases\Offer\Exceptions\OfferXMLInvalidFileExtension;
use App\Application\UseCases\Offer\OfferValidatePathForFileHandler;
use App\Domain\Offer\OfferPersistenceInterface;
use SimpleXMLElement;

class OfferXMLParseImpl implements OfferParseInterface
{
    /**
     * @param OfferValidatePathForFileHandler $validatePathForFile
     */
    public function __construct(private readonly OfferValidatePathForFileHandler $validatePathForFile,
                                private readonly OfferPersistenceInterface       $offerPersistence)
    {
    }

    /**
     * @param string|null $path_from_file
     * @return void
     * @throws OfferXMLFileHasAnIncorrectStructureOrIsEmpty|OfferXMLInvalidFileExtension
     */
    public function execute(?string $path_from_file = null)
    {
        $this->offerPersistence->createOrUpdateBatch($this->parseXMLFile($this->validatePathForFile->make($path_from_file)));
    }

    /**
     * @param string $path_from_file
     * @return array<OfferDTO>
     * @throws OfferXMLFileHasAnIncorrectStructureOrIsEmpty
     */
    private function parseXMLFile(string $path_from_file): array
    {
        $xml_file = simplexml_load_file($path_from_file);
        $result = [];
        if (!isset($xml_file->offers->offer)) {
            throw new OfferXMLFileHasAnIncorrectStructureOrIsEmpty();
        }
        foreach ($xml_file->offers->offer as $offer) {
            $result [] = new OfferDTO(
                id: $this->validateElementDTO($offer->xpath('id')),
                mark: $this->validateElementDTO($offer->xpath('mark')),
                model: (string)$this->validateElementDTO($offer->xpath('model')),
                generation: $this->validateElementDTO($offer->xpath('generation')),
                year: $this->validateElementDTO($offer->xpath('year')),
                run: $this->validateElementDTO($offer->xpath('run')),
                color: $this->validateElementDTO($offer->xpath('color')),
                body_type: $this->validateElementDTO($offer->xpath('body-type')),
                engine_type: $this->validateElementDTO($offer->xpath('engine-type')),
                transmission: $this->validateElementDTO($offer->xpath('transmission')),
                gear_type: $this->validateElementDTO($offer->xpath('gear-type')),
                generation_id: $this->validateElementDTO($offer->xpath('generation_id')),
            );
        }
        return $result;
    }

    /**
     * @param array<SimpleXMLElement> $value
     * @return int|string|null
     */
    private function validateElementDTO(array $value): int|string|null
    {
        if (count($value)) {
            if ((string)$value[0] !== "" && !is_numeric((string)$value[0])) {
                return (string)$value[0];
            } elseif ((int)$value[0] !== 0) {
                return (int)$value[0];
            }
        }
        return null;

    }
}
