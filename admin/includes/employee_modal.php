<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  .qr-code {
    /*    border-top: 0.5rem solid #8F8073;
    border-right: 0.5rem solid #8F8073;
    border-bottom: 1rem solid #8F8073; */
    border-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
    /*     border-left: 0.5rem solid #8F8073; */
    /*  background-color: #8F8073; */
    text-align: center;
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
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="">
            <input type="hidden" class="empid" name="id">
            <div class="qr-code text-center">
              <p>QR CODE</p>
              <h2 class="employee_id"></h2>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          <button type="submit" class="btn btn-primary btn-flat" name="generate"><i class="fa fa-download"></i> Download</button>
          </form>
        </div>
      </div>
    </div>
    <!--  <div class="qr-code"></div> -->
  </div>
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
<script src="../employee_genQR.js"></script>

</html>