<?php
date_default_timezone_set('Asia/Taipei');

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");

    $book_id = $_POST['book_id'];
    $udbook_name = $_POST['udbook-name'];
    $udbook_author = $_POST['udbook-author'];
    $udpublic = $_POST['udpublic'];
    $udpublic_date = $_POST['udpublic-date'];
    $udbook_category = $_POST['udbook-category'];
    $udISBN = $_POST['udISBN'];
    $udnote = $_POST['udnote'];
    if(!empty($udbook_broken_image)){
        $book_broken_image_count = count($_FILES['udbook_broken_image']['name']);
        $record = [];
        for($i=0;$i<$book_broken_image_count;$i++){
            $record[$i] = $_FILES['udbook_broken_image']['name'][$i];
            echo $record[$i];
        }
        $book_broken_image_insert_sql = "UPDATE book_condition SET book_broken_image1 = '$record[0]',  book_broken_image2 = '$record[1]',  book_broken_image3 = '$record[2]',  book_broken_image4 = '$record[3]' , book_broken_image5 = '$record[4]', note = '$note' WHERE book_id = $book_id";
        mysqli_query($link,$book_broken_image_insert_sql);
        echo mysqli_query($link,$book_broken_image_insert_sql);
    }
    else{
        $note_sql = "UPDATE book_condition SET note = '$udnote' WHERE book_id = $book_id";
        mysqli_query($link, $note_sql);
    }
    if(!empty($udbook_image)){
        $udbook_image = $_POST['udbook-image'];
    }else{
        $udbook_image = $_POST['book-image'];
    }
    
    //$book_introduction = $_POST['udbook-introduction'];
    //$book_owner = $_POST['book_owner'];
    //$connection_method = $_POST['con'];
    //$book_user =$_POST['book_user'];
    //$book_up_date = date("Y/m/d/H/m/s");
    
    
    $sql = "UPDATE `book_info` SET `book_name`='$udbook_name',`book_author`='$udbook_author',`public`='$udpublic',`public_date`='$udpublic_date'
    ,`book_category`='$udbook_category',`ISBN`='$udISBN', `book_image`='$udbook_image' WHERE book_id = '$book_id'";
    

    if(mysqli_query($link,$sql))
    {
        //header('location:已上架書籍.php?sorf=修改成功');
    }else{
        //header('location:已上架書籍.php?sorf=修改失敗');
    }

?>
