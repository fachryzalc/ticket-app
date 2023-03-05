<div class="nav">
    <div class="navContainer">
        <div class="navMenu">
            <div class="navItem">
                <a class="navLinks {{ $page == 'home' ? 'active' : '' }}" href="/">Home</a>
                @if (auth()->user())
                    @if (auth()->user()->is_admin)
                        <a class="navLinks" href="/ticket">Admin</a>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="navBtn btn" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="navLinks {{ $page == 'order' ? 'active' : '' }}" href="/myorders">MyOrders</a>
                        <a class="navLinks {{ $page == 'cart' ? 'active' : '' }}" href="/cart">MyCart</a>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="navBtn btn" type="submit">Logout</button>
                        </form>
                    @endif
                @else
                    <form action="/login" method="get">
                        @csrf
                        <button class="navBtn btn" type="submit">Sign In</button>
                    </form>
                @endif



            </div>
        </div>
    </div>
</div>
