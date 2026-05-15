@extends('layouts.mobile')

@section('content')
<div x-data="{ 
    searchQuery: '', 
    results: [],
    loading: false,
    async performSearch() {
        if(this.searchQuery.length > 1) {
            this.loading = true;
            const res = await fetch(`/api/labs/search?search=${this.searchQuery}`);
            this.results = await res.json();
            this.loading = false;
        } else {
            this.results = [];
        }
    }
}" class="space-y-4">
    
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800">Find a Laboratory</h2>
        <p class="text-xs text-slate-500">Search by Room #, Professor, or Section</p>
    </div>

    <div class="relative">
        <input 
            type="text" 
            x-model="searchQuery" 
            @input.debounce.300ms="performSearch()"
            placeholder="Type here to search..."
            class="w-full p-4 rounded-xl border border-slate-200 shadow-sm focus:ring-2 focus:ring-blue-500 outline-none bg-white"
        >
        <div x-show="loading" class="absolute right-4 top-4">
            <div class="animate-spin h-5 w-5 border-2 border-blue-500 border-t-transparent rounded-full"></div>
        </div>
    </div>

    <div class="space-y-3">
        <template x-for="lab in results" :key="lab.id">
            <div class="p-4 bg-white rounded-xl border border-slate-100 flex justify-between items-center shadow-sm">
                <div>
                    <p class="font-bold text-slate-800" x-text="'Room ' + lab.room_number"></p>
                    <p class="text-xs text-slate-500" x-text="lab.faculty_name ? lab.faculty_name : 'No Class'"></p>
                </div>
                <span :class="lab.status === 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" 
                      class="text-[10px] px-3 py-1 rounded-full font-bold uppercase" 
                      x-text="lab.status"></span>
            </div>
        </template>

        <div x-show="searchQuery.length > 1 && results.length === 0 && !loading" class="text-center py-10">
            <p class="text-slate-400 text-sm">No results found for "<span x-text="searchQuery"></span>"</p>
        </div>
    </div>
</div>
@endsection