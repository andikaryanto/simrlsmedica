<!doctype html>
<html>
    <head>
        <title>Dinamic Form - harviacode.com</title>
        <style>
            body{
                padding: 15px
            }
            input[type="text"]{
                margin-bottom: 0px !important;
            }
        </style>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="row-fluid">
            <div class="span6">
                <form action="index.php" method="post">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th width="300px">Jenis Barang</th>
                                <th width="100px">Jumlah</th>
                                <th width="80px"></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><input name="jenis_input[0]" class="input-block-level" /></td>
                                <td><input name="jumlah_input[0]" class="input-block-level" /></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-small btn-default" onclick="additem(); return false"><i class="icon-plus"></i></button>
                                    <button name="submit" class="btn btn-small btn-primary"><i class="icon-ok"></i></button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="span6">
                <p>Hasil submit bisa anda lihat di sini. Hasil ini bisa anda simpan dalam tabel atau digunakan untuk kepentingan lain.</p>
                <p>
                    <?php
                    if (isset($_POST['submit'])) {
                        $jenis = $_POST['jenis_input'];
                        $jumlah = $_POST['jumlah_input'];
                        foreach ($jenis as $key => $j) {
                            echo "<p>" . $j . " : " . $jumlah[$key] . "</p>";
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
        <script>
            var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(aksi);
//                membuat element input
                var jenis_input = document.createElement('input');
                jenis_input.setAttribute('name', 'jenis_input[' + i + ']');
                jenis_input.setAttribute('class', 'input-block-level');
                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'jumlah_input[' + i + ']');
                jumlah_input.setAttribute('class', 'input-block-level');
                var hapus = document.createElement('span');
//                meng append element input
                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                aksi.appendChild(hapus);
                hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="icon-trash"></i></button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
                i++;
            }
        </script>
    </body>
</html>