<?php
// Set the page name
$page = "editor";
// Include the init file
include "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    header("Location:../../login");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?= $url ?>/assets/images/logo.png" type="image/png">
      <title>Editor | Feedback Camp </title>
<?php include '../includes/styles.php'; ?>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600,700" rel="stylesheet">
<link rel="stylesheet" media="all" href="<?= $url ?>/assets/css/siteFeedback.css">
   </head>
   <body>
      <div class="page">
         <div class="page-main">
           <form id="editorForm">
             <div class="header py-4">
                <div class="container">
                   <div class="d-flex">
                     <a href="<?= $url ?>/campaign/<?= $_GET["campaign"]; ?>" class="fas fa-chevron-left text-dark mr-5 text-decoration-none mt-3"></a>
                      <a class="header-brand" href="<?= $url ?>">
                      <img src="<?= $url ?>/assets/images/logo.png" class="header-brand-img mr-2" alt="Feedback Camp logo">
                      <!-- <span class="hidden-sm-down">Feedback Camp </span> -->
                      </a>
                      <div class="d-flex order-lg-2 ml-auto">
                        <a href="<?= $url . '/feedback/' . $_GET["campaign"] ?>" target="_blank" class="btn btn-secondary mr-2 pt-2 pb-2 pl-5 pr-5">View <i class="far fa-external-link ml-2"></i></a>
                        <button type="submit" class="btn bg-camp text-white pt-2 pb-2 pl-5 pr-5" id="saveBtn"><i class="fas fa-save mr-2"></i> Save changes</button>
                      </div>
                   </div>
                </div>
             </div>
          <div id="response"></div>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="row pt-4">
                     <div class="col-lg-5">
                       <h4 class="ml-3 mt-2 mb-5"><i class="fad fa-broadcast-tower mr-2"></i> Live Customizer</h4>
                       <div class="card">
                         <div class="card-body pb-0">
                           <div class="form-group">
                              <label>Campaign Name</label>
                              <input type="text" class="form-control" name="name" value="<?= clean($widgetName) ?>" required>
                              <small class="form-text text-muted mt-2">
                              Only used for when you need to identify this campaign.
                              </small>
                           </div>
                             <div class="form-group">
                               <label>Accent color</label>
                               <input class="form-control jscolor {onFineChange:'update(this)',hash:true}" name="accent" value="<?= clean($widgetAccent) ?>">
                             </div>
                             <div class="form-group">
                               <label>Position</label>
                               <select class="form-control" name="position">
                                 <option value="1" <?= $widgetPosition == '1' ? 'selected' : '' ?>>Left</option>
                                 <option value="" <?= $widgetPosition == '' ? 'selected' : '' ?>>Right</option>
                               </select>
                             </div>
                             <div class="form-group">
                               <label>Widget type</label>
                               <select class="form-control" name="type">
                                 <option value="" <?= $widgetType == '' ? 'selected' : '' ?>>Floating</option>
                                 <option value="1" <?= $widgetType == '1' ? 'selected' : '' ?>>Sidebar</option>
                                 <option value="2" <?= $widgetType == '2' ? 'selected' : '' ?>>Fullscreen</option>
                               </select>
                             </div>
                             <hr>
                             <div class="form-group">
                                <label class="custom-switch ends_at-toggle" id="emojiToggle">
                                <input type="checkbox" name="rating" class="custom-switch-input" value="1" <?= $widgetRating == '' ? '' : 'checked' ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Enable ratings</span>
                                </label>
                                <small class="form-text text-muted">
                                Give users the ability to provide a rating, along with additional feedback.
                                </small>
                             </div>
                             <div class="form-group">
                                <label class="custom-switch ends_at-toggle">
                                <input type="checkbox" name="emailField" class="custom-switch-input" value="1" <?= $widgetPrivacy == '1' ? 'disabled' : ($widgetEmailField ? 'checked' : '') ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Email field required</span>
                                </label>
                                <small class="form-text text-muted">
                                Require users to provide an email address before submitting feedback.
                                </small>
                             </div>
                             <div class="form-group">
                                <label>Button text <small class="form-text text-muted d-inline"><a href="#" class="ml-1 text-dark" data-toggle="modal" data-target="#whatIsThisFeedbackBtn">(What's this?)</a></small></label>
                                <input type="text" class="form-control" name="buttonText" value="<?= clean($widgetButtonText) ?>" required>
                             </div>
                            <input type="hidden" name="submit" value="<?= $_GET["campaign"]; ?>">
                         </div>
                       </div>
                     </div>
                     <div class="col-lg-7 pl-3 pl-10 ml-10">
                            <div class="row mb-4">
                              <div class="col-md-6">
                                <a href="#" id="buttonDefault" class="btn btn-light btn-block"><i class="fas fa-list mr-2"></i> Form</a>
                              </div>
                            <div class="col-md-6">
                              <a href="#" id="buttonThankyou" class="btn btn-light btn-block"><i class="fas fa-check-circle mr-2"></i> Confirmation</a>
                            </div>
                          </div>
                            <div class="card pl-0 pr-0 pt-5 pb-6 preview cf-widget" id="default">
                             <div class="lw-widget lw-widget_fullscreen d-block">
                                <div class="lw-container lw-container_md d-block">
                                   <div class="d-inline" style="--theme-color:<?= clean($widgetAccent) ?>">
                                      <div class="lw-wrap">
                                          <div id="widgetHeader">
                                         <div class="lw-logo lw-logo_icon lw-logo_center lw-mb-md iconBlock">
                                            <div class="lw-preview accentApply "><i class="far fa-comment faIcon"></i></div>
                                         </div>
                                         <input type="hidden" name="title" id="titleTextarea" value="<?= clean($widgetTitle) ?>" required>
                                         <div class="lw-title lw-title_lg widgetTitle" placeholder="Enter a title here" id="titleFiller" contenteditable="true"><?= clean($widgetTitle) ?></div>
                                         <input type="hidden" name="subtitle" id="subtitleTextarea" value="<?= clean($widgetSubtitle) ?>" required>
                                         <div class="lw-content lw-mb-sm widgetSubtitle" placeholder="Enter a subtitle here" id="subtitleFiller" contenteditable="true"><?= clean($widgetSubtitle) ?></div>
                                       </div>
                                         <div id="response">
                                           <div id="emojiContainer" <?= $widgetRating == '' ? 'class="d-none"' : '' ?>>
                                            <div class="lw-title lw-title_sm lw-mb-sm rateTitle">Rate your experience</div>
                                            <div class="lw-tags lw-mb-sm emojiContainer">
                                               <div class="lw-tags-item lw-active"><i class="fad fa-grin-hearts"></i></div>
                                               <div class="lw-tags-item"><i class="fad fa-grin"></i></div>
                                               <div class="lw-tags-item"><i class="fad fa-meh"></i></div>
                                               <div class="lw-tags-item"><i class="fad fa-frown"></i></div>
                                               <div class="lw-tags-item"><i class="fad fa-angry"></i></div>
                                            </div>
                                          </div>
                                            <input type="text" id="rateValue" value="5" hidden>
                                            <div class="lw-mb-md">
                                              <?php if ($widgetPrivacy !== "1") { ?>
                                               <div class="lw-field lw-mb">
                                                  <div class="lw-icon"><i class="fas fa-envelope"></i></div>
                                                  <input class="lw-input mb-3"  type="email" name="email" placeholder="Email address" readonly>
                                               </div>
                                               <?php } ?>
                                               <div class="lw-field"><textarea class="lw-textarea" placeholder="Tell us what you think..." readonly></textarea></div>
                                            </div>
                                            <button type="button" class="lw-btn lw-btn_wide accentApply">Send feedback</button>
                                       </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                           </div>
                           <div class="card pl-0 pr-0 pt-5 pb-6 cf-widget" id="thank-you">
                            <div class="lw-widget lw-widget_fullscreen d-block">
                               <div class="lw-container lw-container_md d-block">
                                  <div class=" d-inline">
                                     <div class="lw-wrap">
                                       <input type="hidden" name="tyTitle" id="tyTitleTextarea" value="<?= clean($widgetTyTitle) ?>" required>
                                       <div class="lw-title lw-title_lg lw-center tyTitle" placeholder="Enter a title here" id="tyTitleFiller" contenteditable="true"><?= clean($widgetTyTitle) ?></div>
                                       <input type="hidden" name="tyMessage" id="tySubtitleTextarea" value="<?= clean($widgetSubtitle) ?>" required>
                                       <div class="lw-content lw-center lw-mb" placeholder="Enter a message here" id="tySubtitleFiller" contenteditable="true"><?= clean($widgetTyMessage) ?></div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                          </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Button text modal -->
            <div class="modal fade" id="whatIsThisFeedbackBtn" tabindex="-1" role="dialog">
               <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <img class="img-fluid" src="https://i.imgur.com/OPtyWeX.png" alt="Image">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include "../includes/footer.php" ?>
         <script type="text/javascript" src="<?= $url ?>/assets/js/editor.js"></script>
      </div>
   </body>
</html>
