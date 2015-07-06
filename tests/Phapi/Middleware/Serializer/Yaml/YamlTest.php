<?php

namespace Phapi\Tests\Middleware\Serializer\Yaml;

use Phapi\Middleware\Serializer\Yaml\Yaml;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @coversDefaultClass \Phapi\Middleware\Serializer\Yaml
 */
class YamlTest extends TestCase {

    public function testConstruct()
    {
        $serializer = new Yaml();
    
        $input = [
            "id" => 12,
            "name" => [
                "firstName" => "Phapi",
                "lastName" => "Framework"
            ]
        ];
        $expected = "id: 12
name:
    firstName: Phapi
    lastName: Framework
";
        $this->assertEquals($expected, $serializer->serialize($input));
    }

    public function testException()
    {
        $serializer = new Yaml();
        $this->setExpectedException('\Phapi\Exception\InternalServerError', 'Could not serialize content to Yaml');
        $input = [
            "id" => 12,
            "name" => [
                "firstName" => new \stdClass(),
                "lastName" => "Framework"
            ]
        ];

        $serializer->serialize($input);
    }

}
