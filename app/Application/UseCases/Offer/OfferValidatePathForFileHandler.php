<?php
declare(strict_types=1);

namespace App\Application\UseCases\Offer;

use App\Application\UseCases\Offer\Exceptions\OfferXMLInvalidFileExtension;

class OfferValidatePathForFileHandler
{
    /**
     * Проверят есть ли файл по заданному пути и возвращает его путь, если нет возвращает путь файла поумолчанию
     * @param string|null $path_from_file
     * @return string
     * @throws OfferXMLInvalidFileExtension
     */
    public function make(?string $path_from_file): string
    {
        if (pathinfo($path_from_file, PATHINFO_EXTENSION) !== "xml") {
            throw new OfferXMLInvalidFileExtension("File extension must be xml");
        }
        if (file_exists($path_from_file)) {
            return $path_from_file;
        } else {
            return config('offer.offer_path_to_xml');
        }
    }
}
