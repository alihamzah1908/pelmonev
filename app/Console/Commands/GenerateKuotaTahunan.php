<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PublicTrxKuotaProposal;

class GenerateKuotaTahunan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:kuota';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {

            PublicTrxKuotaProposal::createKuota();

            $this->info('The process has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error($exception);
        }
    }
}
