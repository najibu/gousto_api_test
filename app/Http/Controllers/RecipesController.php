<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeStore;
use App\Http\Requests\RecipeUpdate;
use App\Http\Transformers\RecipeTransformer;
use App\Recipe;
use App\Validator\CuisineValidator;

class RecipesController extends ApiController
{
    /**
     * Display a listing of all recipes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::paginate(3);

        $array = fractal()
                    ->collection($recipes)
                    ->transformWith(new RecipeTransformer())
                    ->toArray();

        return $this->respondWithPagination($recipes, $array);
    }

    /**
     * Store a new recipe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeStore $request)
    {
        Recipe::create($request->all());

        return $this->respondCreated();
    }

    /**
     * Fetch a recipe by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        if (! $recipe) {
            return $this->responseNotFound('Recipe does not exist.');
        }

        $array = fractal()
                    ->item($recipe, new RecipeTransformer())
                    ->toArray();

        return $this->respond($array);
    }

    /**
     * Update an existing recipe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeUpdate $request, $id)
    {
        $recipe = Recipe::find($id);

        if (! $recipe) {
            return $this->responseNotFound('Recipe does not exist.');
        }

        $recipe->update($request->all());

        return $this->respondUpdated();
    }

    /**
     * Fetch all recipes for a specific cuisine
     * @param  string $cuisine
     * @param  Recipe $recipes
     * @return \Illuminate\Http\Response
     */
    public function fetchAllByCuisine($cuisine, Recipe $recipes)
    {
        $validator = new CuisineValidator;
        if ($validator->validate($cuisine)) {
            $recipes = $recipes->getByCuisine($cuisine);

            $array = fractal()
                    ->collection($recipes)
                    ->transformWith(new RecipeTransformer())
                    ->toArray();

            return $this->respondWithPagination($recipes, $array);
        }

        return $this->responseNotFound('Error: invalid cuisine');
    }
}
