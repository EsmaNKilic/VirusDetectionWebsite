<?php
    $baglan = mysqli_connect("localhost","root","","scanner");

    if(!$baglan){
        die("connection failed:".mysqli_connect_error());
    } else {
        //echo "Bağlantı Sağlandı";
    }
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/link.css">
    </head>
    <body>
        <div class="mb-3 progress">
            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>   
        </div>
        <div class="container p-3 m-7">
            <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ENK LinkTotal</a>
                <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container a">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Anasayfa</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link disabled">Şikayet</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </nav>
            <div class="container yazi" >
                    <h3>Bilmediğiniz sitelerden kaçının. </h3>
                    <h4 class="m-3">Bize linkinizi gönderin, size güvenilirliğini söyleyelim.</h4>
            </div> 
            <form method="post" action="">
                <div class="form-group video_url_container url">
                    <input style="width: 65%" class="form-control" placeholder="Link bağlantısını buraya yapıştırınız." name="linkurl">
                    <button type="submit" class="btn btn-warning btn-md btn-outline buton" name="buton">Taramayı Başlat</button>
                </div>
            </form> 
            <?php
                if(isset($_POST["buton"])){
                    $sql = "insert into url(linkurl)values('".$_POST["linkurl"]."')";
                    
                        require_once('C:\xampp\htdocs\tez\virusKontrol\VirusTotalApiV2.php');
                        $api = new VirusTotalAPIV2("400ab5fd674d204874665d9a56fe7ed587c0f2d7da33c9b719932108326c6876");
                        $sonuc = mysqli_query($baglan,$sql);
                        $result = $api->scanURL($sonuc);
                        $scanId = $api->getScanID($result); 
                        $api->displayResult($result);
                    
                    if($sonuc){
                        echo "Tarama yapıldı.";
                    } else{
                        echo "hata";
                    }
                }
            ?>
            <div class="container mb-3">
                <img src="resim.png" class="foto" width="700" height="600" />
            </div>
            
        </div>
    </body>
</html>


            
            