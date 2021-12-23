<?php

namespace App\Console\Commands\Integration\Sap;

use Illuminate\Console\Command;

use App\Models\System\Integration;

use Facades\App\Libraries\Integration\SapB1;

class SyncTransferRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octo:integration-sap-sync-transferrequests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync transfer requests with SAP B1';

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
        $integrations = Integration::withoutGlobalScopes()->where('integration', 'sapb1')->get();

        foreach ($integrations as $integration) {
            SapB1::syncTransferRequests($integration->oid);

            SapB1::logout($integration->oid);
        }
    }
}
