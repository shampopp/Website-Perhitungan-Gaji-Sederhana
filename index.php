<?php 
    $edit_id = isset($_GET['edit_id']);
    $delete_id = isset($_GET['delete_id']);

    $conn = new mysqli("localhost","root","","latxe");
    if($conn->connect_error){
        die("koneksi db gagal".$conn->connect_error);
    }

    function create($conn):void
    {
        $nama = $_POST['nama'];
		$jabatan = $_POST['jabatan'];
		$partai = $_POST['partai'];
		$gaji = $_POST['gaji'];
		$tunjangan_rumah = $_POST['tunjangan_rumah'];
		$tunjangan_jabatan = $_POST['tunjangan_jabatan'];
        $tunjangan_transportasi = $_POST['tunjangan_transportasi'];

        $create = mysqli_query($conn, "INSERT INTO gajidpr VALUES(NULL, '$nama','$jabatan','$partai','$gaji','$tunjangan_rumah','$tunjangan_jabatan','$tunjangan_transportasi')");
        if($create === TRUE){
        }
    }

    function edit($conn):void
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
		$jabatan = $_POST['jabatan'];
		$partai = $_POST['partai'];
		$gaji = $_POST['gajik'];
		$tunjangan_rumah = $_POST['tunjangan_rumah'];
		$tunjangan_jabatan = $_POST['tunjangan_jabatan'];
        $tunjangan_transportasi = $_POST['tunjangan_transportasi']; 

        $edit = mysqli_query($conn, "UPDATE gajidpr SET nama='$nama',jabatan='$jabatan',partai='$partai',gaji_pokok='$gaji',tunjangan_rumah='$tunjangan_rumah',tunjangan_jabatan='$tunjangan_jabatan',tunjangan_transportasi='$tunjangan_transportasi' WHERE id='$id'");
        if($edit === TRUE){
            header('location:index.php');
        }
    }

    function delete($conn):void
    {
        $id = $_GET['delete_id'];
        $delete = mysqli_query($conn, "DELETE FROM gajidpr WHERE id='$id'");
        if($delete === TRUE){
            header('location:index.php');
        }
    }

    if(!$edit_id && !$delete_id)
    {
        if(isset($_POST['nama']))
        {
            create($conn);
        }
    }elseif($edit_id){
        if(isset($_POST['id']))
        {
            edit($conn);
        }
    }else{
        delete($conn);
    }
?>

<html>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <title>Home</title>
        <style>
        .plus-jakarta-sans{
            font-family: "Plus Jakarta Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        *{
            font-family:"Plus Jakarta Sans",Sans-Serif;
            font-size:13px;
        }
        </style>
    </head>
    <body>
        <h1 class="text-4xl text-blue-300 text-center py-5">Pendataan Gaji DPR</h1>
        <div class="px-12">
            <form
                method="POST"
                class="w-full flex flex-col bg-white shadow-lg gap-4 p-4 border"
            >
                <?php if($edit_id){?>
                    <input type="hidden" name="id" value="<?=$_GET['edit_id']?>"/>
                <?php } ?>

                <?php 
                    if($edit_id)
                    {
                        $id = $_GET['edit_id'];
                        $data = mysqli_query($conn, "SELECT * FROM gajidpr WHERE id='$id' limit 1");
                        $list_edit = mysqli_fetch_assoc($data);
                    }
            ?>
            <div class="flex flex-row gap-2">
                <div class="w-full flex flex-col gap-2">
                    <label for="nama">Nama: </label>
                    <input 
                        type="text"
                        name="nama"
                        placeholder="Contoh: Tono"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['nama']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="jabatan">Jabatan: </label>
                    <input 
                        type="text"
                        name="jabatan"
                        placeholder="Contoh: Tono"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['jabatan']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="partai">Partai: </label>
                    <input 
                        type="text"
                        name="partai"
                        placeholder="Contoh: PKI"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['partai']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="gaji">Gaji: </label>
                    <input 
                        type="text"
                        name="gaji"
                        placeholder="Contoh: 5000"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['gaji']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="tunjangan_rumah">Tunjangan Rumah: </label>
                    <input 
                        type="text"
                        name="tunjangan_rumah"
                        placeholder="Contoh: 5000"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['tunjangann_rumah']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="tunjangan_jabatan">Tunjangan Jabatan: </label>
                    <input 
                        type="text"
                        name="tunjangan_jabatan"
                        placeholder="Contoh: 5000"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['tunjangan_jabatan']?>"
                        <?php }?>
                    >
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="tunjangan_transportasi">Tunjangan Transportasi: </label>
                    <input 
                        type="text"
                        name="tunjangan_transportasi"
                        placeholder="Contoh: 5000"
                        class="border rounded-md px-2 py-1.5"
                        <?php if($edit_id){?>
                        value="<?= $list_edit['tunjangan_transportasi']?>"
                        <?php }?>
                    >
                </div>
            </div>
            <button type="submit" class=" w-full text-white rounded-md bg-gradient-to-r from-pink-300 to-yellow-200 px-2 py-1.5 w-60">
                <?php if(!$edit_id){?>
                Submit
                <?php }else{?>
                Edit
                <?php } ?>
            </button>
            <div class="px-12">
                <div class="w-full flex flex-col bg-white shadow-lg gap-4 p-4 border">
                    <table class="border-separate border-spacing-2 table-auto">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Jabatan</th>
                            <th>Partai</th>
                            <th>Gaji</th>
                            <th>Tunjangan Rumah</th>
                            <th>Tunjangan Jabatan</th>
                            <th>Tunjangan Transportasi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 0;
                            $data = mysqli_query($conn,"SELECT * FROM gajidpr");
                            while($list = mysqli_fetch_array($data)){
                                $no++
                        ?>
                            <tr>
                                <td class=" p-2 text-center">
                                    <?=$no ?>
                                </td>
                                <td class="text-center">
                                    <?=$list['nama_anggota']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['jabatan']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['partai']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['gaji_pokok']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['tunjangan_rumah']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['tunjangan_jabatan']?>
                                </td>
                                <td class="text-center">
                                    <?=$list['tunjangan_transportasi']?>
                                </td>
                                <td class="w-full flex flex-row gap-3 justify-center">
                                    <a href="index.php?edit_id<?=$list['id']?>">Edit</a>
                                    <a href="index.php?delete_id<?=$list['id']?>">Hapus</a>
                                </td>
                            </tr>
                            
                    
                        <?php 
                            }
                        ?>




                        </tbody>
                    </table>
                </div>
            </div>

            
                
        </form>
    </body>
</html>