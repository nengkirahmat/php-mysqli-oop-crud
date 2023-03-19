<?php
require_once("controller.php");
$db=new crud();

if(isset($_POST['save'])){
    $data['nama']=$_POST['nama'];
    $store=$db->store($data);
    if($store){
        header('location:index.php');
    }
}

if(isset($_GET['hapus'])){
    $delete=$db->delete($_GET['hapus']);
    if($delete){
        header('location:index.php');
    }
}

if(isset($_POST['update'])){
    $data['id']=$_POST['id'];
    $data['nama']=$_POST['nama'];
    $update=$db->update($data);
    if($update){
        header('location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Mysql OOP</title>
    <style>
        #main{
            margin: auto;
            width: 350px;
        }
    </style>
</head>
<body>
    <div id="main">
    <a href="/mysqli-oop-crud/index.php">Home</a>
    <a href="/mysqli-oop-crud/index.php?create">Add New</a>
    <hr>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td width="30px">No</td>
            <td>Nama</td>
            <td>Aksi</td>
        </tr>
    <?php
    $data=$db->getAll();
    $n=1;
    while($d=$data->fetch_object()){
        echo "<tr><td>".$n."</td><td>".$d->nama."</td><td><a href='?id=".$d->id."'>Edit</a> <a href='?hapus=".$d->id."'>Hapus</a></td></td>";
    $n++;
    }
    ?>
    </table>

    <br>
    <?php
    if(isset($_GET['create'])){
    ?>
    <form action="#" method="post">
        <input type="text" name="nama">
        <input type="submit" name="save" value="Simpan">
    </form>
    <?php
    }

    if(isset($_GET['id'])){
        $edit=$db->edit($_GET['id']);
        $d=$edit->fetch_assoc();
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
        <input type="text" name="nama" value="<?php echo $d['nama']; ?>">
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    }
    ?>
    </div>
</body>
</html>