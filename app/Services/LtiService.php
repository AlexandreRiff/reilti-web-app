<?php

namespace App\Services;

use App\Models\Resource;
use Illuminate\Support\Facades\Http;

class LtiService
{
    private static $ltiaasUrl;
    private static $ltiaasKey;

    public function __construct()
    {
        self::$ltiaasUrl = config('lti.ltiaas.url');
        self::$ltiaasKey = config('lti.ltiaas.key');
    }

    public function deeplinkForm(Resource $resource, string $ltik)
    {
        $contentItems = [
            'type' => 'ltiResourceLink',
            'url' => self::$ltiaasUrl . "/lti/launch/?resource={$resource->id}",
            'title' => $resource->title,
        ];

        $token = self::$ltiaasKey . ":" . $ltik;

        $response = Http::withOptions([
            'verify' => false,
        ])
            ->withToken($token, 'LTIK-AUTH-V2')
            ->post(self::$ltiaasUrl . '/api/deeplinking/form', ['contentItems' => [$contentItems]]);

        return $response->object()->form;
    }
}
