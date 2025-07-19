<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= assets() ?>"
  data-template="vertical-menu-template"
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
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
        <div class="authentication-inner py-6">
            
            <?php $this->load->view('pages/'. $page) ?>

        </div>
      </div>
    </div>

    <!-- / Content -->
    <?php $this->load->view('components/js-loader', ['options' => $options]) ?>
  </body>
</html>
