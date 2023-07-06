<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Suscription;
use Carbon\Carbon;

class ReportSuscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:suscriptions {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns the reports of suscriptions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = $this->option('date');

        $date = $date ?? (Carbon::now())->format('Y-m-d');
        $from = $date . ' 00:00:00';
        $to = $date . ' 23:59:59';
        
        $suscriptionsDay = Suscription::whereBetween('created_at', [$from, $to])->get();

        $cancelledSuscriptionsDay = Suscription::whereBetween('cancelled_date', [$from, $to])
            ->where(['active' => false])
            ->get();

        $activeSuscriptionsDay = Suscription::whereBetween('created_at', [$from, $to])
        ->where(['active' => true])
        ->get();

        $return = 'Suscriptions Day Quantity: ' . count($suscriptionsDay) . "\n\r";
        $return .= 'Suscriptions Cancelled Day Quantity: ' . count($cancelledSuscriptionsDay) . "\n\r";
        $return .= 'Suscriptions Active Day Quantity: ' . count($activeSuscriptionsDay) . "\n\r";
        
        print_r($return);
    }
}
