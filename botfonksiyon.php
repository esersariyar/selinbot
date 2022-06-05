<?php
/*

Bu yazılım Eser Sarıyar tarafından geliştirilmiştir. Yazılımın çeşitli alanlarının düzenlenmesi serbesttir.

- Copyright metinlerinin silinmesi yasaktır. (Örneğin: Eser Sarıyar metni gibi)
- Yazılımın satılması kesinlikle yasaktır.
- Yazılım GitHub üzerinde paylaşılacaksa, Eser Sarıyar'ın paylaşmış olduğu repositorie üzerinden fork aracılığı ile paylaşılabilir.


Yazılımın geliştirilme tarihi: 04.06.2022
*/
include_once'config/settings.php';

function sanitize_data($data){
		$data = trim($data);
		$data = htmlentities($data);
		return $data;
	}

$mesaj = sanitize_data($_GET['mesaj']);

if(empty($mesaj)){
    echo "<b><font color='#990606'>Hata:</font></b> <font color='#08039c'>Mesaj boş bırakıldı.</font>";
    die();
}

if($mesaj == NULL){
    echo "<b><font color='#990606'>Hata:</font></b> <font color='#08039c'>Mesaj boş bırakıldı.</font>";
    die();
}

$max_karakter = 1500;
 if(strlen($mesaj)>$max_karakter){
     echo "<b><font color='#990606'>Hata:</font></b> <font color='#08039c'>Mesajınz ".$max_karakter." karakterden fazla olamaz.</font>";
	 die();
 }

 if(strlen($mesaj) < 2){
     echo $mesaj;
	 die();
 }

//YENİ VERİ EKLEME KOMUTU
if (strpos($mesaj, ''.$command_p.'yeniveri') === 0) {
   $editlenmis = str_replace("".$command_p."yeniveri", "", $mesaj);
   $editlenmis1 = str_replace("{", "", $editlenmis);
   $editlenmis2 = str_replace("}", "", $editlenmis1);
   $arr = explode("|", $editlenmis2, 2);
   $metin = trim($arr[0]);
   $cevap = trim($arr[1]);
   
   if(empty($metin) || empty($cevap)){
	   echo "<b><font color='#990606'>Hata:</font></b> <font color='#08039c'>Hatalı veya eksik komut kullanıldı.</font>";
	   die();
   }
   
try {
    $baglanti = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $baglanti->exec("SET NAMES utf8mb4");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sorgu = $baglanti->prepare("SELECT * FROM meetweb_bot WHERE mesaj LIKE :mesaj");
	$sorgu->bindParam(':mesaj',$metin, PDO::PARAM_STR);
	$sorgu->execute();
	if(!$sorgu || $sorgu->rowCount() <= 0){
		
		$sorgu = $baglanti->prepare("INSERT INTO meetweb_bot(mesaj, cevap) VALUES(?, ?)");
		$sorgu->bindParam(1, $metin, PDO::PARAM_STR);
		$sorgu->bindParam(2, $cevap, PDO::PARAM_STR);
		$sorgu->execute();
		
		echo "<b><font color='#02c41f'>Başarılı:</font></b> <font color='#08039c'>Bu cümleyi bana öğrettiğin için teşekkür ederim. Öğrettiklerini veritabanıma kayıt ettim.</font>";
		die();

	}else{
	echo "<b><font color='#990606'>Hata:</font></b> <font color='#08039c'>Girilen değerler daha önceden veritabanına kayıt edilmiştir.</font>";
	die();
	}
} catch (PDOException $e) {
    die($e->getMessage());
}
$baglanti = null;


}

try {
    $baglanti = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $baglanti->exec("SET NAMES utf8mb4");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sorgu = $baglanti->prepare("SELECT * FROM meetweb_bot WHERE mesaj LIKE concat('%', :mesaj, '%')");
	$sorgu->bindParam(':mesaj',$mesaj, PDO::PARAM_STR);
	$sorgu->execute();
	if(!$sorgu || $sorgu->rowCount() <= 0){
		$cikti['cevap'] = "<b><font color='#02b9de'>Bilgi:</font></b> <font color='#04b312'>Yazmış olduğun mesaja uygun bir yanıt veritabanımda bulunmamakta. <br> Bu mesajına yanıt olarak söyleyebileceğim cümleyi bana <br><br></font><b><font color='#9004b3'>".$command_p."yeniveri </font><font color='#e3db02'>".$mesaj."</font> <font color='#02e3df'>|</font><font color='#091bde'>{Verebileceğim cevap}</b></font> <br><br> <font color='#04b312'>komutu ile öğretebilir misin?</font> <br><br> <b>Komutun Örnek Kullanım:</b><br> !yeniveri Selamünaleyküm|Aleykümselam <br><br>";
		echo $cikti['cevap'];
	}else{
    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
	echo $cikti['cevap'];
    exit;
	}
} catch (PDOException $e) {
    die($e->getMessage());
}
$baglanti = null;
?>
