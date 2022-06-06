<?php


class View
{
    private $file;
    private $data;

    public function __construct($file, array $data = [])
    {
        $this->file = $file;
        $this->data = $data;
    }

    public function render()
    {
        extract($this->data);
        ob_start();
        require(__DIR__.'/../../resources/views/'.$this->file.'.php');
        $content = ob_get_contents();
	    ob_end_clean();

        echo $content;
    }
}