<?php include('includes/config.php')?>
<?php include('./header.php')?>
<?php include('./sidebar.php')?>


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Student Profile :-</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">student</a></li>
              <li class="breadcrumb-item active">Student Profile</li>
            </ol>
          </div><!-- /.col -->
       
        </div><!-- /.row -->
</div>
</div>
    <!-- /.content-header -->
     <!-- <?php
    // print_r($student);
   
 //print_r($stdmeta);
     ?> -->
       <section class="content">
      <div class="container-fluid">
        <div class="row">

        <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="C:\Users\archi mittal\Desktop\akg.png" alt="User profile picture">
                </div>

                 <h3 class="profile-username text-center"><?php echo get_users(array('id'=>$std_id))[0]->Name ;?></h3>

                <p class="text-muted text-center"> <?php echo get_users(array('id'=>$std_id))[0]->type; ?> </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <?php
                    $class=get_post(['id'=> $stdmeta['st_class']]);
                  
                    ?>
                  <li class="list-group-item">
                    <b>Class:-</b> <a class="float-right"><?php  echo $class->title ;?></a>
                  </li>
  <li class="list-group-item">
                    <b>Section:-</b> <a class="float-right"><?php echo $stdmeta['st_section']; ?></a>
                  </li>

                   <li class="list-group-item">
                    <b>DOB:-</b> <a class="float-right"><?php echo $stdmeta['dob']; ?></a>
                  </li>
                

                  <li class="list-group-item">
                    <b>Mobile:-</b> <a class="float-right"><?php echo $stdmeta['mobile']; ?></a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>email:-</b> <a class="float-right"><?php echo get_users(array('id'=>$std_id))[0]->email;?></a>
                  </li>
 <li class="list-group-item">
                    <b>Addres:-</b> <a class="float-right"><?php echo ucfirst($stdmeta['address']); ?></a>
                  </li>
<li class="list-group-item">
                    <b>State:-</b> <a class="float-right"><?php echo ucfirst($stdmeta['state']); ?></a>
                  </li>
<li class="list-group-item">
                    <b>Country:-</b> <a class="float-right"><?php echo ucfirst($stdmeta['country']); ?></a>
                  </li>
<li class="list-group-item">
                    <b>Zip Code:-</b> <a class="float-right"><?php echo ucfirst($stdmeta['pincode']); ?></a>
                  </li>
                </ul>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
           
            <!-- /.card -->
          </div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Parent's Information</h3>
        </div>
        <div class="card-body">
               <ul class="list-group list-group-unbordered mb-3">
               
                 <li class="list-group-item">
                    <b class="px-5">Father's Name:-</b> <a class="mx-4"><?php  echo $stdmeta['father_name'] ;?></a>
                      <b class="px-5">Father's Phone-No:-</b> <a class="mx-4"><?php  echo $stdmeta['father_mobile'] ;?></a>
                  </li>

                       <li class="list-group-item mt-3">
                    <b class="px-5">Mother's Name:-</b> <a class="mx-4"><?php  echo ucfirst($stdmeta['mother_name']) ;?></a>
                      <b class="px-5">Mobile's Phone-No:-</b> <a class="mx-4"><?php echo $stdmeta['mother_mobile'] ;?></a>
                  </li>

                 <li class="list-group-item mt-3">
                    <b class="px-5">parents's Address:-</b> <a class="mx-3"><?php  echo $stdmeta['parent_address'] ;?></a>
                      <b class="px-5">parents's State:-</b> <a class="mx-4"><?php  echo $stdmeta['parent_state'] ;?></a>
                     
                  </li>
                  
                 <li class="list-group-item mt-3">
                      <b class="px-5 mt-2">parents's Country:-</b> <a class="mx-4"><?php  echo ucfirst($stdmeta['parent_country']) ;?></a>
                        <b class="px-5 mt-2">parents's pincode:-</b> <a class="mx-4"><?php  echo $stdmeta['parent_pincode'] ;?></a>
                  </li>
                 
</ul>


</div>
    </div>

    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Student's Qualification</h3>
        </div>
        <div class="card-body">
               <ul class="list-group list-group-unbordered mb-3">
               
                 <li class="list-group-item">
                    <b class="px-5">School Name:-</b> <a class="mx-4"><?php  echo $stdmeta['school_name'] ;?></a>
                      <b class="px-5">Board:-</b> <a class="mx-4"><?php  echo $stdmeta['board'] ;?></a>
                  </li>

                       <li class="list-group-item mt-3">
                    <b class="px-5">Subject_stream:-</b> <a class="mx-4"><?php  echo ucfirst($stdmeta['subject_stream']) ;?></a>
                      <b class="px-5">Total Marks's:-</b> <a class="mx-4"><?php echo $stdmeta['total_mark'] ;?></a>
                  </li>

                 <li class="list-group-item mt-3">
                    <b class="px-5">Marks's Obtained:-</b> <a class="mx-3"><?php  echo $stdmeta['obtain_mark'] ;?></a>
                      <b class="px-5">Percentage:-</b> <a class="mx-4"><?php  echo $stdmeta['percentage'] ;?></a>
                     
                  </li>
                  
                
</ul>


</div>
</div>
</div>
</div>
</section>
<?php include('footer.php')?>
      

  

      