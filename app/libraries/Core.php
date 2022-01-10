<?php
// 3_15


/*
* App Core Class
* Creates URL and loads core controller
* URL Format - /controllers/method/params
*/

CLass Core{

    protected $currentController = 'Pages';
    protected $currentMehtod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        require_once '../app/controllers/'.$this->currentController.'.php';

        if($url)
        {

            // look in controller for irst value

            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php'))
            {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
            }

            // require the controller
            

            // instantiate the controller 

            $this->currentController = new $this->currentController;

            // unset offset 0 from url
            unset($url[0]);

            // check for the second part of url
            if(isset($url[1]))
            {
                if(method_exists($this->currentController, $url[1]))
                {

                    $this->currentMehtod = $url[1];

                    // unset offset 1 from url
                    unset($url[1]);
                }   
            }


            // Get params
            $this->params = $url ? array_values($url) : [];
        }
        

        $controller = new $this->currentController;
        $controller->{$this->currentMehtod}($this->params);

        // call_user_func_array([$this->currentController, $this->currentMehtod], $this->params);
    }

    public function getUrl(){

        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url']);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
