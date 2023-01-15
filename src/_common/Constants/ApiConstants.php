<?php

namespace App\Common\Constants;

final class ApiConstants
{
    private const SINGULAR_API_TYPES = [
        'example' => 'examples',
    ];

    private const JSON_API_MEDIA_TYPE = 'application/vnd.api+json';

    public static function getSingularApiTypes(): array
    {
        return self::SINGULAR_API_TYPES;
    }

    public static function getJsonApiMediaType(): string
    {
        return self::JSON_API_MEDIA_TYPE;
    }
}
