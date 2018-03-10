<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'box_type'                      => 'required|string',
            'title'                         => 'required|string',
            'slug'                          => 'required|string',
            'short_title'                   => 'nullable|string',
            'marketing_description'         => 'required|string',
            'calories_kcal'                 => 'numeric',
            'protein_grams'                 => 'numeric',
            'fat_grams'                     => 'numeric',
            'carbs_grams'                   => 'numeric',
            'bulletpoint1'                  => 'nullable|string',
            'bulletpoint2'                  => 'nullable|string',
            'bulletpoint3'                  => 'nullable|string',
            'recipe_diet_type_id'           => 'required|string',
            'season'                        => 'required|string',
            'base'                          => 'string',
            'protein_source'                => 'required|string',
            'preparation_time_minutes'      => 'required|numeric',
            'shelf_life_days'               => 'required|numeric',
            'equipment_needed'              => 'required|string',
            'origin_country'                => 'required|string',
            'recipe_cuisine'                => 'required|string',
            'in_your_box'                   => 'nullable|string',
            'gousto_reference'              => 'required|integer'
        ];
    }
}
