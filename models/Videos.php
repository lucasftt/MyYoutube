<?php 
class Videos extends Model
{
	public function getVideo($id){
		$sql = $this->db->prepare("select * from videos where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		if ($sql->rowCount() == 0) {
			throw new Exception("Video not found", 1);
		}
		return $sql->fetch();
	}
	
	public function add($id_usuario,$id_categoria, $url, $titulo, $descricao){
		$sql = "insert into videos
		 set id_usuario = :id_usuario, id_categoria = :id_categoria, url = :url, 
		 titulo = :titulo, descricao = :descricao";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->bindValue(":id_categoria", $id_categoria);
		$sql->bindValue(":url", $url);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":descricao", $descricao);

		$sql->execute();
	}

	public function editar($id, $id_usuario,$id_categoria, $titulo, $descricao){
		$sql = "update videos
		 set id_categoria = :id_categoria, titulo = :titulo, descricao = :descricao
		  where id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_categoria", $id_categoria);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":descricao", $descricao);

		$sql->execute();
	}

	public function excluir($id){
		$sql = $this->db->prepare("delete from videos where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function getVideosByUserId($id_usuario){
		$sql = $this->db->prepare("select * from videos where id_usuario = :id_usuario");
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();
		return $sql->fetchAll();
	}

	public function getUserId($id){
		$sql = $this->db->prepare("select Id_Usuario from videos where id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		if ($sql->rowCount() == 0) {
			throw new Exception("Video não encontrado", 1);
			
		}
		return $sql->fetch()["Id_Usuario"];
	}
}

?>