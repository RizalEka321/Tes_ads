<div class="sidebar">
    <div class="logo_details">
        <i class='bx bx-code-alt'></i>
        <div class="logo_name">
            Admin
        </div>
    </div>
    <ul>
        {{-- <li>
            <a href="{{ route('dashboard.admin') }}" class="nav-link {{ set_active('dashboard.admin') }}">
                <i class='bx bxs-dashboard'></i>
                <span class="links_name">
                    Dashboard
                </span>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('category') }}" class="nav-link {{ set_active(['category', 'category.add', 'category.edit']) }}" id="category">
                <i class="fa-solid fa-bookmark"></i>
                <span class="links_name">
                    Kategori
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('product') }}"
                class="nav-link {{ set_active(['product', 'product.add', 'product.edit']) }}" id="product">
                <i class="fa-solid fa-box-open"></i>
                <span class="links_name">
                    Produk
                </span>
            </a>
        </li>
        <li class="login">
            <a href="#">
                <span class="links_name login_out">
                    Logout
                </span>
                <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
