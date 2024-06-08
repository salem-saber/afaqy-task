<?php

namespace Builders;

use App\Builders\ResponseBuilder;
use Tests\TestCase;

class ResponseBuilderTest extends TestCase
{

    public function testGetResponse()
    {
        $APIResponseBuilder = new ResponseBuilder();

        $APIResponseBuilder->setStatusCode(200);
        $APIResponseBuilder->setData(['data' => 'data']);
        $APIResponseBuilder->setErrors(['error' => 'error']);
        $APIResponseBuilder->setMessage('message');

        $this->assertEquals(200, $APIResponseBuilder->getStatusCode());
        $this->assertEquals(['data' => 'data'], $APIResponseBuilder->getData());
        $this->assertEquals(['error' => 'error'], $APIResponseBuilder->getErrors());
        $this->assertEquals('message', $APIResponseBuilder->getMessage());

    }
}
