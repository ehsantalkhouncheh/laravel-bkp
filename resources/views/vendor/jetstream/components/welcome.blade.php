<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto"/>
    </div>

    <div class="mt-8 text-2xl">
        Welcome to your Indra application!
    </div>

    <div class="mt-6 text-gray-500">
        Indra provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
        to help you build your application using a development environment that is simple, powerful, and enjoyable. We
        believe
        you should love expressing your creativity through programming, so we have spent time carefully crafting the
        Laravel
        ecosystem to be a breath of fresh air. We hope you love it.
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="{{route('permission')}}">Permission</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                In this section you can define or edit all permissions.
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="{{route('role')}}">Role</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                You can manage user roles in this section.
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="{{route('user')}}">User</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                You can manage all users in this section.
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="{{route('layout')}}">Layout</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                You can manage all pages in this section.
            </div>
        </div>
    </div>
</div>
