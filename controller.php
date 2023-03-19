<?php
class crud{
    protected $kon;
    public function __construct()
    {
        $koneksi=$this->kon=new mysqli('localhost','root','','crud');
        if($koneksi->connect_errno){
            echo "koneksi gagal";
            exit();
        }
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama VARCHAR(100))";
        $koneksi->query($sql);
    }

    public function getAll(){
        $q="select * from users";
        $data=$this->kon->query($q);
        return $data;
    }

    public function store($data){
        $nama=$data['nama'];
        $q="insert into users (nama) values (?)";
        $stmt=$this->kon->prepare($q);
        $stmt->bind_param("s",$nama);
        $store=$stmt->execute();
        return $store;
    }

    public function edit($id){
        $q="select * from users where id=?";
        $stmt=$this->kon->prepare($q);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $data=$stmt->get_result();
        return $data;
    }

    public function update($data){
        $id=$data['id'];
        $nama=$data['nama'];
        $q="update users set nama=? where id=?";
        $stmt=$this->kon->prepare($q);
        $stmt->bind_param("ss",$nama,$id);
        $update=$stmt->execute();
        return $update;
    }

    public function delete($id){
        $q="delete from users where id=?";
        $stmt=$this->kon->prepare($q);
        $stmt->bind_param("s",$id);
        $delete=$stmt->execute();
        return $delete;
    }

}
?>