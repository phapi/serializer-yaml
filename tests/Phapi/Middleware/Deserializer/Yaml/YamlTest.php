<?php

namespace Phapi\Tests\Middleware\Deserializer\Yaml;

use Phapi\Middleware\Deserializer\Yaml\Yaml;
use PHPUnit_Framework_TestCase as TestCase;

/**
* @coversDefaultClass \Phapi\Middleware\Deserializer\Yaml
*/
class YamlTest extends TestCase {

    public function testConstruct()
    {
        $deserializer = new Yaml();
        $input = "id: 12
name:
    firstName: Phapi
    lastName: Framework";
        $expected = [
            "id" => 12,
            "name" => [
                "firstName" => "Phapi",
                "lastName" => "Framework"
            ]
        ];

        $this->assertEquals($expected, $deserializer->deserialize($input));
    }

    public function testException()
    {
        $deserializer = new Yaml();
        $input = "id: 12
name:firstName: Phapi
    lastName: Framework";

        $this->setExpectedException('\Phapi\Exception\BadRequest', 'Could not deserialize body (Yaml)');
        $deserializer->deserialize($input);
    }
}
