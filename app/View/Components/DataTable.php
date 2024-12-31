<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class DataTable extends Component
{
    public $headers;

    /**
     * Buat komponen dengan atribut tertentu.
     *
     * @param array $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        return view('components.data-table');
    }
}
