<?php

namespace App\Common\Exceptions;

use JsonApiPhp\JsonApi\Error;
use Symfony\Component\HttpFoundation\Response;
use Tobyz\JsonApiServer\ErrorProviderInterface;

final class CustomException extends \Exception implements ErrorProviderInterface
{
    private $status;

    public function __construct(string $message, string $status = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($message);
        $this->status = $status;
    }

    public function getJsonApiErrors(): array
    {
        return [
            new Error(
                new Error\Title($this->message),
                new Error\Status($this->status)
            ),
        ];
    }

    public function getJsonApiStatus(): string
    {
        return $this->status;
    }
}
