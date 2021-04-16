<div class="bg-gray-900 pt-6">
    <nav class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6"
         aria-label="Global">
        <div class="mb-7 flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img class="hidden lg:block h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
                </a>
            </div>
            <div class="hidden sm:block sm:ml-6">
                <div class="flex space-x-4">
                    @if(!auth()->user()->isAdmin())
                        <a href="/articles" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                           aria-current="page">My Articles</a>
                    @endif
                        <a href="/articles/create" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                           aria-current="page">Create Article</a>
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
