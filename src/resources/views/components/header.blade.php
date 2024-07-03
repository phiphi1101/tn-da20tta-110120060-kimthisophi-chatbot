<meta name="csrf-token" content="{{ csrf_token() }}">

<header class="header header-intro-clearance header-3">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:#" style="color: #fcb941"><i class="icon-phone"
                        style="color: #fcb941"></i>0382533858</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div><!-- End .header-left -->
            <div class="header-left">
                <a href="tel:#" style="color: #fcb941"><i class="icon-envelope"
                        style="color: #fcb941"></i>phiphi@gmail.com</a>
            </div><!-- End .header-left -->
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <ul>
                            <?php
                            use App\Models\Customer;
                            $customer_id = Session::get('customer_id');
                            $google_id = Session::get('google_id');
                            
                            if ($customer_id != NULL) {
                                $user = Customer::where('customer_id', $customer_id)->first();
                            } elseif ($google_id != NULL) {
                                $user = Customer::where('google_id', $google_id)->first();
                            }
                            
                            if (isset($user)) {
                                $customer_name = $user->customer_name;
                            ?>
                            <li><a href="#">{{ $customer_name }}</a></li>
                            <li><a href="{{ URL::to('/logout-checkout') }}">Đăng xuất</a></li>
                            <?php
                            } else {
                            ?>
                            <li><a href="{{ URL::to('/login-checkout') }}">Đăng nhập / Đăng ký</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler" style="color: #fcb941">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars" style="color: #fcb941"></i>
                </button>

                <a href="" class="logo" style="text-align: center; display: block;">
                    <img src="{{ asset('UserLTE/assets/images/icons/Kim’s.png') }}" alt="Molla Logo" width="50"
                        height="10 " style="border-radius: 50%; margin: 0 auto;">
                    <p style="margin: 0; color: #fff"><b>Mani's</b></p>
                    <p style="margin: 0; color: #fff"><b>Stylish Fashion</b></p>
                </a>

            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"
                            style="color: #fcb941"></i></a>
                    <form action="{{ URL::to('/tim_kiem') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" name="search_items" type="submit"><i class="icon-search"
                                    style="color: #fcb941"></i></button>
                            <input type="search" class="form-control" name="keywords_submit" id="q"
                                placeholder="Tìm kiếm sản phẩm ..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>
            <div class="header-right">
                <div class="wishlist">
                    <a href="{{ URL::to('/customer-account') }}" title="My account">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                        <p>Tài khoản</p>
                    </a>
                </div><!-- End .compare-dropdown -->
                <div class="wishlist">
                    <a href="{{ URL::to('/yeu_thich') }}">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            {{-- <span class="wishlist-count badge">3</span> --}}
                        </div>
                        <p>Yêu thích</p>
                    </a>
                </div><!-- End .compare-dropdown -->

                <div class="wishlist">
                    <a href="{{ URL::to('/show-cart') }}">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>

                        </div>
                        <p>Giỏ hàng</p>
                    </a>
                </div><!-- End .cart-dropdown -->

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            @include('components/siderbar')

            @include('components/main_menu')

            <div class="header-right">
                <i class="la la-lightbulb-o" style="color: #fcb941"></i>
                <p style="color: #fcb941">Mani's Stylish Fashion</p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
