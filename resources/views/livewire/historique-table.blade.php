<div wire:poll.3s>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <table class="table-auto m-3">
        <thead class="bg-slate-800 text-white">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Utilisateur</th>
                <th class="p-3">Action</th>
                <th class="p-3">Sujet</th>
                <th class="p-3">Propriétés</th>
                <th class="p-3">IP</th>
                <th class="p-3">Navigateur</th>
                <th class="p-3">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activities as $activity)
                <tr class="border-b border-b-slate-200 hover:bg-slate-200 duration-300">
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->id }}</td>
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->user?->name ?? 'Inconnu' }}</td>
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->action }}</td>
                    <td class="p-3 border-r border-r-slate-300">{{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}</td>
                    <td class="p-3 border-r border-r-slate-300">
                        <pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                    </td>
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->ip }}</td>
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->user_agent }}</td>
                    <td class="p-3 border-r border-r-slate-300">{{ $activity->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-2 text-slate-700">Aucune Activité</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $activities->links() }}
    </div>
</div>
