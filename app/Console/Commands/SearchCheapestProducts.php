<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\PharmacyProductService;
use Illuminate\Console\Command;

class SearchCheapestProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:cheapest {id} {--limit=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search for cheapest price in all pharmacies for a given product id';

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
     * @return int
     */
    public function handle(PharmacyProductService $pharmacyProductService)
    {
        $limit = $this->option('limit');
        
        $this->line("Searching for the most $limit cheapest prices...");
        
        $products = $pharmacyProductService->cheapest($this->argument('id'), $limit);

        return $products->count() === 0 ? $this->error('Product not found') : $this->info($products->toJson());
    }
}
