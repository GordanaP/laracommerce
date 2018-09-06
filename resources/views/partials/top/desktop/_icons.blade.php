<div class="header-icons">
    <a href="#" class="header-wrapicon1 dis-block">
        <img src="{{ asset('vendor/fashe-colorlib/images/icons/icon-header-01.png') }}" class="header-icon1" alt="ICON">
    </a>

    <span class="linedivide1"></span>

    <a href="{{ route('carts.show') }}" class="header-wrapicon2">
        <img src="{{ asset('vendor/fashe-colorlib/images/icons/icon-header-02.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <span class="header-icons-noti">{{ Cart::instance('default')->count() }}</span>
    </a>

    <span class="linedivide1"></span>

    <a href="{{ route('wishlist.show') }}" class="header-wrapicon3 mt-3">
        <span class="lnr lnr-heart text-2xl text-grey"></span>
        <span class="header-icons-noti" style="margin-top: 10px;">{{ Cart::instance(config('constants.wishcart'))->count() }}</span>
    </a>
</div>