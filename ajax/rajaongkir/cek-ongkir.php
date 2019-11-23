<?php
include "../../admin/config.php";
if (isset($_POST['subdistrict_id'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=153&originType=city&destination=" . $_POST['subdistrict_id'] . "&destinationType=subdistrict&weight=" . $_POST['weight'] . "&courier=" . $_POST['courier'] . "",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 772b99fdc5a62231d8a83772580ae8fa"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        // if (isset($kecamatan_id)=="" AND isset($kecamatan)=="" AND isset($kurir)=="" AND isset($berat)=="") {
        //     echo"
        //     Silahkan lengkapi data terlebih dahulu.
        //     ";
        // } else {
            // echo $response;
            $data = json_decode($response, true); //decode response dari raja ongkir, json ke array
            $status = $data['rajaongkir']['status']['code'];

            if ($status==200) {
                echo '
                <p>Dari Jakarta Selatan ke '.$_POST['subdistrict_name'].' @'.$_POST['weight'].' gram.</p><br>
                <p>Silahkan pilih service (Wajib diisi):</p><br>
                ';
                $kurir = $data['rajaongkir']['results'][0]['name'];
                $code = $data['rajaongkir']['results'][0]['code'];
                $costs = $data['rajaongkir']['results'][0]['costs'];
                for ($i = 0; $i < count($costs); $i++) {
                    $service = $data['rajaongkir']['results'][0]['costs'][$i]['service'];
                    $desc = $data['rajaongkir']['results'][0]['costs'][$i]['description'];
                    $value = $data['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['value'];
                    $etd = $data['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['etd'];
                    
                    $str = str_replace(' ','-',$service);
                    echo '
                    <p>
                        <input type="radio" id="'.$code.'-'.$str.'"  name="service" value="'.$code.'-' . $str . '-'.$value.'" price="'.$value.'" required>
                        <label for="'.$code.'-'.$str.'">
                            ' . $kurir . ' - '.$service.'<br>Estimasi: '.$etd.' Hari <br>'.rupiah($value).'
                        </label>
                    </p>
                    ';
                }

                echo '
                                    </tbody>
                                </table>
                                </div>
                                ';
            } else {
                echo"
                Silahkan lengkapi data terlebih dahulu.
                ";
            }
    }
}
?>
