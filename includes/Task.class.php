<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask($id=-1){

		if ($id == -1) {
			// Query mysql select data ke tb_to_do
			$query = "SELECT * FROM tb_to_do";
			# code...
		}
		else {
			$query = "SELECT * FROM tb_to_do WHERE id = '$id'";
		}

		// Mengeksekusi query
		return $this->execute($query);
	}

	// add data
	function add($name_td,$details_td,$subject_td,$priority_td,$deadline_td,$status_td ="Belum",$service_td)
	{
		// Query mysql select data ke tb_to_do
		$query = "INSERT INTO tb_to_do  (`name_td`, `details_td`, `subject_td`, `priority_td`, `deadline_td`, `status_td`,`servis_td`)  VALUES ('$name_td','$details_td','$subject_td','$priority_td','$deadline_td','$status_td','$service_td')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// edit data
	function edit($name_td,$details_td,$subject_td,$priority_td,$deadline_td,$status_td,$id,$service_td)
	{
		// Query mysql select data ke tb_to_do
		$query = "UPDATE  `tb_to_do` SET 
		`name_td` = '$name_td', 
		`details_td` = '$details_td', 
		`subject_td` = '$subject_td',
		`priority_td` = '$priority_td', 
		`deadline_td` = '$deadline_td',
		`status_td` = '$status_td',
		`servis_td` = '$service_td'
		WHERE id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function delete($id){
		$query = "DELETE FROM `tb_to_do` WHERE id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function setStatus($id){
		
		$query = "UPDATE `tb_to_do` SET status_td='Sudah' WHERE id=$id";
		// Mengeksekusi query
		return $this->execute($query);
	}
	

}



?>
