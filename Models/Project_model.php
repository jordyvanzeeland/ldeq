<?php

namespace ldeq\models;

use ldeq\api\Query;

Class ProjectModel{

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

	public function getAllProjects(){

		$GetProjects = (new Query)->Select('ldeq_projects', ['*']);

		return $GetProjects;

	}

	public function getProject($id = null){
		if(!empty($id)){
            $Project = (new Query)->select('ldeq_projects', ['*'], 'id=' . $id[1]);
            $Project[0]['FtpPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['FtpPass']);
            $Project[0]['DbPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['DbPass']);
            $Project[0]['WpPass'] = $this->Encrypt_decrypt('decrypt', $Project[0]['WpPass']);

            return $Project;
        }
	}

	public function addProject(){

		if(isset($_POST['submit'])){

            $EncryptedFtpPass = $this->Encrypt_decrypt('encrypt', $_POST['ftppass']);
            $EncryptedDbPass = $this->Encrypt_decrypt('encrypt', $_POST['dbpass']);
            $EncryptedWpPass = $this->Encrypt_decrypt('encrypt', $_POST['wppass']);

            $AddProject = (new Query)->Insert(
                'ldeq_projects', 
                ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'],  
                [$_POST['projectname'], $_POST['projecturl'], $_POST['ftphost'], $_POST['ftpuser'], $EncryptedFtpPass, $_POST['dbhost'], $_POST['dbuser'], $EncryptedDbPass, $_POST['wpuser'], $EncryptedWpPass]
            );

            header('Location: /ldeq/');

            return $AddProject;
        }

	}

	public function updateProject($id = null){

		  if(!empty($id)){
            if(isset($_POST['submit'])){

                $EncryptedFtpPass = $this->Encrypt_decrypt('encrypt', $_POST['ftppass']);
                $EncryptedDbPass = $this->Encrypt_decrypt('encrypt', $_POST['dbpass']);
                $EncryptedWpPass = $this->Encrypt_decrypt('encrypt', $_POST['wppass']);

                $Project = (new Query)->Update(
                    'ldeq_projects', 
                    ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'], 
                    [$_POST['projectname'], $_POST['projecturl'], $_POST['ftphost'], $_POST['ftpuser'], $EncryptedFtpPass, $_POST['dbhost'], $_POST['dbuser'], $EncryptedDbPass, $_POST['wpuser'], $EncryptedWpPass],
                    'id = ' . $id[1]
                );

                header('Location: /ldeq/project/details/' . $id[1]);

                return $Project;
            }
      }
	}

	public function deleteProject($id = null){

		if(!empty($id)){
            $Delete = (new Query)->Delete('ldeq_projects', $id[1]);

            header('Location: /ldeq/');

            return $Delete;
        }

	}

}