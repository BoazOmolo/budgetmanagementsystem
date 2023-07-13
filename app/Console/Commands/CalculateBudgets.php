<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Budget;


class CalculateBudgets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budgets:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and calculate budgets for the new month.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        // Get the budgets that haven't expired and haven't been processed for the current month
        $budgets = Budget::where('end_date', '>', Carbon::now())
            ->where(function ($query) use ($currentMonth, $currentYear) {
                $query->whereNull('processed_at')
                    ->orWhereYear('processed_at', '<', $currentYear)
                    ->orWhereMonth('processed_at', '<', $currentMonth);
            })
            ->get();

        foreach ($budgets as $budget) {
            // Update the processed_at field of the budget to mark it as processed for the current month
            $budget->processed_at = Carbon::now();
            $budget->save();
        }

        $this->info('Budgets checked for the new month.');
    }
}
