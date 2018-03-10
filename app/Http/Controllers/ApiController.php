<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    //const HTTP_NOT_FOUND = 404

    /**
     * $statusCode
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getstatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the statu code
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * responseNotFound
     * @param  string $message
     * @return [type]
     */
    public function responseNotFound($message = 'Not Found!')
    {
        return $this->setstatusCode(Response::HTTP_NOT_FOUND)->respondWithMessage($message);
    }

    /**
     * respondInternalError
     * @param  string $message
     * @return [type]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithMessage($message);
    }

    /**
     * respondCreated
     * @param  string $message
     * @return [type]
     */
    public function respondCreated($message = 'Recipe successfully created.')
    {
        return $this->setStatusCode(201)->respondWithMessage($message);
    }

    /**
     * respondUpdated
     * @param  string $message
     * @return [type]
     */
    public function respondUpdated($message = 'Recipe successfully updated.')
    {
        return $this->setStatusCode(200)->respondWithMessage($message);
    }

    /**
     * respondRated
     * @param  string $message
     * @return mixed
     */
    public function respondRated($message = 'Rate successfully added.')
    {
        return $this->setStatusCode(200)->respondWithMessage($message);
    }

    /**
     * [respondInvalidRequest
     * @param  string $message
     * @return mixed
     */
    public function respondInvalidRequest($message = 'Parameters failed validation for a recipe.')
    {
        return $this->setStatusCode(422)->respondWithMessage($message);
    }

    /**
     * respond
     * @param  array $data
     * @param  array  $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getstatusCode(), $headers);
    }

    /**
     * respondWithMessage
     * @param  [type] $message
     * @return array
     */
    public function respondWithMessage($message)
    {
        return $this->respond([
          'message' => $message,
          'status_code' => $this->getstatusCode()
      ]);
    }

    /**
     * respondWithPagination
     * @param  LengthAwarePaginator $recipes
     * @param  array                $data
     * @return array
     */
    protected function respondWithPagination(LengthAwarePaginator $recipes, array $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $recipes->total(),
                'total_pages' => ceil($recipes->total() / $recipes->perPage()),
                'current_page' => $recipes->currentPage(),
                'limit' => $recipes->perPage(),
            ]
       ]);

        return $this->respond($data);
    }
}
