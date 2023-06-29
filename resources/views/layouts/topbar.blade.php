<div class="topbar">
    <div class="toggle">
        <i class="fa-solid fa-bars" id="btn"></i>
    </div>
    <div class="search_wrapper">
        <label>
            <input type="search" class="form-control light-table-filter px-3" data-table="table" placeholder="Cari...">
        </label>
    </div>
    <div class="user_wrapper">
        <span>Tes</span>
        {{-- @if (Auth::user()->avatar == 'default')
            <img src="{{ asset('assets/user/images/user.png') }}" alt="">
        @else
            <img src="{{ asset('user/' . Auth::user()->avatar) }}" alt="">
        @endif --}}
    </div>
</div>
