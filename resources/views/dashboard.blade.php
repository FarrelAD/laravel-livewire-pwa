<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-1">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Good morning,
                    {{ auth()->user()->name }} 👋</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Here's what's happening with your finances
                    today.</p>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            @foreach ([
                    ['label' => 'Total Balance', 'value' => '$24,563.00', 'change' => '+2.4%', 'up' => true, 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'purple'],
                    ['label' => 'Monthly Income', 'value' => '$8,240.00', 'change' => '+5.1%', 'up' => true, 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'green'],
                    ['label' => 'Monthly Expenses', 'value' => '$3,891.50', 'change' => '-1.8%', 'up' => false, 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'red'],
                    ['label' => 'Savings Rate', 'value' => '52.7%', 'change' => '+3.2%', 'up' => true, 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'blue'],
                ] as $card)
                <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-5 flex flex-col gap-3 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $card['label'] }}</span>
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center
                            {{ $card['color'] === 'purple' ? 'bg-purple-100 dark:bg-purple-900/30' : '' }}
                            {{ $card['color'] === 'green' ? 'bg-green-100 dark:bg-green-900/30' : '' }}
                            {{ $card['color'] === 'red' ? 'bg-red-100 dark:bg-red-900/30' : '' }}
                            {{ $card['color'] === 'blue' ? 'bg-blue-100 dark:bg-blue-900/30' : '' }}
                        ">
                            <svg class="w-5 h-5
                                {{ $card['color'] === 'purple' ? 'text-purple-600 dark:text-purple-400' : '' }}
                                {{ $card['color'] === 'green' ? 'text-green-600 dark:text-green-400' : '' }}
                                {{ $card['color'] === 'red' ? 'text-red-600 dark:text-red-400' : '' }}
                                {{ $card['color'] === 'blue' ? 'text-blue-600 dark:text-blue-400' : '' }}
                            " fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>

                             </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $card['value'] }}</p>
                        <p class="mt-1 text-xs font-medium {{ $card['up'] ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                            {{ $card['change'] }} vs last month
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

  
                     {{-- Bottom Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 flex-1">

                       
            {{-- Recent Transactions --}}
            <div class="lg:col-span-2 rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Recent Transactions</h2>
                    <a href=
"                           {{ route('transactions') }}" class="text-sm text-purple-600 dark:text-purple-400 hover:underline" wire:navigate>View all</a>
                </div>
                <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @foreach ([
                            ['name' => 'Netflix', 'cat' => 'Entertainment', 'date' => 'Today, 9:41 AM', 'amount' => '-$15.99', 'out' => true, 'icon' => '🎬'],
                            ['name' => 'Salary Deposit', 'cat' => 'Income', 'date' => 'Today, 8:00 AM', 'amount' => '+$4,120.00', 'out' => false, 'icon' => '💰'],
                            ['name' => 'Whole Foods', 'cat' => 'Groceries', 'date' => 'Yesterday', 'amount' => '-$87.43', 'out' => true, 'icon' => '🛒'],
                            ['name' => 'Uber', 'cat' => 'Transport', 'date' => 'Yesterday', 'amount' => '-$12.50', 'out' => true, 'icon' => '🚗'],
                            ['name' => 'Freelance Payment', 'cat' => 'Income', 'date' => 'Mar 1', 'amount' => '+$850.00', 'out' => false, 'icon' => '💻'],
                            ['name' => 'Electric Bill', 'cat' => 'Utilities', 'date' => 'Mar 1', 'amount' => '-$94.20', 'out' => true, 'icon' => '⚡'],
                        ] as $tx)
                        <div class="flex items-center gap-4 px-5 py-3.5">
                            <div class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-lg shrink-0">
                                {{ $tx['icon'] }}
                            </div>
                            <div class="flex-1 min-w-0">

                               <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100 truncate">{{ $tx['name'] }}</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $tx['cat'] }} · {{ $tx['date'] }}</p>
                            </div>
                            <span class="text-sm font-semibold shrink-0 {{ $tx['out'] ? 'text-zinc-900 dark:text-zinc-100' : 'text-green-600 dark:text-green-400' }}">
                                {{ $tx['amount'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Spending Breakdown --}}
            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800">

                                                <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Spending Breakdown</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">March 2026</p>
                </div>
                <div class="p-5 space-y-4">
                    @foreach ([
                            ['label' => 'Housing', 'pct' => 35, 'amount' => '$1,365', 'color' => 'bg-purple-500'],
                            ['label' => 'Food & Groceries', 'pct' => 22, 'amount' => '$857', 'color' => 'bg-blue-500'],
                            ['label' => 'Transport', 'pct' => 14, 'amount' => '$545', 'color' => 'bg-emerald-500'],
                            ['label' => 'Entertainment', 'pct' => 11, 'amount' => '$429', 'color' => 'bg-amber-500'],
                            ['label' => 'Utilities', 'pct' => 10, 'amount' => '$390', 'color' => 'bg-rose-500'],
                            ['label' => 'Other', 'pct' => 8, 'amount' => '$306', 'color' => 'bg-zinc-400'],
                        ] as $item)
                        <div class="space-y-1.5">
                            <div class="flex justify-between text-sm">
                                <span class="text-zinc-600 dark:text-zinc-400">{{ $item['label'] }}</span>
                                <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $item['amount'] }}</span>
                            </div>
                            <div class="h-2 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full rounded-full {{ $item['color'] }}" style="width: {{ $item['pct'] }}%"></div>
                            </div>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $item['pct'] }}% of spend</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-layouts::app>

