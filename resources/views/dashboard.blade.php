<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Run an infinite automated 5-second background state refresh trigger
        setInterval(function() {
            fetch('/api/labs')
                .then(response => response.json())
                .then(data => {
                    data.forEach(lab => {
                        // Find active DOM cards and dynamically alter the status badges instantly
                        const labCard = document.getElementById(`lab-card-${lab.id}`);
                        if (labCard) {
                            // Automatically update textual and visual states if another faculty changed it
                            const badge = labCard.querySelector('.status-badge');
                            if (badge) {
                                badge.textContent = lab.status;
                                if (lab.status === 'Occupied') {
                                    badge.className = "status-badge px-2.5 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700";
                                } else {
                                    badge.className = "status-badge px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700";
                                }
                            }
                        }
                    });
                })
                .catch(err => console.log('Real-time sync update skipped:', err));
        }, 5000); // 5000ms = 5 seconds
    });
</script>
</x-app-layout>
