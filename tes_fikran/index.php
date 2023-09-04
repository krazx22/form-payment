<?php
$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desemeber');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-sm border px-5">
        <br>
        <div class="text-center"><span class="border border-2 fs-3 fw-bold">Form Payment</span></div>
        <form action="index.php" method="post" id="formPayment">
            <div class="px"></div>
            <div class="row row-cols-auto">
                <div class="col">Account</div>
            </div>
            <div class="row row-cols-auto mb-3">
                <div class="col"><label for="Fullname">Fullname</label></div>
                <div class="col px-4"><input type="text" id="fn" name="fn" class="form-control"></div>
                <div class="col"><label for="Nickname">Nickname</label></div>
                <div class="col"><input type="text" id="nn" name="nn" class="form-control"></div>
            </div>
            <div class="row row-cols-auto mb-3">
                <div class="col"><label for="Email">Email</label></div>
                <div class="col px-5"><input type="text" id="email" name="email" class="form-control" size="66"></div>
            </div>
            <div class="row row-cols-auto mb-1">
                <div class="col"><label for="DateOfBirth">Date of Birth</label></div>
            </div>
            <div class="row row-cols-auto">
                <div class="col">
                    <select class="form-select" id="tgl" name="tgl">
                        <option value="">Tanggal</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" id="bln" name="bln">
                        <option value="">Bulan</option>
                        <?php
                        foreach ($bulan as $item) {
                            echo "<option value='$item'>$item</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" id="thn" name="thn">
                        <option value="">Tahun</option>
                        <?php
                        $tahunSaatIni = date("Y");
                        for ($tahun = 1990; $tahun <= $tahunSaatIni; $tahun++) {
                            echo "<option value='$tahun'>$tahun</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">Gender</div>
                <div class="col">
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                </div>
                <div class="col mb-4">
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg" type="submit" form="formPayment" value="simpan" name="simpan">Simpan</button>
            </div>

            <?php
            if (isset($_POST['simpan'])) {
                $dpay = array(
                    'fn' => $_POST['fn'],
                    'nn' => $_POST['nn'],
                    'email' => $_POST['email'],
                    'tgl' => $_POST['tgl'],
                    'bln' => $_POST['bln'],
                    'thn' => $_POST['thn'],
                    'gender' => $_POST['gender']

                );
            }


            echo  "
                            <div class='container mt-4'>
                               <div class='row'>
                                  <div class='col-lg-3'>Fullname</div>
                                  <div class='col-lg-6'> : " . $dpay['fn'] . "</div>
                               </div>
                               <div class='row'>
                                  <div class='col-lg-3'>Nickname</div>
                                  <div class='col-lg-6'> : " . $dpay['nn'] . "</div>
                               </div>
                               <div class='row'>
                                  <div class='col-lg-3'>Email</div>
                                  <div class='col-lg-6'> : " . $dpay['email'] . "</div>
                               </div>
                               <div class='row'>
                                  <div class='col-lg-3'>Date Of Birth</div>
                                  <div class='col-lg-6'> : " . $dpay['tgl'] . "-" . $dpay['bln'] . "-" . $dpay['thn'] . "</div>
                               </div>
                               <div class='row'>
                                  <div class='col-lg-3'>Gender</div>
                                  <div class='col-lg-6'> : " . $dpay['gender'] . "</div>
                               </div>
                            </div>
                                 ";

            //Variabel berisi path file data.json yang digunakan untuk menyimpan data pemesanan.
            $berkas = "data.json";

            //Mengubah data pemesanan yang berbentuk array PHP menjadi bentuk JSON.
            $dataJson = json_encode($dpay, JSON_PRETTY_PRINT);

            // Menyimpan data pemesanan yang berbentuk JSON ke dalam file JSON
            file_put_contents('data.json', $dataJson);

            // Mengambil data pemesanan dari file JSON
            $dataJson = file_get_contents($berkas);

            // Mengubah data pemesanan dalam format JSON ke dalam format array PHP.
            $dpay = json_decode($dataJson, true);

            ?>
        </form>
    </div>

</body>

</html>