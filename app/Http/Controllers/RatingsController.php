<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingStore;
use App\Recipe;
use willvincent\Rateable\Rating;

class RatingsController extends ApiController
{
    /**
     * Store a new rate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, RatingStore $request)
    {
        $recipe = Recipe::find($id);

        if (! $recipe) {
            return $this->responseNotFound('Recipe does not exist.');
        }

        $rating = new Rating;
        $rating->rating = $request->rate;
        $rating->recipe_id = $id;

        $recipe->ratings()->save($rating);

        return $this->respondRated();
    }
}
