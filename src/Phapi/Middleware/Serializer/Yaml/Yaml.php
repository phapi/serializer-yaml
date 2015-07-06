<?php

namespace Phapi\Middleware\Serializer\Yaml;

use Phapi\Exception\InternalServerError;
use Phapi\Serializer\Serializer;


/**
 * Class Yaml
 *
 * Middleware that serializes the response body to Yaml
 *
 * @category Phapi
 * @package  Phapi\Middleware\Serializer\Yaml
 * @author   Peter Ahinko <peter@ahinko.se>
 * @license  MIT (http://opensource.org/licenses/MIT)
 * @link     https://github.com/phapi/serializer-yaml
 */
class Yaml extends Serializer
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
     * Serialize body to Yaml
     *
     * @param array $unserializedBody
     * @return string
     * @throws InternalServerError
     */
    public function serialize(array $unserializedBody = [])
    {
        try {
            $yaml = \Symfony\Component\Yaml\Yaml::dump($unserializedBody, $inline = 2, $indent = 4, $exceptionOnInvalidType = true);
        } catch (\Exception $e) {
            throw new InternalServerError('Could not serialize content to Yaml');
        }
        
        return $yaml;
    }
}
