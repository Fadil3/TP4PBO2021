<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();


if (isset($_POST['add'])) {
	$name_td = $_POST['tname'];
	$details_td  = $_POST['tdetails'];
	$subject_td	= $_POST['tsubject'];
	$priority_td = $_POST['tpriority'];
	$deadline_td = $_POST['tdeadline'];
  $service_td = $_POST['tservis'];
	$status = "Belum";

	//memanggil add
	$otask->add($name_td, $details_td, $subject_td, $priority_td, $deadline_td,$status,$service_td);
	
	// Unset POST
    unset($_POST['add']);
	
	header("location:index.php");
}

if (isset($_POST['edit'])) {
	$name_td = $_POST['tname'];
	$details_td  = $_POST['tdetails'];
	$subject_td	= $_POST['tsubject'];
	$priority_td = $_POST['tpriority'];
	$deadline_td = $_POST['tdeadline'];
	$status_td = $_POST['tstatus'];
  $service_td = $_POST['tservis'];
	$id = $_POST['id'];


	//memanggil add
	$otask->edit($name_td, $details_td, $subject_td, $priority_td, $deadline_td,$status_td,$id,$service_td);

   // Unset POST
    unset($_POST['edit']);

	header("location:index.php");
}

if (isset($_GET['id_hapus'])) {
	$id = $_GET['id_hapus'];
	echo($id);
	
	$otask->delete($id);

	// Unset GET
    unset($_GET['id_hapus']);
	header("location:index.php");
}

if (isset($_GET['id_status'])) {
	$id = $_GET['id_status'];
	// echo ($id);

	$otask->setStatus($id);

	unset($_GET['id_status']);

	header("location:index.php");
}




// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tservis, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
    <td>" . $tservis . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-warning'><a href='edit.php?id_edit=" . $id . "' style='color: white; font-weight: bold;'>Edit</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
    <td>" . $tservis . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai Servis</a></button>
		<button class='btn btn-warning'><a href='edit.php?id_edit=" . $id . "' style='color: white; font-weight: bold;'>Edit</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

$form = "
<form action='index.php' method='POST'>
      <div class='form-row'>
        <div class='form-group col-md-2'>
          <label for='tname'>Plat Motor</label>
          <input type='text' class='form-control' name='tname' required />
        </div>
      </div>

      

      <div class='form-row'>
        <div class='form-group col-md-2'>
          <label for='tdetail'>Detail Keluhan</label>
          <textarea class='form-control' name='tdetails' rows='3' required></textarea>
        </div>
      </div>

      <div class='row'>
        <div class='form-group col-md-6'>
          <label for='tservis'>Pilihan Servis</label>
          <div class='col-sm-10'>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tservis' id='tservis1' value='Service Ringan' />
              <label class='form-check-label' for='tservis1'>Service Ringan</label>
            </div>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tservis' id='tservis2' value='Service Berat' />
              <label class='form-check-label' for='tservis2'>Service Berat</label>
            </div>
          </div>
        </div>
      </div>

      <div class='row'>
        <div class='form-group col-md-6'>
          <label for='tsubject'>Jenis Transmisi</label>
          <div class='col-sm-10'>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tsubject' id='tsubject1' value='Matic' />
              <label class='form-check-label' for='tsubject1'>Matic</label>
            </div>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tsubject' id='tsubject2' value='Manual' />
              <label class='form-check-label' for='tsubject2'>Manual</label>
            </div>
          </div>
        </div>
      </div>

      <div class='row'>
        <div class='form-group col-md-6'>
          <label for='tpriority'>Priority Layanan</label>
          <div class='col-sm-10'>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tpriority' id='tpriority1' value='Low' />
              <label class='form-check-label' for='tpriority1'>Low</label>
            </div>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tpriority' id='tpriority2' value='Medium' />
              <label class='form-check-label' for='tpriority2'>Medium</label>
            </div>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='tpriority' id='tpriority3' value='High' />
              <label class='form-check-label' for='tpriority3'>High</label>
            </div>
          </div>
        </div>
      </div>

      <div class='form-row'>
        <div class='form-group col-md-2'>
          <label for='tdeadline'>Estimasi Waktu Selesai</label>
          <input class='form-control' type='date' name='tdeadline' name='tdeadline' required />
        </div>
      </div>

      <button type='submit' name='add' value='submit' class='btn btn-primary'>Add</button>
      <br>
      <br>
    <input  class='btn btn-danger' type='reset'>
</form>";


// Membaca template skin.html
$tpl = new Template("templates/skin.html");

$tpl->replace("DATA_FORM", $form);

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
