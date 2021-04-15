<div class="bg-gray-900 pt-6">
    <nav class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6"
         aria-label="Global">
        <div class="flex items-center flex-1">
            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="/" class="mb-5">
                    <span class="sr-only">Workflow</span>
                    <img class="h-8 w-auto sm:h-10"
                         src="https://tailwindui.com/img/logos/workflow-mark-teal-200-cyan-400.svg" alt="">
                </a>
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button"
                            class="bg-gray-900 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white"
                            aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Heroicon name: outline/menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden md:flex md:items-center md:space-x-6 mb-5">
            @guest()
                <a href="/login" class="text-base font-medium text-white hover:text-gray-300">
                    Log in
                </a>
                <a href="/register" class="text-base font-medium text-white hover:text-gray-300">
                    Register
                </a>
            @else
                @if(auth()->user()->isAdmin())
                    <a href="/admin/dashboard" class="text-base font-medium text-white hover:text-gray-300">
                        Dashboard
                    </a>
                @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <button class="text-white">{{ __('Log out') }}</button>
                    </form>
            @endguest
        </div>
    </nav>
</div>
