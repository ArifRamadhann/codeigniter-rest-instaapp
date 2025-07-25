<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= assets('vendor/libs/popper/popper.js') ?>"></script>
<script src="<?= assets('vendor/js/bootstrap.js') ?>"></script>
<script src="<?= assets('vendor/libs/node-waves/node-waves.js') ?>"></script>
<script src="<?= assets('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
<script src="<?= assets('vendor/libs/hammer/hammer.js') ?>"></script>

<script src="<?= assets('vendor/js/menu.js') ?>"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<?php if(isset($options['additional_js'])): ?>
    <?php foreach($options['additional_js'] as $js): ?>
        <script src="<?= assets($js) ?>"></script>
    <?php endforeach; ?>
<?php endif ?>

<!-- Main JS -->
<script src="<?= assets('js/main.js') ?>"></script>

<!-- Page JS -->
 <?php if(isset($options['page_js'])): ?>
    <?php foreach($options['page_js'] as $js): ?>
        <script src="<?= assets($js) ?>"></script>
    <?php endforeach; ?>
<?php endif ?>