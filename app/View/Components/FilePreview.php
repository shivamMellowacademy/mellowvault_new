<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilePreview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $fileName, $filePath;
    public function __construct($fileName, $filePath)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-preview');
    }
}
