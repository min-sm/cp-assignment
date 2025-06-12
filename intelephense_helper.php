<?php

namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
    /** @return static */
    public function layout($viewName = null);

    /** @return static */
    public function extends($view);

    /** @return static */
    public function title($title);

    /** @return static */
    public function section($section);
}
