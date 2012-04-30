<?php
namespace ApplicationTest;

class SampleTest extends Framework\TestCase
{

    public function testSample()
    {
        $this->assertInstanceOf('\Zend\Di\Locator', $this->getLocator());
    }
}
