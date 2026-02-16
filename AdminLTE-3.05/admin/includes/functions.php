<?php

if (!function_exists('get_the_teachers')) {
    function get_the_teachers() {
        // function body
    }
}


function get_the_classes()
{

    $con=mysqli_connect('localhost', 'root', '', 'sms_projects');

if(!$con){
    echo 'connection failed';
}
    $output= array();

     $query=$con->prepare('SELECT * FROM classes');
     $query->execute();
     $result=$query->get_result();
     while($row =$result->fetch_object() ){
        $output[]= $row;
     }
     return $output;
}


function get_post(array $args = [], string $type ='object')
{
    global $con;
    $condition="";
    $values=[];
    $types="";
    if(!empty($args))
    {
        $condition_ar=[];
        foreach($args as $k => $v)
        {
            ///$v = mysqli_real_escape_string($con,$v);
            $condition_ar[] = "$k = ?";
            $values[]=$v;
            $types.="s";

        }
    
    $condition = "WHERE " . implode(" AND ", $condition_ar);

    }

    
    $sql = "SELECT * FROM posts $condition";
    $query = $con->prepare($sql);
      if (!empty($values)) {
        $query->bind_param($types, ...$values);
    }
    $query->execute();
    $result = $query->get_result();
 return ($type === 'array')
        ? $result->fetch_assoc()
        : $result->fetch_object();
}
function get_posts(array $args = [], string $type = 'object')
{
    global $con;

    $condition_ar = [];
    $values = [];
    $types = "";

    if (!empty($args)) {
        foreach ($args as $k => $v) {
            $condition_ar[] = "$k = ?";
            $values[] = $v;
            $types .= "s";
        }
    }

    if (isset($_SESSION['college_id'])) {
        $condition_ar[] = "college_id = ?";
        $values[] = $_SESSION['college_id'];
        $types .= "i";
    }

    $condition = !empty($condition_ar)
        ? "WHERE " . implode(" AND ", $condition_ar)
        : "";

    $sql = "SELECT * FROM posts $condition";
    $stmt = $con->prepare($sql);

    if (!empty($values)) {
        $stmt->bind_param($types, ...$values);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ RETURN MULTIPLE ROWS
    $data = [];
    while ($row = ($type === 'array')
        ? $result->fetch_assoc()
        : $result->fetch_object()
    ) {
        $data[] = $row;
    }

    return $data;
}


function get_metadata($item_id,$meta_key='',$type='object'){ 
    global $con; 
    
    if(!empty($meta_key)){ 
        $query = $con->prepare("SELECT * FROM metadata WHERE item_id = ? AND meta_key = ?");
        $query->bind_param("is",$item_id,$meta_key);
    } else {
        $query = $con->prepare("SELECT * FROM metadata WHERE item_id = ?");
        $query->bind_param("i",$item_id);
    }

    $query->execute();
    $result = $query->get_result();

    return data_output($result , $type); 
}

function get_meta_value($item_id, $key) { $meta = get_metadata($item_id, $key); return !empty($meta) ? $meta[0]->meta_value : null; }

function data_output($query, $type='object'){
    $output=[];
    if($type == 'object'){
        while($result = $query->fetch_object()){
            $output[]=$result;

        }
    }
    else{
          while($result = $query->fetch_object){
            $output[]=$result;

        }
    }
    return $output;
}

// function data_output($result, $type='object'){
//     $output=[];
//     while($row = ($type=='array' ? $result->fetch_assoc() : $result->fetch_object())){
//         $output[]=$row;
//     }
//     return $output;
// }

function get_user_data($user_id,$type='object'){
    global $con;

    $query=$con->prepare("SELECT * FROM accounts WHERE id = ?");
    $query->bind_param("i",$user_id);
    $query->execute();
  return data_output($query,$type);
}
function get_users($args = array(),$type ='object'){
    global $con;
      $condition = "";
      $values=[];
      $types="";
    if(!empty($args)){
         
        foreach($args as $k => $v)
        {
            $v = (string)$v;
            $condition_ar[] = "$k = ?";
             $values[]=$v;
               $types.="s";
        }
      if (!empty($condition_ar)) {
    $condition = "WHERE " . implode(" AND ", $condition_ar);
}

    }
 $query= $con->prepare("SELECT * FROM accounts $condition");
  if (!empty($values)) {
        $query->bind_param($types, ...$values);
    }
    $query->execute();
 return ($type === 'array')
        ? $result->fetch_assoc()
        : $result->fetch_object();
}


function get_user_metadata($user_id){
    global $con;
    $output=[];
    $query=$con->prepare("SELECT * FROM usermeta WHERE `user_id`=?");
    $query->bind_param("i",$user_id);
    $query->execute();
    $outcome=$query->get_result();
    while($result=$outcome->fetch_object()){
$output[$result->meta_key]=$result->meta_value;
    }
   return $output;
  
}
function get_usermeta($user_id, $meta_key, $single = true)
{
    global $con;

    if (empty($user_id) || empty($meta_key)) {
        return false;
    }

    $query = $con->prepare(
        "SELECT meta_value FROM usermeta WHERE user_id = ? AND meta_key = ?"
    );
    $query->bind_param("is", $user_id, $meta_key);
    $query->execute();
    $result = $query->get_result();

    // ✅ single value
    if ($single === true) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['meta_value'];
        }
        return null; // ✅ IMPORTANT
    }

    // ✅ multiple values
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $values[] = $row['meta_value'];
    }

    return $values;
}


function get_attendance($item_id,$meta_key,$single=true){
    global $con;
 if(!empty($item_id) && !empty($meta_key)){
$query=$con->prepare("SELECT * FROM `attendance1` WHERE `item_id`=? AND `meta_key`=?");
$query->bind_param("is",$item_id,$meta_key);
$query->execute();
$result=$query->get_result();

 }
 else{
    return false;

 }
 if($single){
    if($result->num_rows() > 0){
     return $result->fetch_object()->meta_value;
}
else{
    return $result->fetch_object();
}
    }
    else{
         return $result->fetch_object();
    }
 }
 

function update_usermeta($user_id,$meta_key,$meta_value){
    global $con;
        $select=$con->prepare("SELECT * FROM `usermeta` WHERE user_id=? AND meta_key=?");
        $select->bind_param("is",$user_id,$meta_key);
$select->execute();
$result=$select->get_result();
$check=$result->num_rows;
    if($check>0){
         $update_query=$con->prepare("UPDATE `usermeta` SET meta_value=? WHERE user_id=? AND meta_key=?");
         $update_query->bind_param("sis",$meta_value,$user_id,$meta_key);
         $update_query->execute();
  if($update_query){
    echo '<script>alert("updation of details has been successfully")</script>';
    echo '<script>window.open("dashboard.php","_self")</script>';
  }
    }
}
function update_attendance($item_id,$meta_key,$meta_value){
    global $con;
    $select=mysqli_query($con,"SELECT * FROM `attendance1` WHERE item_id=$item_id AND meta_key='$meta_key'");
    $check=mysqli_num_rows($select);
    if($check>0){
        return mysqli_query($con,"UPDATE `attendance1` SET meta_value='$meta_value' WHERE item_id='$item_id' AND meta_key='$meta_key'");
          
    }
  
    return false;
}
function get_parent($user_id,$meta_key,$single=true){
    global $con;
    if(empty($user_id) || empty($meta_key)){
        return false;
    }
    $query=mysqli_query($con,"SELECT * FROM `usermeta` WHERE user_id='$user_id' AND meta_key='$meta_key'");
    if($single){
        $row=mysqli_fetch_assoc($query);
        return $row['meta_value'] ?? false;
    }
    else{
        $value=[];
        while($row=mysqli_fetch_assoc($query)){
            $value=$row['meta_value'];
        }
        return $value;

    }
}

function delete_usermeta($user_id,$meta_key){
    global $con;
   
        $select=$con->prepare("SELECT * FROM `usermeta` WHERE user_id=? AND meta_key=?");
        $select->bind_param("is",$user_id,$meta_key);
        $select->execute();
        $result=$select->get_result();
    $check=$result->num_rows();
    if($check>0){
         $delete_query=$con->prepare("DELETE FROM `usermeta` WHERE user_id=? AND meta_key=?");
         $delete_query->bind_param("is",$user_id,$meta_key);
         $delete_query->execute();
        if($delete_query){
            echo '<script>alert("Deleting the details of the user")</script>';
            echo '<script>window.open("user-account.php","_self")</script>';
        }
    }
}
?>
<?php
function delete_section_meta($class_id,$con){
        $sql=$con->prepare("DELETE from `metadata` WHERE item_id=? AND meta_key=? ");
        $meta_key='section';
        $sql->bind_param("is",$class_id,$meta_key);
$sql->execute();
   
}

function insert_section_meta($class_id,$section_id,$con){

      $sql=$con->prepare("INSERT INTO metadata(item_id,meta_key,meta_value) value(?,?,?)");
      $meta_section='section';
$sql->bind_param("isi",$class_id,$meta_section,$section_id);
$sql->execute();
}
?>