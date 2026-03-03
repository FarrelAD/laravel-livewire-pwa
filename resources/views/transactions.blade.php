<x-layouts::app :title="__('Transactions')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-1">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Transactions</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">All your financial activity in one place.</p>
            </div>
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition-colors self-start">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add Transaction
            </button>
        </div>

        {{-- Filters --}}
        <div class="flex flex-wrap gap-2">
            @foreach (['All', 'Income', 'Expenses', 'Transfers'] as $filter)
            <button class="px-4 py-1.5 rounded-full text-sm font-medium border transition-colors
                {{ $filter === 'All'
                    ? 'bg-purple-600 text-white border-purple-600'
                    : 'bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-purple-400' }}
            ">{{ $filter }}</button>
            @endforeach
            <button class="ml-auto px-4 py-1.5 rounded-full text-sm font-medium border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 hover:border-purple-400 inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter
            </button>
        </div>

        {{-- Table --}}
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">

            {{-- Table Header --}}
            <div class="hidden sm:grid grid-cols-[2fr_1fr_1fr_1fr] px-5 py-3 border-b border-zinc-100 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                <span>Description</span>
                <span>Category</span>
                <span>Date</span>
                <span class="text-right">Amount</span>
            </div>

            {{-- Month Group: March 2026 --}}
            <div class="px-5 py-2 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/50">
                <span class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">March 2026</span>
            </div>

            @foreach ([
                ['name' => 'Netflix Subscription', 'cat' => 'Entertainment', 'date' => 'Mar 3', 'amount' => '-$15.99', 'out' => true, 'icon' => '🎬'],
                ['name' => 'Salary Deposit', 'cat' => 'Income', 'date' => 'Mar 3', 'amount' => '+$4,120.00', 'out' => false, 'icon' => '💰'],
                ['name' => 'Whole Foods Market', 'cat' => 'Groceries', 'date' => 'Mar 2', 'amount' => '-$87.43', 'out' => true, 'icon' => '🛒'],
                ['name' => 'Uber Ride', 'cat' => 'Transport', 'date' => 'Mar 2', 'amount' => '-$12.50', 'out' => true, 'icon' => '🚗'],
                ['name' => 'Freelance Payment', 'cat' => 'Income', 'date' => 'Mar 1', 'amount' => '+$850.00', 'out' => false, 'icon' => '💻'],
                ['name' => 'Electric Bill', 'cat' => 'Utilities', 'date' => 'Mar 1', 'amount' => '-$94.20', 'out' => true, 'icon' => '⚡'],
                ['name' => 'Spotify Premium', 'cat' => 'Entertainment', 'date' => 'Mar 1', 'amount' => '-$9.99', 'out' => true, 'icon' => '🎵'],
            ] as $tx)
            <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr_1fr_1fr] items-center gap-2 px-5 py-3.5 border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/40 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-lg shrink-0">
                        {{ $tx['icon'] }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100 truncate">{{ $tx['name'] }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 sm:hidden">{{ $tx['cat'] }} · {{ $tx['date'] }}</p>
                    </div>
                </div>
                <span class="hidden sm:block text-sm text-zinc-500 dark:text-zinc-400">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-zinc-100 dark:bg-zinc-800 font-medium">{{ $tx['cat'] }}</span>
                </span>
                <span class="hidden sm:block text-sm text-zinc-500 dark:text-zinc-400">{{ $tx['date'] }}</span>
                <span class="sm:text-right text-sm font-semibold {{ $tx['out'] ? 'text-zinc-900 dark:text-zinc-100' : 'text-green-600 dark:text-green-400' }}">
                    {{ $tx['amount'] }}
                </span>
            </div>
            @endforeach

            {{-- Month Group: February 2026 --}}
            <div class="px-5 py-2 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/50">
                <span class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">February 2026</span>
            </div>

            @foreach ([
                ['name' => 'Amazon Purchase', 'cat' => 'Shopping', 'date' => 'Feb 28', 'amount' => '-$143.60', 'out' => true, 'icon' => '📦'],
                ['name' => 'Rent Payment', 'cat' => 'Housing', 'date' => 'Feb 28', 'amount' => '-$1,350.00', 'out' => true, 'icon' => '🏠'],
                ['name' => 'Salary Deposit', 'cat' => 'Income', 'date' => 'Feb 28', 'amount' => '+$4,120.00', 'out' => false, 'icon' => '💰'],
                ['name' => 'Gym Membership', 'cat' => 'Health', 'date' => 'Feb 15', 'amount' => '-$45.00', 'out' => true, 'icon' => '💪'],
                ['name' => 'Restaurant Dinner', 'cat' => 'Food', 'date' => 'Feb 14', 'amount' => '-$67.80', 'out' => true, 'icon' => '🍽️'],
            ] as $tx)
            <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr_1fr_1fr] items-center gap-2 px-5 py-3.5 border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/40 transition-colors last:border-b-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-lg shrink-0">
                        {{ $tx['icon'] }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100 truncate">{{ $tx['name'] }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 sm:hidden">{{ $tx['cat'] }} · {{ $tx['date'] }}</p>
                    </div>
                </div>
                <span class="hidden sm:block text-sm text-zinc-500 dark:text-zinc-400">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-zinc-100 dark:bg-zinc-800 font-medium">{{ $tx['cat'] }}</span>
                </span>
                <span class="hidden sm:block text-sm text-zinc-500 dark:text-zinc-400">{{ $tx['date'] }}</span>
                <span class="sm:text-right text-sm font-semibold {{ $tx['out'] ? 'text-zinc-900 dark:text-zinc-100' : 'text-green-600 dark:text-green-400' }}">
                    {{ $tx['amount'] }}
                </span>
            </div>
            @endforeach
        </div>

    </div>
</x-layouts::app>
