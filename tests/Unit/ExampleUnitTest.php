<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ExampleUnitTest extends TestCase
{
    // Apenas para a pasta tests/Unit não ficar vazia e ir para o repositório

    #[Test]
    public function basic_truth_test()
    {
        $this->assertTrue(true);
    }
}
