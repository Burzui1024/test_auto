<?php

namespace App\Console\Commands;

use App\Application\Services\Offer\Interfaces\OfferParseInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class ParseOfferCommand extends Command
{
    protected $signature = 'parse:offer {--path=}';

    protected $description = 'Parse offer from source {--path=}';

    public function handle(OfferParseInterface $offerParse): void
    {
        $process = $this->output->createProgressBar();
        $process->setFormat('debug');
        $process->start();

        $io = new SymfonyStyle($this->input, $this->output);

        $offerParse->execute($this->option('path') ?? null);

        $io->success("Loading is success");

        $process->finish();

        echo PHP_EOL;
    }
}
