<div class="nav">
    <nav>
        <div class="logo">
            <h1>Vac community</h1>
        </div>


        <div class="nav__right">
            <div class="nav__right__profile">
                <img src="{{ asset('assets/images/default.jfif') }}" alt="" width="50" height="50">
                <p>{{ Auth::user()->name }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

        </div>
    </nav>
</div>
<script>
    {{ $script ?? '' }}
</script>
