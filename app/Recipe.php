<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Recipe extends Model
{
    use Rateable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * getRecipesByCuisine
     * @param  string $cuisine
     * @return mixed
     */
    public function getByCuisine($cuisine)
    {
        return $this::where('recipe_cuisine', $cuisine)->paginate(5);
    }
}
