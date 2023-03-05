<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TicketUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticketupdate:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update ticket status if due date';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $tickets = DB::table('tickets')
            ->where('duedate', '<', now())
            ->get();

        foreach ($tickets as $ticket) {
            DB::table('tickets')
                ->where('id', $ticket->id)
                ->update(['status' => 0]);
        }

        echo 'TicketUpdate Running';
    }
}
