<?php

namespace ldeq\models;

use ldeq\api\Query;

Class SystemsModel{

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

	public function getAllSystems(){

		$GetSystems = (new Query())->Select('ldeq_systems', ['*']);

		return $GetSystems;

	}

	public function getSystem($id = null){
		if(!empty($id)){
            $System = (new Query())->select('ldeq_systems', ['*'], 'id=' . $id[1]);
            $Project[0]['system_password'] = $this->Encrypt_decrypt('decrypt', $System[0]['system_password']);

            return $System;
        }
	}

	public function addSystem(){

		if(isset($_POST['submit'])){

            $EncryptedSystemPass = $this->Encrypt_decrypt('encrypt', $_POST['systemPass']);

            $AddSystem = (new Query())->Insert(
                'ldeq_systems', 
                ['system_name', 'system_url', 'system_username', 'system_password'],  
                [$_POST['systemName'], $_POST['systemUrl'], $_POST['systemUser'], $EncryptedSystemPass]
            );

            header('Location: /ldeq/systems');

            return $AddSystem;
        }

	}

	public function updateSystem($id = null){

		  if(!empty($id)){
            if(isset($_POST['submit'])){

                $EncryptedSystemPass = $this->Encrypt_decrypt('encrypt', $_POST['systemPass']);

                $System = (new Query())->Update(
                    'ldeq_systems', 
                    ['system_name', 'system_url', 'system_username', 'system_password'], 
                    ['system_name', 'system_url', 'system_username', 'system_password'],  
                    [$_POST['systemName'], $_POST['systemUrl'], $_POST['systemUser'], $EncryptedSystemPass],
                    'id = ' . $id[1]
                );

                header('Location: /ldeq/systems/details' . $id[1]);

                return $System;
            }
      }
	}

	public function deleteSystem($id = null){

		if(!empty($id)){
            $Delete = (new Query)->Delete('ldeq_systems', $id[1]);

            header('Location: /ldeq/systems');

            return $Delete;
        }

	}

}