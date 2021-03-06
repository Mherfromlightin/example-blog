<!--
      Mobile menu, show/hide based on menu open state.

      Entering: "duration-150 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
      Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
<div class="absolute top-0 inset-x-0 p-2 transition transform origin-top md:hidden">
    <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
        <div class="px-5 pt-4 flex items-center justify-between">
            <div>
                <img class="h-8 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-mark-teal-500-cyan-600.svg" alt="">
            </div>
            <div class="-mr-2">
                <button type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-600">
                    <span class="sr-only">Close menu</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="pt-5 pb-6">
            <div class="px-2 space-y-1">
                <a href="#"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Product</a>

                <a href="#"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Features</a>

                <a href="#"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Marketplace</a>

                <a href="#"
                   class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Company</a>
            </div>
            <div class="mt-6 px-5">
                <a href="#"
                   class="block text-center w-full py-3 px-4 rounded-md shadow bg-gradient-to-r from-teal-500 to-cyan-600 text-white font-medium hover:from-teal-600 hover:to-cyan-700">Start
                    free trial</a>
            </div>
            <div class="mt-6 px-5">
                @guest()
                    <p class="text-center text-base font-medium text-gray-500">Existing customer?
                        <a href="/login" class="text-gray-900 hover:underline">Login</a>
                    </p>
                @else
                    <p class="text-center text-base font-medium text-gray-500">
                        <a href="/dashboard" class="text-gray-900 hover:underline">Dashboard</a>
                    </p>
                @endguest
            </div>
        </div>
    </div>
</div>
