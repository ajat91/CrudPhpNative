<?php
    include ('../function.php');
    $keyword=$_GET["keyword"];
    $query="SELECT * FROM mahasiswa WHERE
    nama LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' OR
    npm LIKE '%$keyword%'
    ";
    $mahasiswa=query($query);
?>
<table align="center" width="80%" border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Npm</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>

            <?php $i=1; ?>
            <?php foreach($mahasiswa as $row) :?>
            <tr>
                <td><?php echo $i ?></td>
                <td><img src="img/<?= $row->gambar ?>" alt="" width="50"></td>
                <td><?php echo $row->npm ?></td>
                <td><?php echo $row->nama ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo $row->jurusan ?></td>
                <td>
                    <a href="ubah.php?id=<?php echo $row->id ?>">Ubah</a> | <a href="hapus.php?id=<?php echo $row->id ?>" onclick= "return confirm('Yakin');">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>   
        </table>