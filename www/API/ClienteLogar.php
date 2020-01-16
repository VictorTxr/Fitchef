<?php 
namespace FITCHEF\API;

use FITCHEF\DAO\DAOCliente;
use FITCHEF\model\Cliente;


class ClienteLogar{

    public $msg;

    function __construct($url){
     
        if($_POST['email']){

    
        
        try{
            //CRIAMOS UM OBJETO usuario
            $obj = new Cliente();
            $obj->setEmail($_POST['email']);
            $obj->setSenha($_POST['senha']);

            echo $obj->getEmail();
            echo $obj->getSenha();

           $DAO = new DAOCliente();
           $result = $DAO->buscaPorEmailSenha($obj);
           $this->verificaUrl($url);
           
           if($result){
            
                $_SESSION['clienteid'] = $result['pk_cliente'];
                $_SESSION['clientenome'] = $result['nome'];
                
                header("location:{$url}/cliente/painel");
           }else{
            
               $this->msg = "Cliente/Senha Inválidos";
           }
           

        }catch(\Exception $e){
            $this->msg = $e->getMessage();
        }
    }
}
            function verificaurl($url){ 

                if(isset($_SESSION['url'])){ 

                    $url2 = $_SESSION['url'];
                    //unset($_SESSION['url']);
                    header("location: ". $url2."/pagamento/finalizar");

                     }else{ 
                        // header("location: ".$url. "/painel/cliente");
            
        
                }
    }
    
}

    ?>