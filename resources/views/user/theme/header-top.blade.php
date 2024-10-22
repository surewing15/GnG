<div class="nk-header nk-header-fixed is-light" style="border-top: 10px solid #e20013">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="/logo.png" srcset="/logo.png 2x" alt="logo">
                    <img class="logo-dark logo-img" src="/logo.png" srcset="/logo.png 2x" alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <!-- Cart Icon -->
                    <li class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="cart-toggle">
                                <div class="cart-icon">
                                    <em class="icon ni ni-cart-fill"></em>
                                    <span id="cart-item-count" class="badge bg-danger">0</span> <!-- Item count -->
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner">
                                <h6>Your Cart</h6>
                                <ul class="link-list" id="cart-items-header">
                                    <li>No items in cart</li> <!-- This will be dynamically updated -->
                                </ul>
                                <div class="dropdown-footer">
                                    <p>Total: ₱<span id="cart-total-header">0.00</span></p>
                                    <a href="html/cart.html" class="btn btn-primary">View Cart</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- User Profile Dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm" style="background-color: #b4543d">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status user-status-active" style="text-transform: uppercase; color: #e20013">ID #: 2019F008</div>
                                    <div class="user-name dropdown-indicator" style="text-transform: uppercase"></div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text"></span>
                                        <span class="sub-text"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="html/lms/admin-profile.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
