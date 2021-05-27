<?php

class View
{
    protected string $template;
    protected array $data;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function render() : void
    {
        if ( ! file_exists( 'Views/' . $this->template . '.php' ) )
            throw new Exception( "De template " . $this->template . " bestaat niet..." );

        extract($this->data);

        require_once ( $this->template . '.php');
    }
}

