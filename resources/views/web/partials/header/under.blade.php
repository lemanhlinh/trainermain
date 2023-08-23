<div class="menu-head d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="main-menu" id="main-menu">
                    <ul class="list-unstyled text-uppercase">
                        @if(!empty($menus))
                            @foreach ($menus as $shop)
                                @include('web.components.menu.top', ['item'=>$shop])
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled text-uppercase m-0 list-social">
                    <li>
                        <a href="{{ $setting['link_facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="{{ $setting['link_youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="{{ $setting['link_instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="{{ $setting['link_tiktok'] }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
