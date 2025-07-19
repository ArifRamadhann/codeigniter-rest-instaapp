<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
        <i class="ri-menu-fill ri-22px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <h4 class="m-0"><?= $title ?></h4>
        </div>
        
        <!-- Style Switcher -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a
                class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <i class="ri-22px"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                    <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                    <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                    <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
        <!-- / Style Switcher-->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
                <img src="<?= assets('uploads/' . ($this->user_data->profile_picture ?? 'placeholder.jpg')) ?>" alt class="rounded-circle" />
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-2">
                    <div class="avatar avatar-online">
                        <img src="<?= assets('uploads/' . ($this->user_data->profile_picture ?? 'placeholder.jpg')) ?>" alt class="rounded-circle" />
                    </div>
                    </div>
                    <div class="flex-grow-1">
                    <span class="fw-medium d-block"><?= $this->user_data->full_name ?></span>
                    <small class="text-muted">@<?= $this->user_data->username ?></small>
                    </div>
                </div>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <a class="dropdown-item" href="<?= base_url('profile/settings') ?>">
                <i class="ri-settings-4-line me-3"></i><span class="align-middle">Profile Settings</span>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <a class="dropdown-item" href="<?= base_url('feed/logout') ?>">
                <i class="ri-shut-down-line me-3"></i>
                <span class="align-middle">Log Out</span>
                </a>
            </li>
            </ul>
        </li>
        <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->