 <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?= assets('img/favicon/favicon.ico') ?>" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
    rel="stylesheet" />

<link rel="stylesheet" href="<?= assets('vendor/fonts/remixicon/remixicon.css') ?>" />
<link rel="stylesheet" href="<?= assets('vendor/fonts/flag-icons.css') ?>" />

<!-- Menu waves for no-customizer fix -->
<link rel="stylesheet" href="<?= assets('vendor/libs/node-waves/node-waves.css') ?>" />

<!-- Core CSS -->
<link rel="stylesheet" href="<?= assets('vendor/css/rtl/core.css') ?>" class="template-customizer-core-css" />
<link rel="stylesheet" href="<?= assets('vendor/css/rtl/theme-default.css') ?>" class="template-customizer-theme-css" />
<link rel="stylesheet" href="<?= assets('css/demo.css') ?>" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="<?= assets('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />
<script src="<?= assets('vendor/libs/jquery/jquery.js') ?>"></script>
<?php if(isset($options['additional_css'])): ?>
    <?php foreach($options['additional_css'] as $css): ?>
        <link rel="stylesheet" href="<?= assets($css) ?>" />
    <?php endforeach; ?>
<?php endif ?>

<!-- Page CSS -->
<?php if(isset($options['page_css'])): ?>
    <?php foreach($options['page_css'] as $css): ?>
        <link rel="stylesheet" href="<?= assets($css) ?>" />
    <?php endforeach; ?>
<?php endif ?>

<!-- Helpers -->
<script src="<?= assets('vendor/js/helpers.js') ?>"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="<?= assets('vendor/js/template-customizer.js') ?>"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="<?= assets('js/config.js') ?>"></script>