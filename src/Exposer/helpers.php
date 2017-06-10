<?php

use Polass\Exposer\Exposer;

if (! function_exists('expose')) {
    /**
     * Renderer でレンダリングする
     *
     * @param string $renderer
     * @param mixed $parameters
     * @return mixed
     */
    function expose($class)
    {
        return new Exposer($class);
    }
}
