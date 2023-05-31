<?php
// Set the page name
$page = "data";
// Require the init file
require_once "../functions/init.php";
// Require the functions file
require_once "../functions/pages/data.php";
// Redirect if not logged in
if (!logged_in()) {
    redirect("../../login");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?= $url ?>/assets/images/logo.png" type="image/png">
      <title>Data Manager | Feedback Camp</title>
<?php include '../includes/styles.php'; ?>
   </head>
   <body>
      <div class="page">
         <div class="page-main">
            <?php include "../includes/header.php" ?>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="page-header">
                     <div class="avatar bg-camp d-block mr-2" id="loadSwitchDiv">
                        <i class="fe fe-layout" id="loadSwitch"></i>
                     </div>
                     <h2 class="page-title">
                        <span><?= clean($widgetName) ?></span>
                     </h2>
                  </div>
                  <div class="row">
                     <?php include "../includes/sidebar.php"; ?>
                     <div class="col-lg-10 order-md-1">
                        <div class="row">
                           <div class="col-12">
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title text-dark"><i class="fe fe-database mr-2"></i> Data Manager</h3>
                                 </div>
                                 <div class="card-body pt-1">
                                   <?php if (isset($success)) { ?>
                                   <div class="alert bg-success text-white"><i class="far fa-check mr-3"></i> <?= $success ?></div>
                                   <?php } elseif(isset($error)) { ?>
                                     <div class="alert bg-danger text-white"><i class="far fa-times mr-3"></i> <?= $error ?></div>
                                   <?php } ?>
                                    <p>In order for you to back up and manage your data, Feedback Camp provides the ability to export your feedback responses as a <strong>.CSV</strong> file. You also have the ability to import data from a previous export.</p>
                                    <strong>Notice:</strong> There are currently <?= $responses ?> rows of feedback data.
                                    <div class="mt-5 mb-3">
                                          <button type="button" data-toggle="modal" data-target="#importModal" class="btn btn-gray px-6 mx-1">
                                          <i class="fe fe-upload mr-2"></i> Import data
                                          </button>
                                       <form method="post" class="mb-5 d-inline">
                                          <input type="hidden" name="submit" value="1">
                                          <button type="submit" class="btn bg-camp px-6 mx-1">
                                          <i class="fe fe-download mr-2"></i> Download data
                                          </button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
  <div class="modal fade" id="importModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Data</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select a Feedback Camp CSV file to import feedback responses.</p>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file" accept=".csv" required>
                  <label class="custom-file-label">Choose file</label>
              </div>
          </div>
      <div class="text-center">
        <button type="submit" name="uploadImport" class="btn btn-gray w-75 mt-3 mb-3" value="1">
            <i class="fe fe-upload mr-2"></i> Upload CSV</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
      <?php include "../includes/footer.php" ?>
      </div>
   </body>
</html>
