<?php

namespace App\Console\Commands;

use App\Models\Product;
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
    public function handle()
    {
        $limit = $this->option('limit');
        
        $this->line("Searching for the most $limit cheapest prices...");
        
        $product = Product::select(['id', 'title'])
            ->where('id', $this->argument('id'))
            ->with(['pharmacies' => function($q) use($limit) {
                $q->select('price')->orderby('price', 'asc')->limit($limit);
            }])
            ->get();

        return $product->count() === 0 ? $this->error('Product not found') : $this->info($this->formatJson($product));
    }

    protected function formatJson($product)
    {
        return $product->map(function($p) {
            return [
                'id'        => $p->id,
                'title'     => $p->title,
                'prices'    => $p->pharmacies->map(function($pivot) { return $pivot->price; })
            ];
        })->toJson();
    }
}
