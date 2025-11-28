<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $a_id = mysqli_real_escape_string($db, $_REQUEST['a_id']);
  $data = $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
  $value = $data->fetch_object();
  $a_type = $value->a_type;
  function selected($type,$a_type){
    if ($type == $a_type) {
        echo 'selected';
    }else{
      echo $a_type;
    }
  }
?>
<form action="action/manage_user.php" enctype="multipart/form-data">
  <input type="hidden" name="a_id" value="<?=$value->a_id?>">
<div class="row">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Full Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" value="<?=$value->a_name;?>" name="a_name" aria-label="John Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" value="<?=$value->a_email;?>" aria-label="john.doe@example.com" name="a_email" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" value="<?=$value->a_phone;?>" placeholder="+91 9888-444-111" aria-label="john.doe@example.com" name="a_phone" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">Company</label>
          <input type="text" id="add-user-company" class="form-control" placeholder="Techzex"  value="<?=$value->a_company;?>" aria-label="jdoe1" name="a_company" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="a_password">Password *</label>
          <input type="password" id="a_password" class="form-control" placeholder="password"  value="<?=$value->a_vpwd;?>" aria-label="jdoe1" name="a_password" required/>
        </div>



        <div class="mb-3">
          <label class="form-label" for="country">User Type</label>
          <select id="country" name="a_type" class=" form-select" required>
            <option value="">Select</option>
            <option <?php selected(2,$a_type); ?> value="2">Manufactorer</option>
            <option <?php selected(3,$a_type); ?> value="3">Distributer</option>
            <option <?php selected(4,$a_type); ?> value="4">Dealer</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" name="r_id" class="form-select" required>
            <option value="">Select</option>
            <?php 
               $role = $db->query("SELECT * FROM `roles` WHERE consumer_id = '$consumer_id'");
               while($role_value = $role->fetch_object()){
            ?>
               <option <?php if (!empty($value->r_id)) {
                  if ($value->r_id == $role_value->r_id) {
                    echo "selected";
                  }
               } ?> value="<?=$role_value->r_id?>"><?=$role_value->roles_name?></option>
            <?php } ?>
          </select>
        </div>
                  <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

 </div>

</form>