@extends('layouts.mobile')

@section('content')
<div x-data="labTracker()" x-init="initPolling()">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold text-slate-800">Live Lab Status</h2>
        <span class="text-[10px] text-slate-400">Auto-refreshing...</span>
    </div>

    <div class="space-y-3">
        <template x-for="lab in laboratories" :key="lab.id">
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold" x-text="lab.room_number"></p>
                        <p class="font-bold text-slate-900" x-text="lab.status"></p>
                    </div>
                    <div :class="lab.status === 'Available' ? 'bg-green-100' : 'bg-red-100'" class="p-2 rounded-full">
                        <div :class="lab.status === 'Available' ? 'bg-green-500' : 'bg-red-500'" class="w-3 h-3 rounded-full"></div>
                    </div>
                </div>

                <div x-show="lab.status === 'Occupied'" class="mt-3 pt-3 border-t border-slate-50 text-sm">
                    <p class="text-slate-600">Prof: <span class="text-slate-900 font-medium" x-text="lab.faculty_name"></span></p>
                    <p class="text-slate-600">Section: <span class="text-slate-900 font-medium" x-text="lab.section_name"></span></p>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    function labTracker() {
        return {
            laboratories: [],
            async fetchLabs() {
                const res = await fetch('/api/labs');
                this.laboratories = await res.json();
            },
            initPolling() {
                this.fetchLabs();
                setInterval(() => this.fetchLabs(), 5000); // 5-second sync
            }
        }
    }
</script>
@endsection