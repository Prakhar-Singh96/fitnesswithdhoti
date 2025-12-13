<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('admin/assets/img/logo/suyagya.webp') }}" alt="Logo" width="200">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        {{-- Dashboard --}}
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Store Management</span>
        </li>

        {{-- Products --}}
        <li class="menu-item {{ request()->is('admin/products*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div>Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.products.index') }}" class="menu-link">
                        Product List
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.products.create') }}" class="menu-link">
                        Add Product
                    </a>
                </li>
            </ul>
        </li>

        {{-- Categories & Sub Categories --}}
        <li
            class="menu-item {{ request()->is('admin/categories*') || request()->is('admin/subcategories*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        Category List
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.categories.create') }}" class="menu-link">
                        Add Category
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.subcategories.index') }}" class="menu-link">
                        Sub-Category List
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.subcategories.create') }}" class="menu-link">
                        Add Sub-Category
                    </a>
                </li>
            </ul>
        </li>

        {{-- Filters --}}
        <li
            class="menu-item {{ request()->is('admin/filters*') || request()->is('admin/filter-values*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-filter-alt"></i>
                <div>Filters</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.filters.index') }}" class="menu-link">
                        Filters List
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.filters.create') }}" class="menu-link">
                        Add Filter
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.filter-values.index') }}" class="menu-link">
                        Filter Values
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.filter-values.create') }}" class="menu-link">
                        Add Filter Value
                    </a>
                </li>
            </ul>
        </li>

        {{-- Orders --}}
        <li class="menu-item {{ request()->is('admin/orders*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div>Orders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                        Order List
                    </a>
                </li>
            </ul>
        </li>

        {{-- Customers --}}
        <li class="menu-item {{ request()->is('admin/customers*') ? 'active' : '' }}">
            <a href="{{ route('admin.customers.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Customers</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/payment*') ? 'active' : '' }}">
            <a href="{{ route('admin.payment.settings') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Payment Settings</div>
            </a>
        </li>

    </ul>
</aside>
