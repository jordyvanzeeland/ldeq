<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

Class ProjectenController{

    public function Encrypt_decrypt($action, $string) {
          $output = false;
          $encrypt_method = "AES-256-CBC";
          $secret_key = 'This is my secret key';
          $secret_iv = 'This is my secret iv';
          // hash
          $key = hash('sha256', $secret_key);
         
          // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
          $iv = substr(hash('sha256', $secret_iv), 0, 16);
          if ( $action == 'encrypt' ) {
              $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
              $output = base64_encode($output);
          } else if( $action == 'decrypt' ) {
              $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
          }
          return $output;
      }

    public function add(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

        if(isset($_POST['submit'])){

            $EncryptedFtpPass = $this->Encrypt_decrypt('encrypt', $_POST['ftppass']);
            $EncryptedDbPass = $this->Encrypt_decrypt('encrypt', $_POST['dbpass']);
            $EncryptedWpPass = $this->Encrypt_decrypt('encrypt', $_POST['wppass']);

            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $AddProject = $DbLogin->Insert(
                'ldeq_projects', 
                ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'],  
                [$_POST['projectname'], $_POST['projecturl'], $_POST['ftphost'], $_POST['ftpuser'], $EncryptedFtpPass, $_POST['dbhost'], $_POST['dbuser'], $EncryptedDbPass, $_POST['wpuser'], $EncryptedWpPass]
            );

            header('Location: /ldeq/');

            return $AddProject;
        }

    }

    public function project($id = null){
        if(!empty($id)){
            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $Project = $DbLogin->select('ldeq_projects', ['*'], 'id=' . $id[0]);
            $Project[0]['FtpPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['FtpPass']);
            $Project[0]['DbPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['DbPass']);
            $Project[0]['WpPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['WpPass']);

            return $Project;
        }
    }

    public function edit($id = null){
        if(!empty($id)){
            if(isset($_POST['submit'])){

                $EncryptedFtpPass = $this->Encrypt_decrypt('encrypt', $_POST['ftppass']);
                $EncryptedDbPass = $this->Encrypt_decrypt('encrypt', $_POST['dbpass']);
                $EncryptedWpPass = $this->Encrypt_decrypt('encrypt', $_POST['wppass']);

                $DbLogin = new Query;
                $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
                $Project = $DbLogin->Update(
                    'ldeq_projects', 
                    ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'], 
                    [$_POST['projectname'], $_POST['projecturl'], $_POST['ftphost'], $_POST['ftpuser'], $EncryptedFtpPass, $_POST['dbhost'], $_POST['dbuser'], $EncryptedDbPass, $_POST['wpuser'], $EncryptedWpPass],
                    'id = ' . $id[0]
                );

                header('Location: /ldeq/projecten/project/' . $id[0]);

                return $Project;
            }
        }
    }

    public function Delete($id){
        if(!empty($id)){
            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $Delete = $DbLogin->Delete('ldeq_projects', $id[0]);

            header('Location: /ldeq/');

            return $Delete;
        }
    }

}