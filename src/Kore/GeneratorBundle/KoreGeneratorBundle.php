<?php

namespace Kore\GeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KoreGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'SensioGeneratorBundle';
    }
}
