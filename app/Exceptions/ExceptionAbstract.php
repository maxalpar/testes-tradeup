<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\MessageBag;

abstract class ExceptionAbstract extends \DomainException
{
    /**
     * @var MessageBag
     */
    protected $errors;
    protected $statusCode;

    private $params;

    public function __construct($errors = null, $code = 0, Exception $previous = null)
    {
        $this->setError($errors);
        parent::__construct($this->errors->first(), $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function setError($errors)
    {
        if (is_string($errors)) {
            $errors = ['error' => $errors];
        }

        if (is_array($errors)) {
            $errors = new MessageBag($errors);
        }
        $this->errors = $errors;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

}
