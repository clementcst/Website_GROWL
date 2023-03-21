<?php
    require_once("./constant.php");
    require_once(SESSION);
    require_once(MISC);
    require_once(DATABASE);
    require_once(M_FORMS);

    function is_mail($log){ // Fonction qui vérifie si le string contient un @ et est donc une adresse mail
        return stristr($log, '@');
    }

    function is_in_db(string $column, string $log, string $comp, string $table, string $data){ // Fonction qui regarde si une donnée est dans la base de donnée
        $filter = array( $column => array($comp, "'".$log."'", "0"));
        $result = db_selectColumns($table, [$data], $filter);
        return $result;
    }

    function verify_login(string $log, string $password, bool $connection_state) { // Fonction qui permet la connexion
        if(is_mail($log) === FALSE){
            $result_id = db_selectColumns('user', ['UserID'], ['Username' => ['=', "'".$log."'", "0"]]);
        }else{
            $result_id = db_selectColumns('user', ['UserID'], ['Mail' => ['=', "'".$log."'", "0"]]);
        }
        if(count($result_id) == 1){   // L'identifiant utilisé est présent dans la base de donnée
            $result_pwd = db_selectColumns('password', ['EncrPwd'], ['UserID' => ['LIKE', "'".$result_id[0][0]."'", "0"]]);
            if(password_verify($password ,$result_pwd[0][0])) {
                $connection_state = true;
                s_connect($result_id[0][0]);// Le mot de passe est le bon par rapport à l'identifiant
            } else {
                $_SESSION['errorMessageLogin']['passwordLog'] = "Le mot de passe ne correspond pas.";
            }
        } else {
            $_SESSION['errorMessageLogin']['log'] = "Cet identifiant n'existe pas.";
        }
        return $connection_state;        
    }


    if(isset($_POST["submitLogin"]))
    {
        $errorTrueInput = false;
        $tabDataForm = array();
        foreach($_POST as $key => $dataValue)
        {
            if($key !== "submitLogin")
            {
                $dataValueValid = valid_data($dataValue);

                if($dataValueValid !== $dataValue)
                {
                    $_SESSION['errorMessageLogin'] = "Les données envoyées par le formulaire ne sont pas conforment.";
                    $errorTrueInput = true;
                }
                else
                {   
                    $dataValueValid = trim($dataValueValid);
                    $tabDataForm[$key] = $dataValueValid;
                }
            }
        }

        if($errorTrueInput === false)
        {
            $connection_state = false;
            $_SESSION["conservedLogin"] = $tabDataForm['identifiant'];
            $connection_state = verify_login($tabDataForm['identifiant'], $tabDataForm['password_log'], $connection_state ); 
            if($connection_state === false)
                redirect(ROOT.ACCOUNT);
            else if($connection_state === true)
                redirect(ROOT.INDEX);
        } else
            redirect(ROOT.ACCOUNT);
    } else {
        $_SESSION['errorMessageLogin'] = "Veuillez envoyer le formulaire de connection.";
        redirect(ROOT.ACCOUNT);
    }

    
?>