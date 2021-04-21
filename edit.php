<?php 

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

$id;

if (isset($_GET['id_edit'])) {
	$id = $_GET['id_edit'];
}

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask($id); 
list($id, $tname, $tdetails, $tsubject, $tservis, $tpriority, $tdeadline, $tstatus) = $otask->getResult();



$form = "
<form action='index.php' method='POST'>
    <div class='form-row'>
        <div class='form-group col-md-2'>
            <label for='tname'>Plat Nomor</label>
            <input type='text' class='form-control' value='$tname' name='tname' required />
        </div>
    </div>

    

    <div class='form-row'>
        <div class='form-group col-md-2'>
            <label for='tdetail'>Detail Keluhan</label>
            <textarea class='form-control' name='tdetails' rows='3' required>$tdetails</textarea>
        </div>
    </div>" .

    
    "<div class='row'>
        <div class='form-group col-md-6'>
            <label for='tservis'>Pilihan Service</label>
            <div class='col-sm-10'>
                <div class='form-check form-check-inline'>" .
                    "<input class='form-check-input' type='radio' name='tservis' id='tservis1'" . ($tservis == 'Service Ringan' ? ' checked ':'') . "value='Service Ringan' />".
                    "<label class='form-check-label' for='tservis1'>Service Ringan</label>
                </div>
                <div class='form-check form-check-inline'> ".
                    "<input class='form-check-input' type='radio' name='tservis' id='tservis2' " . ($tservis == 'Service Berat' ? ' checked ':'') . " value='Service Berat' />".
                    "<label class='form-check-label' for='tservis2'>Service Berat</label>
                </div>
            </div>
        </div>        
    </div>".

    "<div class='row'>
        <div class='form-group col-md-6'>
            <label for='tsubject'>Jenis Transmisi</label>
            <div class='col-sm-10'>
                <div class='form-check form-check-inline'>" .
                    "<input class='form-check-input' type='radio' name='tsubject' id='tsubject1'" . ($tsubject == 'Matic' ? ' checked ':'') . "value='Matic' />".
                    "<label class='form-check-label' for='tsubject1'>Matic</label>
                </div>
                <div class='form-check form-check-inline'> ".
                    "<input class='form-check-input' type='radio' name='tsubject' id='tsubject2' " . ($tsubject == 'Manual' ? ' checked ':'') . " value='Manual' />".
                    "<label class='form-check-label' for='tsubject2'>Manual</label>
                </div>
            </div>
        </div>        
    </div>

    <div class='row'>
        <div class='form-group col-md-6'>
            <label for='tpriority'>Priority Layanan</label>
            <div class='col-sm-10'>
                <div class='form-check form-check-inline'>" .
                    " <input class='form-check-input' type='radio' name='tpriority' id='tpriority1' " . ($tpriority == 'Low' ? ' checked ':'') . " value='Low' />" .
                    "<label class='form-check-label' for='tpriority1'>Low</label>
                </div>
                <div class='form-check form-check-inline'>".
                    "<input class='form-check-input' type='radio' name='tpriority' id='tpriority2' " . ($tpriority == 'Medium' ? ' checked ':'') . " value='Medium' />".
                    " <label class='form-check-label' for='tpriority2'>Medium</label>
                </div>
                <div class='form-check form-check-inline'>" .
                    "<input class='form-check-input' type='radio' name='tpriority' id='tpriority3' " . ($tpriority == 'High' ? ' checked ':'') . " value='High' />".
                    "<label class='form-check-label' for='tpriority3'>High</label>
                </div>
            </div>
        </div>
    </div>

    <div class='form-row'>
        <div class='form-group col-md-2'>
            <label for='tdeadline'>Estimasi Waktu Selesai</label>
            <input class='form-control' type='date' name='tdeadline'  value='$tdeadline' name='tdeadline' required />
        </div>
    </div>

    <div class='row'>
        <div class='form-group col-md-6'>
            <label for='tstatus'>Status Service</label>
            <div class='col-sm-10'>
                <div class='form-check form-check-inline'>" .
                    "<select class='browser-default custom-select' name='tstatus'>
                        <option " . ($tstatus == 'Belum' ? ' selected ':'') . " name='tstatus' id='tstatus1' value='Belum'>Belum</option>
                        <option " . ($tstatus == 'Sudah' ? ' selected ':'') . " name='tstatus' id='tstatus2' value='Sudah'>Sudah</option>
                    </select>
                </div>
            <div/>
        <div/>
    </div>
    <br>
    <br>
    <input type='hidden' name='id' value='$id'>
    <button type='submit' name='edit' value='submit' class='btn btn-primary'>Edit data</button>
    <br>
    <br>
    <input  class='btn btn-danger' type='reset'>
    <br>
    <br>
</form>";


// Membaca template skin.html
$tpl = new Template("templates/skin_edit.html");

$tpl->replace("DATA_FORM", $form);

// Menampilkan ke layar
$tpl->write();


?>
