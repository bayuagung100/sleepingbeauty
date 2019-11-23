<?php
$province_id = $_POST['province_id'];
$province = $_POST['province'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=$province_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 772b99fdc5a62231d8a83772580ae8fa"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}

$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
    echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."' city_name='".$data['rajaongkir']['results'][$i]['city_name']." (".$data['rajaongkir']['results'][$i]['type'].")'>".$data['rajaongkir']['results'][$i]['city_name']." (".$data['rajaongkir']['results'][$i]['type'].")</option>";
}

?>