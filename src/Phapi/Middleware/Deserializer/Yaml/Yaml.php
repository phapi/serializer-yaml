<?php

namespace Phapi\Middleware\Deserializer\Yaml;

use Phapi\Serializer\Deserializer;
use Phapi\Exception\BadRequest;

/**
 * Class Deserialize Yaml
 *
 * Middleware that deserializes a request with a YAML body.
 *
 * @category Phapi
 * @package  Phapi\Middleware\Deserializer\Yaml
 * @author   Peter Ahinko <peter@ahinko.se>
 * @license  MIT (http://opensource.org/licenses/MIT)
 * @link     https://github.com/phapi/serializer-yaml
 */
class Yaml extends Deserializer
{

    /**
     * Valid mime types
     *
     * @var array
     */
    protected $mimeTypes = [
        'application/x-yaml',
        'text/x-yaml',
        'text/yaml'
    ];

    /**
     * Deserialize the body
     *
     * @param $body
     * @return array
     * @throws BadRequest
     */
    public function deserialize($body)
    {
        try {
            $array = \Symfony\Component\Yaml\Yaml::parse($body);
        } catch (\Exception $e) {
            // Failed to parse/deserialize the body
            throw new BadRequest('Could not deserialize body (Yaml)');
        }
        return $array;
    }
}
