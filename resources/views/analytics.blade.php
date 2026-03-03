<x-layouts::app :title="__('Analytics')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-1">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Analytics</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Visualize your spending and savings trends.</p>
            </div>
            <div class="flex gap-2 self-start">
                @foreach (['1M', '3M', '6M', '1Y'] as $period)
                <button class="px-3 py-1.5 rounded-lg text-sm font-medium border transition-colors
                    {{ $period === '3M'
                        ? 'bg-purple-600 text-white border-purple-600'
                        : 'bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400' }}
                ">{{ $period }}</button>
                @endforeach
            </div>
        </div>

        {{-- Top KPIs --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ([
                ['label' => 'Avg. Monthly Spend', 'value' => '$3,640', 'sub' => 'Last 3 months'],
                ['label' => 'Avg. Monthly Income', 'value' => '$7,490', 'sub' => 'Last 3 months'],
                ['label' => 'Net Saved', 'value' => '$11,550', 'sub' => 'Last 3 months'],
                ['label' => 'Top Category', 'value' => 'Housing', 'sub' => '35% of spend'],
            ] as $kpi)
            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-4 shadow-sm">
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $kpi['label'] }}</p>
                <p class="mt-1 text-xl font-bold text-zinc-900 dark:text-zinc-100">{{ $kpi['value'] }}</p>
                <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $kpi['sub'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Charts Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            {{-- Income vs Expenses Bar Chart (CSS-drawn) --}}
            <div class="lg:col-span-2 rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Income vs Expenses</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Jan – Mar 2026</p>
                </div>
                <div class="px-5 pb-5 pt-4">
                    <div class="flex items-end justify-around gap-4 h-48">
                        @php
                        $months = [
                            ['month' => 'Jan', 'income' => 72, 'expense' => 48],
                            ['month' => 'Feb', 'income' => 85, 'expense' => 52],
                            ['month' => 'Mar', 'income' => 100, 'expense' => 47],
                        ];
                        @endphp
                        @foreach ($months as $m)
                        <div class="flex-1 flex flex-col items-center gap-2">
                            <div class="w-full flex items-end justify-center gap-2 h-40">
                                <div class="flex flex-col items-center gap-1 flex-1">
                                    <span class="text-xs text-purple-600 dark:text-purple-400 font-medium">{{ $m['income'] }}%</span>
                                    <div class="w-full rounded-t-lg bg-purple-500 transition-all" style="height: {{ $m['income'] * 0.38 }}px"></div>
                                </div>
                                <div class="flex flex-col items-center gap-1 flex-1">
                                    <span class="text-xs text-rose-500 dark:text-rose-400 font-medium">{{ $m['expense'] }}%</span>
                                    <div class="w-full rounded-t-lg bg-rose-400 transition-all" style="height: {{ $m['expense'] * 0.38 }}px"></div>
                                </div>
                            </div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 font-medium">{{ $m['month'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-center gap-6 mt-4">
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-purple-500"></div><span class="text-xs text-zinc-500 dark:text-zinc-400">Income</span></div>
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-rose-400"></div><span class="text-xs text-zinc-500 dark:text-zinc-400">Expenses</span></div>
                    </div>
                </div>
            </div>

            {{-- Category Donut (CSS rings) --}}
            <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Category Split</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Monthly average</p>
                </div>
                <div class="p-5">
                    {{-- SVG Donut --}}
                    <div class="flex justify-center mb-5">
                        <svg viewBox="0 0 36 36" class="w-36 h-36 -rotate-90">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#e4e4e7" stroke-width="3.2" class="dark:stroke-zinc-700"/>
                            {{-- Housing 35% --}}
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#a855f7" stroke-width="3.2"
                                stroke-dasharray="35 65" stroke-dashoffset="0" class="transition-all"/>
                            {{-- Food 22% --}}
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#3b82f6" stroke-width="3.2"
                                stroke-dasharray="22 78" stroke-dashoffset="-35" class="transition-all"/>
                            {{-- Transport 14% --}}
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#10b981" stroke-width="3.2"
                                stroke-dasharray="14 86" stroke-dashoffset="-57" class="transition-all"/>
                            {{-- Entertainment 11% --}}
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#f59e0b" stroke-width="3.2"
                                stroke-dasharray="11 89" stroke-dashoffset="-71" class="transition-all"/>
                            {{-- Other 18% --}}
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#71717a" stroke-width="3.2"
                                stroke-dasharray="18 82" stroke-dashoffset="-82" class="transition-all"/>
                        </svg>
                    </div>
                    <div class="space-y-2">
                        @foreach ([
                            ['label' => 'Housing', 'pct' => '35%', 'color' => 'bg-purple-500'],
                            ['label' => 'Food', 'pct' => '22%', 'color' => 'bg-blue-500'],
                            ['label' => 'Transport', 'pct' => '14%', 'color' => 'bg-emerald-500'],
                            ['label' => 'Entertainment', 'pct' => '11%', 'color' => 'bg-amber-500'],
                            ['label' => 'Other', 'pct' => '18%', 'color' => 'bg-zinc-400'],
                        ] as $c)
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 rounded-full {{ $c['color'] }}"></div>
                                <span class="text-zinc-600 dark:text-zinc-400">{{ $c['label'] }}</span>
                            </div>
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $c['pct'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Monthly Trend --}}
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Net Worth Trend</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Balance growth over 6 months</p>
                </div>
                <span class="text-sm font-semibold text-green-600 dark:text-green-400">+18.4% ↑</span>
            </div>
            <div class="px-5 pb-5 pt-4">
                <div class="flex items-end gap-1 h-20">
                    @php $vals = [65, 68, 72, 78, 85, 91, 100]; @endphp
                    @foreach ($vals as $i => $v)
                    <div class="flex-1 rounded-t-sm transition-all hover:opacity-80
                        {{ $i === count($vals)-1 ? 'bg-purple-500' : 'bg-purple-200 dark:bg-purple-900/40' }}"
                        style="height: {{ $v * 0.8 }}px"
                        title="${{ number_format($v * 245.63, 0) }}">
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-between mt-2">
                    @foreach (['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'] as $m)
                    <span class="flex-1 text-center text-xs text-zinc-400">{{ $m }}</span>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-layouts::app>
