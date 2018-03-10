<?php

namespace App\Validator;

class CuisineValidator
{

    /**
     *
     * @var mixed $cuisines an array of allowed cuisines
    */
    private $cuisines = [
        'british',
        'asian',
        'italian',
        'mediteranean',
        'mexican'
    ];

    /**
     *
     * @param  string $recipe_cuisine
     * @return boolean
     */
    public function validate($recipe_cuisine)
    {
        return in_array($recipe_cuisine, $this->cuisines);
    }
}
