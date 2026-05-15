@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Faculty Management Dashboard</h1>
    <p class="text-slate-500 mt-1">Real-time status controls for CICT Department Laboratories.</p>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($laboratories as $lab)
        @php $isOccupied = $lab->status === 'Occupied'; @endphp
        
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-slate-900">Room: {{ $lab->room_number }}</h3>
                    <!-- Uniform Team Design Status Indicators -->
                    <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $isOccupied ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                        {{ $lab->status }}
                    </span>
                </div>

                @if($isOccupied)
                    <div class="bg-slate-50 border border-slate-100 rounded-lg p-3 text-sm mb-6 space-y-1">
                        <p class="text-slate-600"><span class="font-medium text-slate-900">Faculty:</span> {{ $lab->faculty_name }}</p>
                        <p class="text-slate-600"><span class="font-medium text-slate-900">Section:</span> {{ $lab->section_name }}</p>
                    </div>
                @else
                    <p class="text-sm text-slate-400 italic mb-6">Laboratory is empty and available.</p>
                @endif
            </div>

            <!-- Context Update Mechanism UI Panel Forms -->
            <div class="border-t border-slate-100 pt-4 mt-auto">
                <form action="/labs/{{ $lab->id }}/toggle" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    
                    @if(!$isOccupied)
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1">Class Section</label>
                            <input type="text" name="section_name" placeholder="e.g., BSIT3-C" required
                                   class="w-full border border-slate-200 rounded-lg p-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                        <input type="hidden" name="status" value="Occupied">
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold text-xs py-2 px-4 rounded-lg transition-colors">
                            Mark as Occupied
                        </button>
                    @else
                        <input type="hidden" name="status" value="Available">
                        <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs py-2 px-4 rounded-lg transition-colors">
                            Release Laboratory (Set Available)
                        </button>
                    @endif
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection