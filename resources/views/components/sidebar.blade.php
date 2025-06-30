<div x-data="{
    sidebarOpen: localStorage.getItem('sidebar-open') === null ? true : JSON.parse(localStorage.getItem('sidebar-open')),
    cmsOpen: localStorage.getItem('sidebar-cms-open') === null ? true : JSON.parse(localStorage.getItem('sidebar-cms-open')),
    dashboardOpen: localStorage.getItem('sidebar-dashboard-open') === null ? true : JSON.parse(localStorage.getItem('sidebar-dashboard-open')),

    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebar-open', this.sidebarOpen);
    },
    toggleCms() {
        this.cmsOpen = !this.cmsOpen;
        localStorage.setItem('sidebar-cms-open', this.cmsOpen);
    },
    toggleDashboard() {
        this.dashboardOpen = !this.dashboardOpen;
        localStorage.setItem('sidebar-dashboard-open', this.dashboardOpen);
    }
}" class="flex h-screen">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
        class="bg-gray-700 text-gray-100 flex flex-col transition-width duration-300 ease-in-out">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-700">
            <span class="text-xl font-bold whitespace-nowrap" x-show="sidebarOpen" x-transition>
                Admin Activities
            </span>

            <!-- Hamburger Button -->
            <button @click="toggleSidebar()" class="text-gray-300 focus:outline-none " aria-label="Toggle sidebar">
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-2 py-4 overflow-y-auto space-y-4">

            <!-- Dashboard Group -->
            <div class="relative group" @mouseenter="!sidebarOpen && (dashboardOpen = true)"
                @mouseleave="!sidebarOpen && (dashboardOpen = false)">
                <button @click="toggleDashboard()"
                    class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    <div class="flex items-center space-x-3">
                        <i class="bi bi-speedometer2 h-6 w-6"></i>
                        <span x-show="sidebarOpen" x-transition class="font-semibold">Dashboard</span>
                    </div>
                    <svg :class="dashboardOpen ? 'transform rotate-90' : ''"
                        class="h-5 w-5 text-gray-300 transition-transform duration-200" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Floating Dropdown (collapsed) -->
                <div x-show="dashboardOpen" x-transition x-cloak
                    class="absolute left-full top-0 ml-1 w-48 bg-gray-800 rounded-md shadow-lg z-50 space-y-1 py-2"
                    :class="!sidebarOpen ? 'block' : 'hidden'">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-slate-600 hover:text-white rounded-md">
                        <i class="bi bi-house h-5 w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-slate-600 hover:text-white rounded-md">
                        <i class="bi bi-globe h-5 w-5"></i>
                        <span>Main Website</span>
                    </a>
                </div>

                <!-- Expanded Sidebar Dropdown -->
                <div x-show="dashboardOpen && sidebarOpen" x-transition class="pl-9 space-y-1" style="display: none;">
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 rounded-md text-gray-300 hover:bg-slate-600 hover:text-white transition
                        {{ request()->routeIs('dashboard') ? 'bg-slate-500 text-white' : '' }}">
                        <i class="bi bi-house h-6 w-6"></i> Dashboard
                    </a>
                    <a href="{{ route('home') }}"
                        class="block px-3 py-2 rounded-md text-gray-300 hover:bg-slate-600 hover:text-white transition
                        {{ request()->routeIs('home') ? 'bg-slate-600 text-whtite' : '' }}">
                        <i class="bi bi-globe h-6 w-6"></i> Main Website
                    </a>
                </div>
            </div>

            <!-- CMS Group -->
            <div class="relative group" @mouseenter="!sidebarOpen && (cmsOpen = true)"
                @mouseleave="!sidebarOpen && (cmsOpen = false)">
                <button @click="toggleCms()"
                    class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    <div class="flex items-center space-x-3">
                        <i class="bi bi-folder-fill h-6 w-6"></i>
                        <span x-show="sidebarOpen" x-transition class="font-semibold">Content Management</span>
                    </div>
                    <svg :class="cmsOpen ? 'transform rotate-90' : ''"
                        class="h-5 w-5 text-gray-300 transition-transform duration-200" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Floating Dropdown (collapsed) -->
                <div x-show="cmsOpen" x-transition x-cloak
                    class="absolute left-full top-0 ml-1 w-48 bg-gray-800 rounded-md shadow-lg z-50 space-y-1 py-2"
                    :class="!sidebarOpen ? 'block' : 'hidden'">
                    <a href="{{ route('cms.content.createContent') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-slate-600 hover:text-white rounded-md">
                        <i class="bi bi-file-earmark-plus h-5 w-5"></i>
                        <span>Create Content</span>
                    </a>
                    <a href="{{ route('cms.slides.cms-slide-form') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-slate-600 hover:text-white rounded-md">
                        <i class="bi bi-images h-5 w-5"></i>
                        <span>Create Slide</span>
                    </a>
                    <a href="{{ route('cms.service.cms-service-form') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-slate-600 hover:text-white rounded-md">
                        <i class="bi bi-gear-fill h-5 w-5"></i>
                        <span>Create Service</span>
                    </a>
                </div>

                <!-- Expanded Sidebar Dropdown -->
                <div x-show="cmsOpen && sidebarOpen" x-transition class="pl-9 space-y-1" style="display: none;">
                    <a href="{{ route('cms.content.createContent') }}"
                        class="block px-3 py-2 rounded-md text-gray-300 hover:bg-slate-600 hover:text-white transition
                        {{ request()->routeIs('cms.content.createContent') ? 'bg-slate-500 text-white' : '' }}">
                        <i class="bi bi-file-earmark-plus h-6 w-6"></i> Create Content
                    </a>
                    <a href="{{ route('cms.slides.cms-slide-form') }}"
                        class="block px-3 py-2 rounded-md text-gray-300 hover:bg-slate-600 hover:text-white transition
                        {{ request()->routeIs('cms.slides.cms-slide-form') ? 'bg-slate-500 text-white' : '' }}">
                        <i class="bi bi-images h-6 w-6"></i> Create Slide
                    </a>
                    <a href="{{ route('cms.service.cms-service-form') }}"
                        class="block px-3 py-2 rounded-md text-gray-300 hover:bg-slate-600 hover:text-white transition
                        {{ request()->routeIs('cms.service.cms-service-form') ? 'bg-slate-500 text-white' : '' }}">
                        <i class="bi bi-gear-fill h-6 w-6"></i> Create Service
                    </a>
                </div>
            </div>

            <!-- Other Links -->
            <a href="{{ route('testimonial.submit-testimonial') }}"
                class="flex items-center space-x-3 px-3 py-2 rounded-md transition-colors duration-200
                   {{ request()->routeIs('testimonial.submit-testimonial') ? 'bg-slate-500 text-white' : 'text-gray-300 hover:bg-slate-600 hover:text-white' }}">
                <i class="bi bi-chat-left-text-fill h-6 w-6"></i>
                <span x-show="sidebarOpen" x-transition> Write Testimonial </span>
            </a>

            <a href="{{ route('article.create-article') }}"
                class="flex items-center space-x-3 px-3 py-2 rounded-md transition-colors duration-200
                   {{ request()->routeIs('article.create-article') ? 'bg-slate-500 text-white' : 'text-gray-300 hover:bg-slate-600 hover:text-white' }}">
                <i class="bi bi-newspaper h-6 w-6"></i>
                <span x-show="sidebarOpen" x-transition> Create Article </span>
            </a>
            <!-- Sidebar Footer -->
            <div class="mt-auto px-4 py-3 text-xs text-gray-400 border-t border-gray-600">
                <span x-show="sidebarOpen" x-transition>&copy; {{ \Carbon\Carbon::now()->format('Y') }} All rights
                    reserved.</span>
                <span x-show="!sidebarOpen" x-transition>&copy;</span>
            </div>


        </nav>
    </aside>

    <!-- Main content area -->
    <div :class="sidebarOpen ? 'ml-64' : 'ml-16'"
        class="flex-1 transition-margin duration-300 ease-in-out overflow-auto">
        {{ $slot }}

    </div>

</div>
