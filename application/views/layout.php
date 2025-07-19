<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= assets() ?>"
  data-template="vertical-menu-template-starter"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $title ?> | Insta App</title>

    <meta name="description" content="" />
    <?php $this->load->view('components/css-loader', ['options' => $options]) ?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
      <?php $this->load->view('components/sidebar') ?>

        <!-- Layout container -->
        <div class="layout-page">
          
          <?php $this->load->view('components/navbar', ['title' => $title]) ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <?php $this->load->view('pages/'. $page) ?>

            <?php $this->load->view('components/footer') ?>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php $this->load->view('components/js-loader', ['options' => $options]) ?>
  </body>
</html>
