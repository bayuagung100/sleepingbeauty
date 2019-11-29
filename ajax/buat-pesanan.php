<?php
include "../admin/config.php";
include "../func/func_date.php";
$sesi = $_POST['sesi'];
$id_pesanan = $_POST['id_pesanan'];
$subtotal = $_POST['subtotal'];
$weight = $_POST['weight'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kecamatan = $_POST['kecamatan'];
$postcode = $_POST['postcode'];
$ekspedisi = $_POST['ekspedisi'];
$service = $_POST['service'];
$payment_method = $_POST['payment_method'];
$pecah = explode("-",$service);
$layanan = $pecah[1];
$ongkir = $pecah[2];
$kurir = strtoupper($ekspedisi);
$total = $subtotal+$pecah[2];
$pecah2 = explode("-",$payment_method);
$bank = $pecah2[0];
$no_rek = $pecah2[1];
$nama_pemilik = $pecah2[2];

$query = mysqli_query($mysqli,"SELECT * FROM temp_cart WHERE id_session='$sesi' ");

while ($data = mysqli_fetch_array ($query)) {   
    $tid = $data['id'];
    $tip = $data['id_product'];
    $tz = $data['size'];
    $tc = $data['color'];
    $tq = $data['qty'];
    $td = $data['date'];
    

    $insuser = mysqli_query($mysqli, "INSERT INTO pembelian
        (
            id_session,
            id_pesanan,
            id_product,
            size,
            color,
            qty,
            date,
            nama,
            email,
            tel,
            address,
            provinsi,
            kabupaten,
            kecamatan,
            kode_pos,
            ekspedisi,
            service,
            payment_method,
            subtotal,
            total,
            total_berat,
            status

        )
        values
        (
            '$sesi',
            '$id_pesanan',
            '$tip',
            '$tz',
            '$tc',
            '$tq',
            '$td',
            '$name',
            '$email',
            '$tel',
            '$address',
            '$provinsi',
            '$kabupaten',
            '$kecamatan',
            '$postcode',
            '$ekspedisi',
            '$service',
            '$payment_method',
            '$subtotal',
            '$total',
            '$weight',
            'pending'
        )
    ");
    if ($insuser) {
        $deltemp = mysqli_query($mysqli,"DELETE FROM temp_cart WHERE id='$tid' AND id_session='$sesi' ");
    }
}


$query2 = mysqli_query($mysqli,"SELECT * FROM temp_cart WHERE id_session='$sesi' ");
$maildata = mysqli_fetch_array($query2);
$to = $email;
$subject = "Pesanan Anda telah dibuat!";

$message = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html
	style="width:100%;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta name="x-apple-disable-message-reformatting">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="telephone=no" name="format-detection">
	<title>Pesanan Anda telah dibuat!</title>
	<!--[if (mso 16)]><style type="text/css">    a {text-decoration: none;}    </style><![endif]-->
	<!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
	<style type="text/css">
		@media only screen and (max-width:600px) {

			p,
			ul li,
			ol li,
			a {
				font-size: 16px !important;
				line-height: 150% !important
			}

			h1 {
				font-size: 30px !important;
				text-align: center;
				line-height: 120% !important
			}

			h2 {
				font-size: 26px !important;
				text-align: center;
				line-height: 120% !important
			}

			h3 {
				font-size: 20px !important;
				text-align: center;
				line-height: 120% !important
			}

			h1 a {
				font-size: 30px !important
			}

			h2 a {
				font-size: 26px !important
			}

			h3 a {
				font-size: 20px !important
			}

			.es-menu td a {
				font-size: 16px !important
			}

			.es-header-body p,
			.es-header-body ul li,
			.es-header-body ol li,
			.es-header-body a {
				font-size: 16px !important
			}

			.es-footer-body p,
			.es-footer-body ul li,
			.es-footer-body ol li,
			.es-footer-body a {
				font-size: 16px !important
			}

			.es-infoblock p,
			.es-infoblock ul li,
			.es-infoblock ol li,
			.es-infoblock a {
				font-size: 12px !important
			}

			*[class="gmail-fix"] {
				display: none !important
			}

			.es-m-txt-c,
			.es-m-txt-c h1,
			.es-m-txt-c h2,
			.es-m-txt-c h3 {
				text-align: center !important
			}

			.es-m-txt-r,
			.es-m-txt-r h1,
			.es-m-txt-r h2,
			.es-m-txt-r h3 {
				text-align: right !important
			}

			.es-m-txt-l,
			.es-m-txt-l h1,
			.es-m-txt-l h2,
			.es-m-txt-l h3 {
				text-align: left !important
			}

			.es-m-txt-r img,
			.es-m-txt-c img,
			.es-m-txt-l img {
				display: inline !important
			}

			.es-button-border {
				display: block !important
			}

			a.es-button {
				font-size: 14px !important;
				display: block !important;
				border-left-width: 0px !important;
				border-right-width: 0px !important
			}

			.es-btn-fw {
				border-width: 10px 0px !important;
				text-align: center !important
			}

			.es-adaptive table,
			.es-btn-fw,
			.es-btn-fw-brdr,
			.es-left,
			.es-right {
				width: 100% !important
			}

			.es-content table,
			.es-header table,
			.es-footer table,
			.es-content,
			.es-footer,
			.es-header {
				width: 100% !important;
				max-width: 600px !important
			}

			.es-adapt-td {
				display: block !important;
				width: 100% !important
			}

			.adapt-img {
				width: 100% !important;
				height: auto !important
			}

			.es-m-p0 {
				padding: 0px !important
			}

			.es-m-p0r {
				padding-right: 0px !important
			}

			.es-m-p0l {
				padding-left: 0px !important
			}

			.es-m-p0t {
				padding-top: 0px !important
			}

			.es-m-p0b {
				padding-bottom: 0 !important
			}

			.es-m-p20b {
				padding-bottom: 20px !important
			}

			.es-mobile-hidden,
			.es-hidden {
				display: none !important
			}

			.es-desk-hidden {
				display: table-row !important;
				width: auto !important;
				overflow: visible !important;
				float: none !important;
				max-height: inherit !important;
				line-height: inherit !important
			}

			.es-desk-menu-hidden {
				display: table-cell !important
			}

			table.es-table-not-adapt,
			.esd-block-html table {
				width: auto !important
			}

			table.es-social {
				display: inline-block !important
			}

			table.es-social td {
				display: inline-block !important
			}
		}

		@media screen and (max-width:9999px) {
			.cboxcheck:checked+input+* .thumb-carousel {
				height: auto !important;
				max-height: none !important;
				max-width: none !important;
				line-height: 0
			}

			.thumb-carousel span {
				font-size: 0;
				line-height: 0
			}

			.cboxcheck:checked+input+* .thumb-carousel .car-content {
				display: none;
				max-height: 0px;
				overflow: hidden
			}

			.cbox0:checked+* .content-1,
			.thumb-carousel .cbox1:checked+span .content-1,
			.thumb-carousel .cbox2:checked+span .content-2,
			.thumb-carousel .cbox3:checked+span .content-3,
			.thumb-carousel .cbox4:checked+span .content-4,
			.thumb-carousel .cbox5:checked+span .content-5,
			.thumb-carousel .cbox6:checked+span .content-6 {
				display: block !important;
				max-height: none !important;
				overflow: visible !important
			}

			.thumb-carousel .thumb {
				cursor: pointer;
				display: inline-block !important;
				width: 14.6%;
				margin: 2% 0.61%;
				border: 1px solid rgb(215, 182, 163)
			}

			.moz-text-html .thumb {
				display: none !important
			}

			.thumb-carousel .thumb:hover {
				border: 1px solid rgb(68, 68, 68)
			}

			.cbox0:checked+* .thumb-1,
			.thumb-carousel .cbox1:checked+span .thumb-1,
			.thumb-carousel .cbox2:checked+span .thumb-2,
			.thumb-carousel .cbox3:checked+span .thumb-3,
			.thumb-carousel .cbox4:checked+span .thumb-4,
			.thumb-carousel .cbox5:checked+span .thumb-5,
			.thumb-carousel .cbox6:checked+span .content-6 {
				border-color: rgb(162, 136, 120)
			}

			.thumb-carousel .thumb img {
				width: 100%;
				height: auto
			}

			.thumb-carousel img {
				max-height: none !important
			}

			.cboxcheck:checked+input+* .fallback {
				display: none !important;
				display: none;
				max-height: 0px;
				height: 0px;
				overflow: hidden
			}
		}

		@media screen and (max-width:600px) {

			.car-table.responsive,
			.car-table.responsive .thumb-carousel,
			.car-table.responsive .thumb-carousel .car-content img,
			.car-table.responsive .fallback .car-content img {
				width: 100% !important;
				height: auto
			}
		}

		@media screen {}

		#outlook a {
			padding: 0;
		}

		.ExternalClass {
			width: 100%;
		}

		.ExternalClass,
		.ExternalClass p,
		.ExternalClass span,
		.ExternalClass font,
		.ExternalClass td,
		.ExternalClass div {
			line-height: 100%;
		}

		.es-button {
			mso-style-priority: 100 !important;
			text-decoration: none !important;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}

		.es-desk-hidden {
			display: none;
			float: left;
			overflow: hidden;
			width: 0;
			max-height: 0;
			line-height: 0;
			mso-hide: all;
		}

		.es-button-border:hover {
			border-color: #c7997f #c7997f #c7997f #c7997f !important;
			background: #fce5cd !important;
		}

		.es-button-border:hover a.es-button {
			background: #fce5cd !important;
			border-color: #fce5cd !important;
			color: #28495c !important;
		}

		td .es-button-border:hover a.es-button-1 {
			background: #fce5cd !important;
			border-color: #fce5cd !important;
		}

		td .es-button-border:hover a.es-button-2 {}

		td .es-button-border-3:hover {
			background: #fce5cd !important;
		}

		td .es-button-border:hover a.es-button-4 {
			background: #b28d72 !important;
			border-color: #b28d72 !important;
		}

		td .es-button-border-5:hover {
			background: #b28d72 !important;
		}
	</style>
</head>

<body
	style="width:100%;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
	<div class="es-wrapper-color" style="background-color:transparent;">
		<!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="transparent"></v:fill> </v:background><![endif]-->
		<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
			style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:right top;">
			<tr style="border-collapse:collapse;">
				<td valign="top" style="padding:0;Margin:0;">
					<table cellpadding="0" cellspacing="0" class="es-header" align="center"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
						<tr style="border-collapse:collapse;">
							<td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#FFFFFF;">
								<table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0"
									cellspacing="0" width="600"
									style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-position:left top;">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center" style="padding:0;Margin:0;"><a
																		target="_blank"
																		href="http://sleepingbeauty.co.id/"
																		style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;font-size:18px;text-decoration:none;color:#38761D;">
																		<img class="adapt-img"
																			src="http://sleepingbeauty.co.id/images/icons/sb-logo.jpg" alt="Sleeping Beauty"
																			style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
																			width="100" height="100"></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr style="border-collapse:collapse;">
										<td align="left" style="padding:0;Margin:0;background-position:center center;">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="600" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center" bgcolor="#b28d72" height="12"
																	style="padding:0;Margin:0;"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
						<tr style="border-collapse:collapse;">
							<td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#FFFFFF;">
								<table bgcolor="#fbf5ed" class="es-content-body" align="center" cellpadding="0"
									cellspacing="0" width="600"
									style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FBF5ED;">
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center center;background-color:transparent;"
											bgcolor="transparent">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center"
																	style="padding:0;Margin:0;padding-top:10px;padding-left:10px;padding-right:10px;">
																	<h1
																		style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:lucida sans unicode, lucida grande, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333;">
																		Terima kasih atas pesanan Anda</h1>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
						<tr style="border-collapse:collapse;">
							<td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#FFFFFF;">
								<table class="es-content-body" width="600" cellspacing="0" cellpadding="0"
									bgcolor="#fbf5ed" align="center"
									style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FBF5ED;">
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-color:#B28D72;"
											bgcolor="#b28d72">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center" bgcolor="#b28d72" height="12"
																	style="padding:0;Margin:0;"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#333333;">
																		Halo, '.$name.'.</p>
																	<p
';

$message .= '
                                                   <p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#333333;">
																		<br></p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#333333;text-align:justify;">
																		Terima kasih atas pesanan Anda. Status masih
																		pending sampai kami mengonfirmasi bahwa
																		pembayaran telah diterima. Sementara itu,
																		berikut adalah pengingat untuk pesanan
																		Anda:<span style="color:#000000;"></span></p>
																</td>
                                             </tr>
                                             <tr style="border-collapse:collapse;">
																<td style="padding:0;Margin:0;">
																	<ul class="borcard p-t-20 p-b-20 p-l-20 p-r-20"
																		style="border:1px solid #E6E6E6;width:auto;background-color:#F0F0F0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;list-style-type:none;">
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			ID Pesanan: <b>'.$id_pesanan.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Tanggal: <b>'.tgl_indonesia($td).'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Nama: <b>'.$name.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Email: <b>'.$email.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			No Hp: <b>'.$tel.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Total: <b>'.rupiah($total).'</b></li>
																	</ul>
																</td>
															</tr>
';

$message .= '
                                             <tr style="border-collapse:collapse;">
																<td style="padding:0;Margin:0;">
																	<h4 class="mtext-109 cl2"
																		style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:lucida sans unicode, lucida grande, sans-serif;">
																		Detail pembayaran</h4>
																	<ul style="list-style-type:none;">
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Bank Tujuan: <b>Bank '.$bank.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			No Rekening Tujuan: <b>'.$no_rek.'</b></li>
																		<li
																			style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;Margin-bottom:15px;color:#333333;">
																			Nama Pemilik: <b>'.$nama_pemilik.'</b></li>
																	</ul>
																</td>
															</tr>
';

$message .= '
                                             <tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#333333;">
																		<span style="text-align:justify;">Lakukan
																			pembayaran langsung ke rekening bank '.$bank.'
																			kami. Silahkan Gunakan ID Pesanan Anda
																			sebagai referensi pembayaran. Pesanan Anda
																			tidak akan dikirim sampai dana telah Kami
																			terima.</span></p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#333333;text-align:justify;">
																		<br></p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#FF0000;text-align:center;">
																		*Pastikan Anda transfer sebelum 1x24 jam atau
																		transaksi Anda akan dibatalkan secara otomatis
																		oleh sistem.</p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#FF0000;text-align:center;">
																		<br></p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:27px;color:#FF0000;text-align:justify;">
																		<span style="color:#000000;">Setelah Anda
																			melakukan pembayaran harap melakukan
																			KONFIRMASI PEMBAYARAN melalui link dibawah
																			ini.</span></p>
																</td>
                                             </tr>
                                             <tr style="border-collapse:collapse;">
																<td align="center" style="padding:10px;Margin:0;"><span
																		class="es-button-border es-button-border-5"
																		style="border-style:solid;border-color:#D7B6A3;background:#B28D72;border-width:1px;display:inline-block;border-radius:0px;width:auto;"><a
																			href="http://sleepingbeauty.co.id/konfirmasi-pembayaran"
																			class="es-button es-button-4"
																			target="_blank"
																			style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lucida sans unicode, lucida grande, sans-serif;font-size:14px;color:#333333;border-style:solid;border-color:#B28D72;border-width:10px 20px 10px 20px;display:inline-block;background:#B28D72;border-radius:0px;font-weight:normal;font-style:normal;line-height:17px;width:auto;text-align:center;">KONFIRMASI
																			PEMBAYARAN</a></span></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
';

$message .= '
                           <tr style="border-collapse:collapse;">
										<td align="left"
											style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-color:#B28D72;"
											bgcolor="#b28d72">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="center" valign="top"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		<strong>ORDER DETAIlS</strong></p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
';

$query2 = $mysqli->query("SELECT * FROM pembelian WHERE id_session='$sesi' AND id_pesanan='$id_pesanan'  ");
$jml_item = mysqli_num_rows($query2);
while ($data2 = $query2->fetch_array()) {
      $ip = $data2['id_product'];
      $qty = $data2['qty'];
      
      $total_mail=0;
      $totalberat_mail=0;
      $query3 = $mysqli->query("SELECT * FROM product WHERE id='$ip' ");
      while ($data3 = $query3->fetch_array()) {
         $pn = $data3['product_name'];
         $pc = $data3['product_price'];
         $pw = $data3['product_weight'];
         $pi = $data3['product_image1'];

         $ib = $qty*$pw;
         $it = $qty*$pc;
         $total_mail += $it;
         $totalberat_mail += $ib;


         $message .= '
                           <tr style="border-collapse:collapse;">
										<td align="left"
											style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;">
											<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
											<table cellpadding="0" cellspacing="0" class="es-left" align="left"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
												<tr style="border-collapse:collapse;">
													<td width="270" class="es-m-p20b" align="left"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td class="es-m-txt-c" align="center"
																	style="padding:0;Margin:0;">
																	<img src="'.$set['url'].'images/source/'.$pi.'" alt="'.$pn.'"
																		title="'.$pn.'"
																		style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
																		width="200" height="160"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
											<table cellpadding="0" cellspacing="0" class="es-right" align="right"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;">
												<tr style="border-collapse:collapse;">
													<td width="270" align="left" style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		<strong>'.$pn.'</strong></p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="center" height="10"
																	style="padding:0;Margin:0;"></td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		<b>Qty: </b><strong>'.$qty.'</strong></p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		<b>Weight: </b><strong>'.$totalberat_mail.' gram</strong></p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		<b>Price: '.rupiah($total_mail).'</b></p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!--[if mso]></td></tr></table><![endif]-->
										</td>
									</tr>
         ';
      }
}
   
$message .= '
                           <tr style="border-collapse:collapse;">
										<td align="left"
											style="padding:0;Margin:0;padding-left:20px;padding-right:20px;">
											<table width="100%" cellspacing="0" cellpadding="0"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" valign="top" align="center"
														style="padding:0;Margin:0;">
														<table width="100%" cellspacing="0" cellpadding="0"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center"
																	style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;">
																	<table border="0" width="100%" height="100%"
																		cellpadding="0" cellspacing="0"
																		style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
																		<tr style="border-collapse:collapse;">
																			<td
																				style="padding:0;Margin:0px 0px 0px 0px;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px;">
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
											<table cellpadding="0" cellspacing="0" width="100%"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
												<tr style="border-collapse:collapse;">
													<td width="560" align="left" style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		Subtotal ('.$jml_item.' items): <strong>'.rupiah($subtotal).'</strong>
																	</p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		Ongkir: <strong>'.rupiah($ongkir).'</strong> melalui '.$kurir.'
																		'.$layanan.' -&gt; '.$kecamatan.' <strong>
																			@'.$weight.'gram.</strong></p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="left" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;">
																		Payment Method : Bank '.$bank.'.</p>
																</td>
															</tr>
															<tr style="border-collapse:collapse;">
																<td align="right" style="padding:0;Margin:0;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:27px;color:#333333;text-align:left;">
																		<strong>Total : '.rupiah($total).'</strong></p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
                        </table>
                     </td>
						</tr>
					</table>
';

$message .= '
               <table cellpadding="0" cellspacing="0" class="es-content" align="center"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
						<tr style="border-collapse:collapse;">
							<td align="center" style="padding:0;Margin:0;">
								<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
									cellspacing="0" width="600"
									style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
									<tr style="border-collapse:collapse;">
										<td align="left"
											style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center center;background-color:#D7B6A3;"
											bgcolor="#d7b6a3">
											<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
											<table cellpadding="0" cellspacing="0" class="es-left" align="left"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
												<tr style="border-collapse:collapse;">
													<td width="270" class="es-m-p20b" align="left"
														style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="left"
																	style="padding:0;Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;">
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:15px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:23px;color:#333333;">
																		Terima Kasih.</p>
																	<p
																		style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:15px;font-family:courier new, courier, lucida sans typewriter, lucida typewriter, monospace;line-height:23px;color:#333333;">
																		sleepingbeauty.co.id</p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
											<table cellpadding="0" cellspacing="0" class="es-right" align="right"
												style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;">
												<tr style="border-collapse:collapse;">
													<td width="270" align="left" style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" width="100%"
															style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
															<tr style="border-collapse:collapse;">
																<td align="center"
																	style="padding:0;Margin:0;display:none;"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!--[if mso]></td></tr></table><![endif]-->
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>

</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <sbeauty@erolperkasamandiri.co.id>' . "\r\n";
$headers .= 'Cc: zhanzabila@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);

?>