<?php
if(isset($_GET['edit_class'])){
    $edit_id=$_GET['edit_class'];

        $edit="SELECT * FROM `posts` WHERE id=? AND type=?";
        $edit_query=$con->prepare($edit);
        $type='class';
        $edit_query->bind_param("is",$edit_id,$type);
        $edit_query->execute();
 $result=$edit_query->get_result();
    $row_fetch=$result->fetch_assoc();
    $class_name=$row_fetch['title'];
    $date=$row_fetch['publish_date'];

}
?>


<?php
$section_titles = [];

if(isset($edit_id)){
    // get all section meta for this class
    $class_meta = get_metadata($edit_id, 'section');

    foreach($class_meta as $meta){
        // get section post by ID
        $section = get_posts([
            'id' => $meta->meta_value
        ]);

        if(!empty($section)){
            $section_titles[] = $section[0]->title;
        }
    }
}

// convert array to string
$section_title = implode(', ', $section_titles);


?>

<?php
$section_ids = [];

       $q = $con->prepare("SELECT meta_value FROM metadata 
                        WHERE item_id=? AND meta_key=?"); 
                        $meta_key_section='section';   
                        $q->bind_param("is",$edit_id,$meta_key_section) ;
                        $q->execute();
$result=$q->get_result();
while($r = $result->fetch_assoc($q)){
    $section_ids[] = $r['meta_value'];
}
?>
<?php
if(isset($_POST['update_class'])){
    $class_name=$_POST['title'];
    $date=$_POST['publish_date'];
    $section=explode(',',$_POST['section']);

    if($class_name=='' or $date=''){
        echo "<script>alter('please fill the complete details')</script>";
    }
    else{
       
       $stxt= $con->prepare("UPDATE `posts` set title=?,publish_date=? WHERE id=? AND type=?");
       $type_class='class';
        $stxt->bind_param("ssis",$class_name,$date,$edit_id,$type_class);
$stxt->execute();

        delete_section_meta($edit_id,$con);
        foreach($section as $sec){
            insert_section_meta($edit_id,trim($sec),$con);

        }
                echo "<script>alert('Class & Sections updated successfully')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
     <h2 class="text-center">Edit your Class</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mt-6">
            <label for="title" class="form-label">Class name:-</label>
            <input type="text" id="title" name="title" class="form-control" required="required" value="<?php echo $class_name ?>">
        </div>

          <div class="form-outline w-50 m-auto mt-4">
            <label for="publish_date" class="form-label">Date:-</label>
            <input type="text" id="publish_date" name="publish_date" class="form-control" required="required" value="<?php echo $date ?>">
        </div>
 <div class="form-outline w-50 m-auto mt-4">
            <label for="" class="form-label">Sections:-</label>
            <input type="text" id="section" name="section"
       class="form-control"
       placeholder="Enter section IDs like 3,4"
       value="<?php echo implode(',', $section_ids); ?>">
        </div>
   

         <div class="text-center mt-4 ">
            <input type="submit" id="update_class" name="update_class" value="Update class" class="form-submit bg-success">
        </div>
</form>
</body>
</html>