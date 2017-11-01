<?php 

Class LoginView{

        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function index()
        {
            echo '
            <form method="post" action="">
                <label>Gebruikernaam: <input type="text" name="username" /></label>
                <label>Wachtwoord: <input type="password" name="password" /></label>
                <input type="submit" name="submit" value="inloggen"/>
            </form>
            ';
            return $this->controller->index();
        }

}

// 