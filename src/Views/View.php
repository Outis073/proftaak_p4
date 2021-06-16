<?php
//  namespace Vitae\Views;
//require_once 'vendor/autoload.php';

class View
{
    protected string $template;
    protected array $data;

    public function __construct($template)
    {
        $template = ucfirst($template);
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

    public function render(): void
    {
        if (!file_exists('src/Views/' . $this->template . '.php'))
            throw new Exception("De template " . $this->template . " bestaat niet...");

        extract($this->data);

        require_once('languages/' . $_SESSION['lang'] . '.php');

        require_once($this->template . '.php');
    }
}
