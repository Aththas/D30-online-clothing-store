<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="admin_login.php";
</script>
<?php
}

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
$nextweek = date("Y-m-d", strtotime("+7 day"));
                        if(isset($_POST["add_job"]))
                        {

                            if($_POST["name"] == "" || $_POST["exp_date"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Field's Can't be Empty!!!")
                                </script>
                                <?php
                                header("refresh:0.1;url=job.php");
                            }
                            else
                            {
     
                                mysqli_query($link,"insert into job_positions values('','$_POST[name]','$_POST[exp_date]')");

                                ?>
                                <script type="text/javascript">
                                    alert("Job added successfully!!!");
                                </script>
                                <?php
                                header("refresh:0.1;url=job.php");
                                
                            }
                        
                        }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../user/img/D30.jpeg">
    <title>D30 Store</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="" />
    <style type="text/css">
              input, button{   
        height: 34px;   
    } 
          .open-button {
  background-color: purple;
  color: white;
  border: none;
  cursor: pointer;
  width: 150px;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 500px;
  right: 150px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container textarea, .form-container select, .form-container input[type=file], .form-container input[type=date] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 12px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}


/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: black;
  border-color: transparent;
  margin-top: 10px;
  width: 45%
}
    @media(max-width: 768px){
    thead{
        display: none;
    }
    tbody, tr, td{
        display: block;
        width: 100%;
    }
    tr{
        margin-bottom: 15px;
    }
     tbody tr td{
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
     td:before{
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
    }
}
    </style>
  </head>
  <body>
    <div class="container-scroller">

        <?php include("topbar.php"); ?>
<br><br><br>
      <div class="container-fluid page-body-wrapper">

        <?php include("sidebar.php"); ?>

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Jobs </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                    <h4 class="card-title col-lg-10">View Jobs</h4>
                    <button class="open-button col-lg-2" onclick="openForm()">+Add Jobs</button>
                  </div>
                    <script>
                            function openForm() {
                                document.getElementById("myForm").style.display = "block";
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }

                        </script>


<div class="form-popup" id="myForm">
  <form method="POST" class="form-container" enctype="multipart/form-data">
    <h1></h1>

    <label for="name"><b>Position</b></label>
    <input type="text" name="name">

    <label for="name"><b>Expire Date</b></label>
    <input type="date" name="exp_date" min="<?php echo $nextweek; ?>">

    <input type="submit" name="add_job" value="ADD" class="btn" style="border-color: transparent; width: 45%; font-weight: bold; cursor:pointer; background-color: purple; margin-top: 10px;">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

                    <table class="table">
                      <thead>
                        <tr>
                          <th>Position</th>
                          <th>Expire Date</th>
                          <th>Actions</th>
                          <th>No of Applications</th>
                          <th>View Applications</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM job_positions order by id desc";     
                          $rs_result = mysqli_query ($link, $query); 
                          while($row=mysqli_fetch_array($rs_result))
                          {
                          echo "<tr>";
                          echo "<td data-label='Position'>"; echo $row["position"]; echo "</td>";
                          echo "<td data-label='Expire Date'>"; echo $row["expire_date"]; echo "</td>";
                          echo "<td data-label='Actions'>"; ?> 
                            <a href="editJob.php?id=<?php echo $row["id"]; ?>"> <i class="far fa-edit" style="color: green; font-size: 18px;"></i> </a>
                            <a href="confirm_Delete.php?id=<?php echo $row["id"]; ?>&name=job"> <i class="far fa-trash-alt" style="color: red; font-size: 18px;"></i> </a> 
                          <?php echo "</td>";

                            $query_count = "SELECT COUNT(*) FROM job_applications where position ='$row[position]' ";     
                            $rs_result_count = mysqli_query($link, $query_count);     
                            $row_count = mysqli_fetch_row($rs_result_count);     
                            $total_applications = $row_count[0]; 

                          echo "<td data-label='No of Applications'>"; echo $total_applications; echo "</td>";

                          echo "<td data-label='View Applications'>"; ?> <a href="view_job.php?id=<?php echo $row["id"]; ?>"> <i class="far fa-eye" style="color: green; font-size: 18px;"></i> </a> <?php echo "</td>";
                          echo "</tr>";
                          echo "</tr>";
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <?php include("footer.php") ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>