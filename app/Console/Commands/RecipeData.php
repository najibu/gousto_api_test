<?php

namespace App\Console\Commands;

use App\Recipe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class RecipeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipe:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database using recipe-data CSV file';

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
        $csv = Reader::createFromString(Storage::disk('csv')->get('recipe-data.csv'));
        $recipes = $csv->fetchAssoc();

        foreach ($recipes as $offset => $recipe) {
            // var_export($recipe);
            Recipe::unguard();
            if (isset($recipe['created_at'])) {
                unset($recipe['created_at']);
            }

            if (isset($recipe['updated_at'])) {
                unset($recipe['updated_at']);
            }

            Recipe::create($recipe);
        }
    }
}
