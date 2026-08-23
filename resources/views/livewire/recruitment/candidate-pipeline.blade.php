<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Applicant Pipeline & Screening</h1>
            <p class="text-slate-500 text-sm">Track candidates across application, pre-screening, interview, job offer, and onboarding stages.</p>
        </div>
        <div class="w-full md:w-64">
            <select wire:model.live="vacancyFilter" class="w-full text-sm border border-slate-300 rounded-lg p-2.5">
                <option value="">All Vacancies</option>
                @foreach($vacancies as $vac)
                    <option value="{{ $vac->id }}">{{ $vac->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if (session()->has('message'))
        <x-alert-banner dismissible>
            {{ session('message') }}
        </x-alert-banner>
    @endif

    <!-- Pipeline Stages Table / Card View -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-700 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3.5">Candidate Name</th>
                    <th class="px-6 py-3.5">Applied Position</th>
                    <th class="px-6 py-3.5">Source</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($candidates as $cand)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <x-avatar :name="$cand->full_name" size="md" />
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $cand->full_name }}</p>
                                    <p class="text-xs text-slate-500 font-mono">{{ $cand->email }} · {{ $cand->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-800">{{ $cand->vacancy?->title ?? 'General Requisition' }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium">
                            <span class="px-2.5 py-1 bg-slate-100 rounded-md border border-slate-200 font-mono">
                                {{ $cand->source }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <x-badge :status="$cand->status">{{ ucfirst(str_replace('-', ' ', $cand->status)) }}</x-badge>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="selectCandidate({{ $cand->id }})" class="text-xs font-semibold text-teal-600 hover:text-teal-800">
                                Review Candidate →
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                            No candidates found in pipeline.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Candidate Detail & Status Update Modal -->
    @if($showCandidateModal && $selectedCandidate)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 space-y-4 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">{{ $selectedCandidate->full_name }}</h2>
                        <p class="text-xs text-slate-500 font-mono">{{ $selectedCandidate->email }} · Applied via {{ $selectedCandidate->source }}</p>
                    </div>
                    <button wire:click="$set('showCandidateModal', false)" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200">
                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Experience & Background</p>
                        <p class="text-slate-800 text-xs">{{ $selectedCandidate->experience_summary ?? 'No summary provided.' }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Pipeline Stage / Status</label>
                        <select wire:model="newStatus" class="w-full text-sm border rounded-lg p-2.5">
                            <option value="new">New Application</option>
                            <option value="under-review">Under Review</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="interview-scheduled">Interview Scheduled</option>
                            <option value="offered">Job Offer Sent</option>
                            <option value="hired">Hired</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-slate-100 pt-3">
                    <button type="button" wire:click="$set('showCandidateModal', false)" class="px-4 py-2 text-sm text-slate-600">Close</button>
                    <button type="button" wire:click="updateStatus" class="px-4 py-2 text-sm bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-semibold">
                        Update Pipeline Stage
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
