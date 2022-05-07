<?php


/*
	Classe responsável por verificar se os dados digitados na view login.html são compativeis com os dados cadastrados no banco de dados
*/


class Usuario{

	private $id_usuario;
	private $user;
	private $password;

	/*
		Método responsável por validar os dados user e password comparando com os quais estão no banco de dados
	*/

	public function validateLogin(){

		$user = $this->user;
		$password = $this->password;

		$con = Connection::getConn();
		$sql = "SELECT * FROM usuario WHERE user = :user";
		$res = $con->prepare($sql);
		$res->bindValue(':user',$user);
		$res->execute();

		if ($res->rowCount()) { //retorna a quantidade de registro
			
			$result = $res->fetch();
			if($result['password'] == $password){
				$_SESSION['USUARIO'] = array('id_usuario' => $result['user']);
				return true;
			}

		}
		throw new Exception("Login inválido!");
	}

	/*
		Métodos GET E SETTERS para que possamos manipular as variáveis os dados que são privates
	*/
		
	public function setuser($user){
		$this->user = $user;
	}
	public function setpassword($password){
		$this->password = $password;
	}
	public function getuser(){
		return $this->user;
	}
	public function getpassword(){
		return $this->password;
	}
}