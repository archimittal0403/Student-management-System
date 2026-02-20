<?php
session_start(); // ✅ MUST

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('includes/config.php');
include_once('includes/functions.php');


if (isset($_POST['action']) && $_POST['action'] === 'get_sections') {

    $class_id = $_POST['class_id'] ?? '';

    if (empty($class_id)) {
        echo json_encode([
            'status' => false,
            'options' => '<option value="">Select section</option>'
        ]);
        exit;
    }

    $class_meta = get_metadata($class_id, 'section');
    $options = '<option value="">Select section</option>';

    if (!empty($class_meta)) {
        foreach ($class_meta as $meta) {

            // ✅ get_posts returns ARRAY
            $section_arr = get_posts(['id' => $meta->meta_value]);

            if (!empty($section_arr)) {
                $section = $section_arr[0]; // ✅ FIRST OBJECT

                $options .= '<option value="'.$section->id.'">'
                          . $section->title .
                          '</option>';
            }
        }
    }

    echo json_encode([
        'status' => true,
        'options' => $options
    ]);
    exit;
}


if (!empty($_POST['action']) && $_POST['action'] === 'fill_feedback') {

  $class_id   = $_POST['fill_class'] ?? '';
  $section_id = $_POST['fill_section'] ?? '';
  $subject_id = $_POST['fill_subject'] ?? '';
  $teacher_id = $_POST['fill_teacher'] ?? '';

  $count = 0;
  $data  = [];

  // Base query: students who gave feedback
  $sql = "
    SELECT 
      f.roll AS item_id,
      f.name,

      (
        SELECT mf3.meta_value
        FROM meta_feedback mf3
        WHERE mf3.item_id = f.roll
          AND mf3.meta_key = 'rate'
          AND EXISTS (
            SELECT 1 FROM meta_feedback s
            WHERE s.item_id = f.roll
              AND s.meta_key = 'subject_id'
              AND s.meta_value = '$subject_id'
          )
          AND EXISTS (
            SELECT 1 FROM meta_feedback t
            WHERE t.item_id = f.roll
              AND t.meta_key = 'teacher_id'
              AND t.meta_value = '$teacher_id'
          )
        LIMIT 1
      ) AS rate

    FROM feedback f
    WHERE 1=1
  ";

    if ($class_id != '') {
    $sql .= " AND f.class = '$class_id'";
  }

  /* ---- OPTIONAL: section filter ---- */
  if ($section_id != '') {
    $sql .= " AND f.section = '$section_id'";
  }

  $query = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_assoc($query)) {
    $count++;

    $data[] = [
      'Sno'          => $count,
      'Enroll_ID'    => $row['item_id'],
      'student_name' => ucfirst($row['name']),
      'Rating'       => $row['rate'] ?? 'Not Rated'
    ];
  }

  echo json_encode([
    "draw"            => intval($_POST['draw'] ?? 1),
    "recordsTotal"    => count($data),
    "recordsFiltered" => count($data),
    "data"            => $data
  ]);

  exit;
}
if(!empty($_POST['action']) && $_POST['action'] === 'view_attend'){

$class_id   = $_POST['fil_class'] ?? '';
$section_id = $_POST['fil_section'] ?? '';
$subject_id = $_POST['fil_subject'] ?? '';
$teacher_id = $_POST['fil_teacher'] ?? '';
$date       = $_POST['fil_dob'] ?? '';

$data = [];
$count = 0;

$sql = "
SELECT a.item_id, s.Name,
MAX(CASE WHEN a.meta_key='status' THEN a.meta_value END) as status
FROM attendance1 a
JOIN accounts s ON s.id = a.item_id
WHERE s.type='student'
";

if($class_id!=''){
  $sql.=" AND EXISTS (
    SELECT 1 FROM attendance1 
    WHERE item_id=a.item_id AND meta_key='at_class' AND meta_value='$class_id'
  )";
}

if($section_id!=''){
  $sql.=" AND EXISTS (
    SELECT 1 FROM attendance1 
    WHERE item_id=a.item_id AND meta_key='at_section' AND meta_value='$section_id'
  )";
}

if($subject_id!=''){
  $sql.=" AND EXISTS (
    SELECT 1 FROM attendance1 
    WHERE item_id=a.item_id AND meta_key='at_subject' AND meta_value='$subject_id'
  )";
}

if($teacher_id!=''){
  $sql.=" AND EXISTS (
    SELECT 1 FROM attendance1 
    WHERE item_id=a.item_id AND meta_key='at_teacher' AND meta_value='$teacher_id'
  )";
}

if($date!=''){
  $sql.=" AND EXISTS (
    SELECT 1 FROM attendance1 
    WHERE item_id=a.item_id AND meta_key='dob' AND meta_value='$date'
  )";
}

$sql.=" GROUP BY a.item_id";

$query = mysqli_query($con,$sql);

while($row=mysqli_fetch_assoc($query)){
  $count++;
  $data[]=[
    'Sno'=>$count,
    'Enroll_ID'=>$row['item_id'],
    'Student_Name'=>$row['Name'],
    'Status'=>$row['status'] ?? 'Not Marked'
  ];
}
echo json_encode([
  "draw"=>intval($_POST['draw'] ?? 1),
  "recordsTotal"=>count($data),
  "recordsFiltered"=>count($data),
  "data"=>$data
]);
exit;
}
if(!empty($_POST['action']) && $_POST['action'] === 'update_attend'){

$class_id   = $_POST['fil_class'] ?? '';
$section_id = $_POST['fil_section'] ?? '';
$subject_id = $_POST['fil_subject'] ?? '';
$date       = $_POST['fil_dob'] ?? '';
$current_date=date('Y-m-d');
$data = [];
$count = 0;

if($date!=$current_date){
  echo json_encode([
    'error'=>'you can only update todays date attendance'
  ]);
  exit;
}
$sql = "
SELECT 
  a.item_id, 
  s.Name,
  MAX(CASE WHEN a.meta_key='status' THEN a.meta_value END) as status,
  MAX(CASE WHEN a.meta_key='at_class' THEN a.meta_value END) as at_class,
  MAX(CASE WHEN a.meta_key='at_section' THEN a.meta_value END) as at_section,
  MAX(CASE WHEN a.meta_key='at_subject' THEN a.meta_value END) as at_subject,
  MAX(CASE WHEN a.meta_key='dob' THEN a.meta_value END) as dob
FROM attendance1 a
JOIN accounts s ON s.id = a.item_id
WHERE s.type='student'
GROUP BY a.item_id
HAVING 1=1
";
if($class_id!=''){
  $sql.=" AND at_class='$class_id'";
}

if($section_id!=''){
  $sql.=" AND at_section='$section_id'";
}

if($subject_id!=''){
  $sql.=" AND at_subject='$subject_id'";
}
if($date!=''){
  $sql .= " AND dob = '$date'";
}


$query = mysqli_query($con,$sql);

while($row=mysqli_fetch_assoc($query)){
  $count++;
    $statusText  = ($row['status'] == 'P') ? 'Present' : 'Absent';
  $statusClass = ($row['status'] == 'P') ? 'btn-success' : 'btn-danger';
  $data[]=[
    'Sno'=>$count,
    'Enroll_ID'=>$row['item_id'],
    'Student_Name'=>$row['Name'],
    
   'Status'=>'<button type="button" class="btn btn-sm btn-danger toggle-att" data-id="'.$row['item_id'].'"data-status="'.$row['status'].'">'.$statusText.'</button>
   <button class="btn btn-sm btn-primary upd-att" data-id="'.$row['item_id'].'">Update</button>'
  ];
}

echo json_encode([
  "draw"=>intval($_POST['draw'] ?? 1),
  "recordsTotal"=>count($data),
  "recordsFiltered"=>count($data),
  "data"=>$data
]);
exit;
}


if(!empty($_POST['action']) && $_POST['action']=='update_attendace'){
  $enroll_id=$_POST['enroll_id'];
  $status=$_POST['status'];
 update_attendance($enroll_id,'status',$status);

  echo json_encode([
    'success'=>true
    ]);

  exit;
}

if(!empty($_POST['action']) && $_POST['action']=='mark_attendance'){
    $class_id=$_POST['at_class']?? '';
    $section_id=$_POST['at_section']?? '';
    $subject_id=$_POST['at_subject']?? '';
$semester='';
    $count=0;
    $data=[];
    $sql="SELECT * FROM `accounts` WHERE type='student'";
    if($class_id!=''){
        $sql.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_class' AND meta_value='$class_id')";
    }
    if($section_id!=''){
          $sql.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_section' AND meta_value='$section_id')";
    }
    if($subject_id!=''){
  $q=mysqli_query($con,"SELECT semester FROM `courses` WHERE id='$subject_id'");
  $r=mysqli_fetch_assoc($q);
  $semester=$r['semester'];
    }
    if($semester!=''){
      $sql.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='semester' AND meta_value='$semester')";
    }
    $query=mysqli_query($con,$sql);
    while($row_fetch=mysqli_fetch_assoc($query)){
        $count++;
        $name=$row_fetch['Name'];
        $enroll_id=$row_fetch['id'];
        $at_class=get_usermeta($enroll_id,'st_class');
        $at_class_id=mysqli_query($con,"SELECT title FROM `posts` WHERE id='$at_class'");
        $class_fetch=mysqli_fetch_assoc($at_class_id);
        $at_class_name=$class_fetch['title'];
   $at_section=get_usermeta($enroll_id,'st_section');
        $at_section_id=mysqli_query($con,"SELECT title FROM `section` WHERE id='$at_section'");
        $section_fetch=mysqli_fetch_assoc($at_section_id);
        $at_section_name=$section_fetch['title'] ?? 'N/A';
    $data[]=[
        'SNo'=>$count,
        'Enroll_ID'=>$enroll_id,
        'Class'=>$at_class_name,
        'Section'=>$at_section_name,
        'Student_name'=>$name,
        'Action'=>'<button type="button" class="btn btn-sm btn-danger toggle-att" data-id="'.$enroll_id.'"data-status="A">Absent</button>'
     
    ];
    }
echo json_encode([
    "draw"=>intval($_POST['draw'] ?? 1),
    "recordsTotal"=>count($data),
  "recordsFiltered"=>count($data),
    "data"=>$data
]);
exit;
}
if(!empty($_POST['action']) && $_POST['action']=='saveAttendance'){
    $attendance=$_POST['att'] ?? [];
    $date=$_POST['dob']?? date('Y-m-d');
    $class=$_POST['at_class']?? '';
    $section=$_POST['at_section']?? '';
    $teacher=$_POST['at_teacher']?? '';
    $subject=$_POST['at_subject']?? '';
    if(empty($attendance)){
    echo json_encode(["status"=>false,"message"=>"Attendance empty"]);
    exit;
}
    foreach($attendance as $student_id=>$status){
     
      $result=  mysqli_query($con,"INSERT INTO `attendance1` (`item_id`,`meta_key`,`meta_value`) 
        VALUES
        ('$student_id','status','$status'),
        ('$student_id','dob','$date'),
        ('$student_id','at_class','$class'),
        ('$student_id','at_section','$section'),
        ('$student_id','at_teacher','$teacher'),
        ('$student_id','at_subject','$subject')
        ");
        if(!$result){
          echo mysqli_error($con);
          exit;
        }
    }
    echo json_encode(["status" => true, "message" => "success"]);
exit;

}

if (!empty($_POST['action']) && $_POST['action'] === 'get_parent') {

    $class_id   = $_POST['class_id'] ?? '';
    $section_id = $_POST['section_id'] ?? '';
    $name       = $_POST['name'] ?? '';
    $enroll_id  = $_POST['enroll_id'] ?? '';

    $data  = [];
    $count = 0;

    // ✅ BASE QUERY (MISSING BEFORE)
    $sql = "SELECT * FROM accounts WHERE type='student'";

   if ($name != '') {
        $sql .= " AND Name = '$name'";
    }

    if ($enroll_id != '') {
        $sql .= " AND id = '$enroll_id'";
    }
  if($class_id!=''){
    $sql.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_class' AND meta_value='$class_id')";
  }
  if($section_id!=''){
    $sql.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_section' AND meta_value='$section_id')";
  }
  $query=mysqli_query($con,$sql);
  while($row_fetch=mysqli_fetch_assoc($query)){
    $count++;
    $enroll_id=$row_fetch['id'];
    $student_name=$row_fetch['Name'];
    $parent_id=0;
  $q = mysqli_query(
            $con,
            "SELECT user_id 
             FROM usermeta 
             WHERE meta_key='children' 
             AND meta_value LIKE '%i:$enroll_id;%'"
        );

        if ($pr = mysqli_fetch_assoc($q)) {
            $parent_id = $pr['user_id'];
        }

           $father_name = $father_mobile = '';
        $mother_name = $mother_mobile = '';
        $parent_address = '';
        $parent_email = 'N/A';
  if ($parent_id) {
            $p = mysqli_query($con, "SELECT email FROM accounts WHERE id='$parent_id'");
            $parent_email = mysqli_fetch_assoc($p)['email'] ?? 'N/A';
        }
        if($parent_id){
        $meta_q = mysqli_query(
            $con,
            "SELECT meta_key, meta_value 
             FROM usermeta 
             WHERE user_id='$enroll_id'
               AND meta_key IN (
                   'father_name',
                   'father_mobile',
                   'mother_name',
                   'mother_mobile',
                   'parent_address'
               )"
        );

        while ($meta = mysqli_fetch_assoc($meta_q)) {
            switch ($meta['meta_key']) {
                case 'father_name':
                    $father_name = $meta['meta_value'];
                    break;

                case 'father_mobile':
                    $father_mobile = $meta['meta_value'];
                    break;

                case 'mother_name':
                    $mother_name = $meta['meta_value'];
                    break;

                case 'mother_mobile':
                    $mother_mobile = $meta['meta_value'];
                    break;

                case 'parent_address':
                    $parent_address = $meta['meta_value'];
                    break;
            }
        }
        }
$data[]=[
   'SNO'=>$count,

'Father Name'=>ucfirst($father_name) ?: 'n/a',
'Father Mobile'=>$father_mobile ?: 'n/a',
'Mother Name'=>ucfirst($mother_name) ?: 'n/a',
'Mother Mobile'=>$mother_mobile ?: 'n/a',
'Address'=>$parent_address ?: 'n/a',
  'Email Address' => $parent_email ,
  'Action' =>'<a href="edit_parent.php?id='.$enroll_id.'" class="btn btn-sm btn-info">Edit</a>'

];
  }
   echo json_encode([
        "draw"=>intval($_POST['draw'] ?? 1),
        "recordsTotal"=>count($data),
                          "recordsFiltered"=>count($data), 
                          "data"=>$data
    ]);
    exit;
}
if(!empty($_POST['action']) && $_POST['action']=='get_result_details'){
    
    $class_id=$_POST['class_id'] ?? '';
    $section_id=$_POST['section_id'] ?? '';
    $subject_id=$_POST['subject_id'] ?? '';

    $data1=[];
    $count=0;
    $sql1="SELECT * FROM `accounts` WHERE type='student'";
    if($class_id!=''){
        $sql1.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_class' AND meta_value='$class_id')";
    }
    if($section_id!=''){
        $sql1.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='st_section' AND meta_value='$section_id')";
    } 
    $semester = '';
    if($subject_id!=''){

        $sub_q = mysqli_query($con,"SELECT semester FROM `courses` WHERE id='$subject_id' LIMIT 1");
    if($sub_q && mysqli_num_rows($sub_q) > 0){
        $sub_row = mysqli_fetch_assoc($sub_q);
        $semester = $sub_row['semester'];
    }
    }
    if($semester!=''){
      $sql1.=" AND id IN (SELECT user_id FROM `usermeta` WHERE meta_key='semester' AND meta_value='$semester')";
    }
    $query=mysqli_query($con,$sql1);
    while($row_fetch=mysqli_fetch_assoc($query)){
$count++;
    $enroll_id=$row_fetch['id'];
    $name=$row_fetch['Name'];
    $res_class=get_usermeta($enroll_id,'st_class');
$res_class_id=mysqli_query($con,"SELECT title FROM posts WHERE id='$res_class'");
$class_fetch=mysqli_fetch_assoc($res_class_id);
$res_class_name=$class_fetch['title'];
$res_section=get_usermeta($enroll_id,'st_section');
$res_section_id=mysqli_query($con,"SELECT title FROM section WHERE id='$res_section'");
$section_fetch=mysqli_fetch_assoc($res_section_id);
$res_section_name=$section_fetch['title']?? 'N/A';
        $data1[]=[
            'Sno'=>$count,
'Enroll_ID'=>$enroll_id,

'Student_Name'=>ucfirst($name),
'Marks'=>'n/a'
        ];
    }

    echo json_encode([
        "draw"=>intval($_POST['draw'] ?? 1),
        "recordsTotal"=>count($data1),
                          "recordsFiltered"=>count($data1), 
                          "data"=>$data1
    ]);
    exit;
}
 if (!empty($_POST['action']) && $_POST['action'] === 'get_user_details') {
        $class_id   = $_POST['class_id'] ?? '';
  $section_id = $_POST['section_id'] ?? '';

                 $data=[];
                  $sql="SELECT * FROM accounts WHERE type='student'";
                   if($class_id!=''){
                      $sql.=" AND id IN (SELECT user_id FROM usermeta WHERE meta_key='st_class' AND meta_value='$class_id')"; 
                     } 
                     if($section_id!=''){ 
                        $sql.=" AND id IN (SELECT user_id FROM usermeta WHERE meta_key='st_section' AND meta_value='$section_id')";
                      }
                       $query=mysqli_query($con,$sql); 
                       while($row=mysqli_fetch_assoc($query)){ 
                        $user_id=$row['id'];
                        $user_edit='<a href="user-account.php?class='.$class_id.'&section='.$section_id.'&edit_student='.$user_id.'" class ="btn btn-sm btn-success"><i class="fa fa-pencil-alt"></i></a>';
                        $user_delete='<a href="user-account.php?class='.$class_id.'&section='.$section_id.'&delete_student='.$user_id.'" class="btn btn-sm btn-success mx-2"><i class="fa fa-trash-alt"></i></a>' ;
                        $dob=get_usermeta($user_id,'dob'); 
                        $phone=get_usermeta($user_id,'mobile');
                         $st_class=get_usermeta($user_id,'st_class'); 
                         $st_section=get_usermeta($user_id,'st_section');
                         $data[] = [ 
                           'enroll'=> $row['id'] , 
                           'class'=>$st_class, 
                           'section'=>$st_section,
                            'photo'=>'<img src="dist/img/akg-logo.png" width="40">', 
                            'name'=>$row['Name'], 
                            'email'=>$row['email'], 
                            'phone'=>$phone, 
                            'dob'=>$dob, 
                            'action'=>$user_edit.''.$user_delete,
       
                           ]; 
                        }
                        echo json_encode([ 
                           "draw" => intval($_POST['draw'] ?? 1),
                         "recordsTotal"=>count($data),
                          "recordsFiltered"=>count($data), 
                          "data"=>$data 
                        ]);
                         exit; 
                        }
// upload the marks inside yteh system 
if(!empty($_POST['action']) && $_POST['action'] == 'save_marks'){

    $class_id   = $_POST['res_class'] ?? '';
    $section_id = $_POST['res_section'] ?? '';
    $subject_id = $_POST['res_subject'] ?? '';
    $marks      = $_POST['marks'] ?? [];

    if(empty($class_id) || empty($section_id) || empty($subject_id)){
        echo json_encode([
            "status"=>false,
            "message"=>"Please select class/section/subject"
        ]);
        exit;
    }

    // 1️⃣ Get or Create Result
    $check = mysqli_query($con,
        "SELECT result_id FROM result
         WHERE class_id='$class_id'
         AND section_id='$section_id'
         AND subject_id='$subject_id'"
    );

    if(mysqli_num_rows($check) > 0){
        $row = mysqli_fetch_assoc($check);
        $result_id = $row['result_id'];
    } else {
        mysqli_query($con,
            "INSERT INTO result (class_id,section_id,subject_id)
             VALUES('$class_id','$section_id','$subject_id')"
        );
        $result_id = mysqli_insert_id($con);
    }

    // 2️⃣ Insert or Update Marks
    foreach($marks as $student_id => $mark){

        $exist = mysqli_query($con,
            "SELECT id FROM result_marks
             WHERE result_id='$result_id'
             AND student_id='$student_id'"
        );

        if(mysqli_num_rows($exist) > 0){

            mysqli_query($con,
                "UPDATE result_marks
                 SET marks='$mark'
                 WHERE result_id='$result_id'
                 AND student_id='$student_id'"
            );

        } else {

            mysqli_query($con,
                "INSERT INTO result_marks (result_id,student_id,marks)
                 VALUES('$result_id','$student_id','$mark')"
            );
        }
    }

    echo json_encode([
        "status"=>true,
        "message"=>"Marks saved successfully"
   
    ]);
    exit;
}
