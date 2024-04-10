<?php
include "./admin/employee.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="/node_modules/html2canvas/dist/html2canvas.js"></script>
  <script src="/node_modules/html2canvas/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style>
  qr-code {
    background-color: pink;
  }
</style>

<body>
  <!-- Add -->
  <div class="modal fade" id="addnew">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Add Employee</b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="username" class="col-sm-3 control-label">Username</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="username" name="username">
              </div>

            </div>
            <div class="form-group">
              <label for="firstname" class="col-sm-3 control-label">Firstname</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="firstname" name="firstname" required>
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-3 control-label">Lastname</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="lastname" name="lastname" required>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email</label>

              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="address" class="col-sm-3 control-label">Address</label>

              <div class="col-sm-9">
                <textarea class="form-control" name="address" id="address"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="datepicker_add" class="col-sm-3 control-label">Birthdate</label>

              <div class="col-sm-9">
                <div class="date">
                  <input type="text" class="form-control" id="datepicker_add" name="birthdate">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="contact" class="col-sm-3 control-label">Contact Info</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="contact" name="contact">
              </div>
            </div>
            <div class="form-group">
              <label for="gender" class="col-sm-3 control-label">Gender</label>

              <div class="col-sm-9">
                <select class="form-control" name="gender" id="gender" required>
                  <option value="" selected>- Select -</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="position" class="col-sm-3 control-label">Position</label>

              <div class="col-sm-9">
                <select class="form-control" name="position" id="position" required>
                  <option value="" selected>- Select -</option>
                  <?php
                  $sql = "SELECT * FROM position";
                  $query = $conn->query($sql);
                  while ($prow = $query->fetch_assoc()) {
                    echo "
                              <option value='" . $prow['id'] . "'>" . $prow['description'] . "</option>
                            ";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="schedule" class="col-sm-3 control-label">Schedule</label>

              <div class="col-sm-9">
                <select class="form-control" id="schedule" name="schedule" required>
                  <option value="" selected>- Select -</option>
                  <?php
                  $sql = "SELECT * FROM schedules";
                  $query = $conn->query($sql);
                  while ($srow = $query->fetch_assoc()) {
                    echo "
                              <option value='" . $srow['id'] . "'>" . $srow['time_in'] . ' - ' . $srow['time_out'] . "</option>
                            ";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="photo" class="col-sm-3 control-label">Photo</label>
              <div class="col-sm-9">
                <input type="file" name="photo" id="photo">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-3 control-label">Password</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit -->
  <div class="modal fade" id="edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="employee_edit.php">
            <input type="hidden" class="empid" name="id">
            <div class="form-group">
              <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="edit_firstname" name="firstname">
              </div>
            </div>
            <div class="form-group">
              <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="edit_lastname" name="lastname">
              </div>
            </div>
            <div class="form-group">
              <label for="edit_address" class="col-sm-3 control-label">Address</label>

              <div class="col-sm-9">
                <textarea class="form-control" name="address" id="edit_address"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="datepicker_edit" class="col-sm-3 control-label">Birthdate</label>

              <div class="col-sm-9">
                <div class="date">
                  <input type="text" class="form-control" id="datepicker_edit" name="birthdate">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" id="edit_contact" name="contact">
              </div>
            </div>
            <div class="form-group">
              <label for="edit_gender" class="col-sm-3 control-label">Gender</label>

              <div class="col-sm-9">
                <select class="form-control" name="gender" id="edit_gender">
                  <option selected id="gender_val"></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="edit_position" class="col-sm-3 control-label">Position</label>

              <div class="col-sm-9">
                <select class="form-control" name="position" id="edit_position">
                  <option selected id="position_val"></option>
                  <?php
                  $sql = "SELECT * FROM position";
                  $query = $conn->query($sql);
                  while ($prow = $query->fetch_assoc()) {
                    echo "
                              <option value='" . $prow['id'] . "'>" . $prow['description'] . "</option>
                            ";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="edit_schedule" class="col-sm-3 control-label">Schedule</label>

              <div class="col-sm-9">
                <select class="form-control" id="edit_schedule" name="schedule">
                  <option selected id="schedule_val"></option>
                  <?php
                  $sql = "SELECT * FROM schedules";
                  $query = $conn->query($sql);
                  while ($srow = $query->fetch_assoc()) {
                    echo "
                              <option value='" . $srow['id'] . "'>" . $srow['time_in'] . ' - ' . $srow['time_out'] . "</option>
                            ";
                  }
                  ?>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="employee_delete.php">
            <input type="hidden" class="empid" name="id">
            <div class="text-center">
              <p>DELETE EMPLOYEE</p>
              <h2 class="bold del_employee_name"></h2>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Generate qr codes -->

  <div class="modal fade" id="Generate">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="">
            <input type="hidden" class="empid" name="id">
            <div class="qr-code text-center">
              <p>QR CODE</p>
              <h2 class="del_employee_name" style="font-family: arial black;"></h2>
              <h3 id="employee_id"></h3>
              <img class="codeimg" height="200px" width="200px">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="button" class="btn btn-primary btn-flat save-qrcode" name="download"><i class="fa fa-download"></i>Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // ... Your existing code ...

    $(document).ready(function() {
      // Function to handle saving the QR code
      function saveQRCode(qrCodeURL, filename) {
        $.ajax({
          type: 'POST',
          url: 'save_qrcode.php',
          data: {
            filename: filename,
            employee_id: qrCodeURL // Send the employee_id instead of qrCodeURL
          },
          success: function(response) {
            if (response === 'success') {
              alert('QR code saved successfully!');
            } else {
              alert('Failed to save the QR code.');
            }
          }
        });
      }

      $('.save-qrcode').click(function() {
        var qrCodeURL = $('.employee_id').text(); // Use the employee_id text directly
        var filename = qrCodeURL + '.png'; // Append .png to the filename

        // Call the function to save the QR code
        saveQRCode(qrCodeURL, filename);
      });
    });
  </script>

  <!-- Your other HTML code -->


  <!-- ... Your HTML code ... -->


  <!-- Update Photo -->
  <div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
            <input type="hidden" class="empid" name="id">
            <div class="form-group">
              <label for="photo" class="col-sm-3 control-label">Photo</label>

              <div class="col-sm-9">
                <input type="file" id="photo" name="photo" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- <script src="../downloadQR.js"></script> -->

</html>