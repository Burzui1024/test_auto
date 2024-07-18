<?php

namespace App\Providers;

use App\Application\Persistence\Offer\OfferPersistenceImpl;
use App\Application\Services\Offer\Interfaces\OfferParseInterface;
use App\Application\Services\Offer\XMLParse\OfferXMLParseImpl;
use App\Application\UseCases\CheckingArrayForIntegerHandle;
use App\Application\UseCases\GetIDFromModelHandler;
use App\Application\UseCases\Offer\OfferValidateBatchDTOHandler;
use App\Application\UseCases\Offer\OfferValidatePathForFileHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(OfferParseInterface::class, function () {
            return new OfferXMLParseImpl(
                new OfferValidatePathForFileHandler(),
                new OfferPersistenceImpl(
                    new OfferValidateBatchDTOHandler(),
                    new GetIDFromModelHandler(),
                    new CheckingArrayForIntegerHandle()
                )
            );
        });
    }
}
