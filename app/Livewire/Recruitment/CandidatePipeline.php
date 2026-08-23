<?php

namespace App\Livewire\Recruitment;

use App\Models\Candidate;
use App\Models\Vacancy;
use Livewire\Component;

class CandidatePipeline extends Component
{
    public string $vacancyFilter = '';
    public ?Candidate $selectedCandidate = null;
    public bool $showCandidateModal = false;
    public string $newStatus = '';

    public function selectCandidate(int $id)
    {
        $this->selectedCandidate = Candidate::with(['vacancy', 'screeningRecords', 'interviews', 'jobOffers'])->find($id);
        $this->newStatus = $this->selectedCandidate->status ?? 'new';
        $this->showCandidateModal = true;
    }

    public function updateStatus()
    {
        if ($this->selectedCandidate) {
            $this->selectedCandidate->update(['status' => $this->newStatus]);
            session()->flash('message', 'Candidate status updated to ' . ucfirst($this->newStatus));
            $this->showCandidateModal = false;
        }
    }

    public function render()
    {
        $query = Candidate::with('vacancy');

        if ($this->vacancyFilter !== '') {
            $query->where('vacancy_id', $this->vacancyFilter);
        }

        $candidates = $query->latest()->get();
        $vacancies = Vacancy::all();

        return view('livewire.recruitment.candidate-pipeline', [
            'candidates' => $candidates,
            'vacancies' => $vacancies,
        ])->layout('components.layout.app', [
            'title' => 'Candidate Pipeline - CEYWork ATS'
        ]);
    }
}
