<x-layouts::app :title="__('Budget')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-1">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Budget</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Track your monthly budget goals — March 2026.
                </p>
            </div>
            <div class="flex items-center gap-3 self-start">
                <div
                    class="px-3 py-1.5 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-sm text-zinc-600 dark:text-zinc-400">
                    Mar 1 – Mar 31
                </div>
                <button
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Budget
                </button>
            </div>
        </div>

        {{-- Summary Banner --}}
        <div
            class="rounded-2xl bg-linear-to-br from-purple-600 via-purple-500 to-indigo-600 p-5 shadow-lg text-white">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-sm text-purple-200">Total Budgeted</p>
                    <p class="mt-1 text-2xl font-bold">$4,500</p>
                </div>
                <div class="border-x border-purple-400/40">
                    <p class="text-sm text-purple-200">Spent So Far</p>
                    <p class="mt-1 text-2xl font-bold">$2,640</p>
                </div>
                <div>
                    <p class="text-sm text-purple-200">Remaining</p>
                    <p class="mt-1 text-2xl font-bold">$1,860</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex justify-between text-xs text-purple-200 mb-1.5">
                    <span>58.7% used</span>
                    <span>3 days remaining</span>
                </div>
                <div class="h-2 bg-purple-400/30 rounded-full overflow-hidden">
                    <div class="h-full bg-white rounded-full" style="width: 58.7%"></div>
                </div>
            </div>
        </div>

        {{-- Budget Categories --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @php
                $budgets = [
                    ['cat' => 'Housing', 'icon' => '🏠', 'budget' => 1400, 'spent' => 1350, 'color' => 'purple'],
                    ['cat' => 'Food & Groceries', 'icon' => '🛒', 'budget' => 600, 'spent' => 387, 'color' => 'blue'],
                    ['cat' => 'Transport', 'icon' => '🚗', 'budget' => 300, 'spent' => 143, 'color' => 'emerald'],
                    ['cat' => 'Entertainment', 'icon' => '🎬', 'budget' => 150, 'spent' => 165, 'color' => 'amber'],
                    ['cat' => 'Utilities', 'icon' => '⚡', 'budget' => 200, 'spent' => 94, 'color' => 'cyan'],
                    ['cat' => 'Health & Fitness', 'icon' => '💪', 'budget' => 100, 'spent' => 45, 'color' => 'rose'],
                    ['cat' => 'Savings', 'icon' => '🏦', 'budget' => 1500, 'spent' => 400, 'color' => 'green'],
                    ['cat' => 'Shopping', 'icon' => '👗', 'budget' => 250, 'spent' => 56, 'color' => 'fuchsia'],
                ];
            @endphp

            @foreach ($budgets as $b)
                @php
                    $pct = min(100, round(($b['spent'] / $b['budget']) * 100));
                    $over = $b['spent'] > $b['budget'];
                    $remaining = $b['budget'] - $b['spent'];
                    $barColor = $over ? 'bg-red-500' : match ($b['color']) {
                        'purple' => 'bg-purple-500',
                        'blue' => 'bg-blue-500',
                        'emerald' => 'bg-emerald-500',
                        'amber' => 'bg-amber-500',
                        'cyan' => 'bg-cyan-500',
                        'rose' => 'bg-rose-500',
                        'green' => 'bg-green-500',
                        'fuchsia' => 'bg-fuchsia-500',
                        default => 'bg-zinc-500',
                    };
                @endphp
                <div
                    class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-lg">
                                {{ $b['icon'] }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $b['cat'] }}</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">Budget:
                                    ${{ number_format($b['budget']) }}</p>
                            </div>
                        </div>
                        @if ($over)
                            <span
                                class="text-xs font-semibold text-red-500 bg-red-50 dark:bg-red-900/20 px-2 py-0.5 rounded-full">Over!</span>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <div class="h-2.5 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full {{ $barColor }} transition-all" style="width: {{ $pct }}%">
                            </div>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="{{ $over ? 'text-red-500' : 'text-zinc-500 dark:text-zinc-400' }}">
                                ${{ number_format($b['spent']) }} spent
                            </span>
                            <span class="{{ $over ? 'text-red-500 font-medium' : 'text-zinc-500 dark:text-zinc-400' }}">
                                @if ($over)
                                    ${{ number_format(abs($remaining)) }} over
                                @else
                                    ${{ number_format($remaining) }} left
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tips Card --}}
        <div
            class="rounded-2xl border border-amber-200 dark:border-amber-900/40 bg-amber-50 dark:bg-amber-900/10 p-5 flex gap-4">
            <div class="text-2xl shrink-0">💡</div>
            <div>
                <p class="text-sm font-semibold text-amber-800 dark:text-amber-400">Budget Tip</p>
                <p class="mt-1 text-sm text-amber-700 dark:text-amber-500">
                    Your Entertainment budget is over by <strong>$15</strong>. Consider reducing streaming subscriptions
                    — you're paying for
                    Netflix, Spotify, and a gaming pass simultaneously!
                </p>
            </div>
        </div>

    </div>
</x-layouts::app>