{{-- resources/views/components/layouts/app/sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <x-nav />

    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        {{-- Platform navigation --}}
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item 
                    icon="home" 
                    :href="route('dashboard')" 
                    :current="request()->routeIs('dashboard')" 
                    wire:navigate
                >
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Admin tools --}}
        @php
            $pendingTagCount = \App\Models\Tag::where('status', \App\Models\Tag::STATUS_PENDING)->count();
        @endphp

        @if(auth()->user()?->is_admin)
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Admin Tools')" class="grid">
                    <flux:navlist.item 
                        :href="route('admin.tags.index')" 
                        icon="tag"
                        wire:navigate
                    >
                        {{ __('Moderate Tags') }}
                    </flux:navlist.item>
                    <flux:navlist.item 
                        :href="route('admin.event-types.index')" 
                        icon="list-bullet"
                        wire:navigate
                    >
                        {{ __('Manage Event Types') }}
                    </flux:navlist.item>
                    <flux:navlist.item 
                        :href="route('admin.events.moderate')" 
                        icon="calendar-days" 
                        wire:navigate
                    >
                        {{ __('Moderate Events') }}
                    </flux:navlist.item>

                </flux:navlist.group>
            </flux:navlist>
        @endif

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item 
                icon="folder-git-2" 
                href="https://github.com/laravel/livewire-starter-kit" 
                target="_blank"
            >
                {{ __('Repository') }}
            </flux:navlist.item>
            <flux:navlist.item 
                icon="book-open-text" 
                href="https://laravel.com/docs/starter-kits" 
                target="_blank"
            >
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        {{-- Desktop user menu --}}
        @auth
        <flux:dropdown position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
            />
            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <flux:menu.radio.group>
                    <flux:menu.item 
                        :href="route('settings.profile')" 
                        icon="cog" 
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item 
                        as="button" 
                        type="submit" 
                        icon="arrow-right-start-on-rectangle" 
                        class="w-full"
                    >
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
        @endauth
    </flux:sidebar>

    {{-- Mobile user menu --}}
    @auth
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <flux:menu.radio.group>
                    <flux:menu.item 
                        :href="route('settings.profile')" 
                        icon="cog" 
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item 
                        as="button" 
                        type="submit" 
                        icon="arrow-right-start-on-rectangle" 
                        class="w-full"
                    >
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    @endauth

    {{-- Page content --}}
    <flux:main>
        <div class="max-w-4xl mx-auto px-4 py-8">
            {{ $slot }}
        </div>
    </flux:main>

    {{-- Livewire/Flux scripts --}}
    @fluxScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('tags');
        if (select) {
            $(select).select2({
                placeholder: 'Select or type tags',
                tags: true,
                tokenSeparators: [',']
            });
        }
    });
    </script>
</body>
</html>
