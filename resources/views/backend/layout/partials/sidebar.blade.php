<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.index') }}">
                    <span data-feather="home"></span>
                    Bảng tin <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#loaiSubMenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}">
                    <span data-feather="package"></span>Loại sản phẩm
                </a>
                <ul class="{{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'collapse show' : 'collapse' }}" id="loaiSubMenu">
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.index') }}/">
                            <span data-feather="list"></span>
                            Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.create') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.create') }}">
                            <span data-feather="plus"></span>
                            Thêm mới
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Menu Chủ đề - Start -->
            <li class="nav-item">
                <a href="#chudeSubMenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}">
                    <span data-feather="package"></span> Chủ đề
                </a>
                <ul class="{{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'collapse show' : 'collapse' }}" id="chudeSubMenu">
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.index') }}/">
                            <span data-feather="list"></span>
                            Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.create') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.create') }}">
                            <span data-feather="plus"></span>
                            Thêm mới
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Menu Chủ đề - End -->
            <!-- Menu Sản phẩm - Start -->
            <li class="nav-item">
                <a href="#sanphamSubMenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}">
                    <span data-feather="package"></span> Sản phẩm
                </a>
                <ul class="{{ (strpos(Route::currentRouteName(), 'admin.sanpham.index') === 0) ? 'collapse show' : 'collapse' }}" id="sanphamSubMenu">
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.sanpham.index') === 0) ? 'active' : '' }}" href="{{ route('admin.sanpham.index') }}/">
                            <span data-feather="list"></span>
                            Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.sanpham.create') === 0) ? 'active' : '' }}" href="{{ route('admin.sanpham.create') }}">
                            <span data-feather="plus"></span>
                            Thêm mới
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Menu Sản phẩm - End -->
            <!-- Menu Báo cáo - Start -->
            <li class="nav-item">
                <a href="#baocaoSubMenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}">
                    <span data-feather="package"></span> Báo cáo - Thống kê
                </a>
                <ul class="{{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'collapse show' : 'collapse' }}" id="baocaoSubMenu">
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'admin.loai.index') === 0) ? 'active' : '' }}" href="{{ route('admin.loai.index') }}/">
                            <span data-feather="list"></span>
                            Đơn hàng
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Menu Báo cáo - End -->
        </ul>
    </div>
</nav>