<?php
require_once "config.php";
$mysqli = new mysqli("localhost","root","","db_em");
//check connection
if($mysqli===false){
    die("ERROR.".$mysqli->connect_error);
    

}
    //$tanggalIn = $_POST['tanggal'];
    // $newDate = new DateTime($date);
    // $newDate ->modify('+3 day');
    // $dateee->modify('+3 day');
    // echo $dateee;
//Escapes user input
$id=0;
$nama=htmlspecialchars($mysqli->real_escape_string($_REQUEST['nama']));
$kementerian=htmlspecialchars($mysqli->real_escape_string($_REQUEST['kementerian']));
$jenis = htmlspecialchars($mysqli->real_escape_string($_REQUEST['jenis']));
$jam= htmlspecialchars($mysqli->real_escape_string($_REQUEST['jam']));
$tanggal=htmlspecialchars($mysqli->real_escape_string($_POST['tanggal']));
$cp=htmlspecialchars($mysqli->real_escape_string($_REQUEST['cp']));
$caption=htmlspecialchars($mysqli->real_escape_string($_REQUEST['caption']));
$timestampTanggal = strtotime($tanggal);


//Attempts
$sql = "INSERT INTO jadwal_publikasi(id,nama,kementerian,jenis,jam,tanggal,cp,caption,waktu) VALUES ('$id','$nama','$kementerian','$jenis','$jam','$tanggal','$cp', '$caption','$waktu')";
$cek_sql = "SELECT * FROM jadwal_publikasi WHERE tanggal like '%".$tanggal."%'";
$result = mysqli_query($link, $cek_sql);
    $jumlah_rows = mysqli_num_rows($result);
// $timestampTanggal = strtotime($tanggal);


// $datePoster = date("d-m-Y",$sopPoster);
// $dateVideo = date("d-m-Y", $sopVideo)
if($jenis==="Poster"){
    //$dayofPoster = rand(3,30);
    $tanggalPilihan = strtotime($tanggal);
    $sopPoster=strtotime("+2 day");
    if($sopPoster < $tanggalPilihan){
        if($jumlah_rows<4){
            if($mysqli->query($sql)===true){
           
                echo "
                    <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'admin.php?halaman=1';
                    </script>    
                    ";
                
            }else{
                echo "
                    <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'admin.php?halaman=1';
                    </script>    
                ";
            }
        
        }else{
            echo "
                <script>
                alert('Ups kuota postingan untuk tanggal yang dipilih telah penuh, silahkan coba hari lain atau  hubungi Puskom!');
                document.location.href = 'admin.php?halaman=1';
                </script>    
            ";
        }
    }else{
        // echo $dayofPoster."<br>";
        echo $tanggalPilihan."<br>";
        echo $sopPoster." Eror timestamp tidak terpenuhi";
        echo "
        <script>
        alert('Proses tidak bisa dilakukan karena tanggal yang dirujuk tidak memenuhi SOP Publikasi Poster[H-3], silahkan koordinasi dengan Puskom digrup');
        document.location.href = 'admin.php?halaman=1';
        </script>    
    ";
    }
    
}else{
    //$dayofVideo = rand(10,31);
    $tanggalPilihan = strtotime($tanggal);
    $sopVideo = strtotime("+9 day");
    if($tanggalPilihan > $sopVideo){
        
        if($jumlah_rows<4){
            if($mysqli->query($sql)===true){
           
                echo "
                    <script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'admin.php?halaman=1';
                    </script>    
                    ";
                
            }else{
                echo "
                    <script>
                    alert('data gagal ditambahkan!');
                    document.location.href = 'admin.php?halaman=1';
                    </script>    
                ";
            }
        
        }else{
            echo "
                <script>
                alert('Ups kuota postingan untuk tanggal yang dipilih telah penuh, silahkan coba hari lain atau  hubungi Puskom!');
                document.location.href = 'admin.php?halaman=1';
                </script>    
            ";
        }
    }else{
        echo $sopVideo;
        echo $tanggal;

        
        echo "
        <script>
        alert('Proses tidak bisa dilakukan karena tanggal yang dirujuk tidak memenuhi SOP Publikasi Video (H-10), silahkan pilih hari lain atau coba koordinasi dengan Puskom digrup');
        document.location.href = 'admin.php?halaman=1';
        </script>    
    ";

    }
    
}

   

$mysqli->close();
