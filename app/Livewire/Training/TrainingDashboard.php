<?php

namespace App\Livewire\Training;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TrainingDashboard extends Component
{
    public array $courses = [];
    public ?int $enrolledCourseId = null;

    // Create / Edit Training Session Modal State
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public ?int $editingCourseId = null;

    public string $newTitle = '';
    public string $newProvider = 'Coursera';
    public string $newDuration = '4h';
    public string $newDeadline = 'Nov 30';
    public string $newCategory = 'Compliance';
    public bool $newMandatory = false;
    public int $newTotalEnrolled = 150;
    public ?string $successMessage = null;

    public function mount()
    {
        $this->courses = [
            [
                'id' => 1,
                'title' => 'GDPR Compliance Fundamentals',
                'mandatory' => true,
                'provider' => 'Coursera',
                'duration' => '4h',
                'deadline' => 'Sep 30',
                'category' => 'Compliance',
                'completedCount' => 231,
                'totalEnrolled' => 284,
                'percentage' => 81,
                'progressColor' => 'bg-emerald-500',
                'userCompleted' => false,
            ],
            [
                'id' => 2,
                'title' => 'Advanced Leadership Skills',
                'mandatory' => false,
                'provider' => 'LinkedIn Learning',
                'duration' => '8h',
                'deadline' => 'Oct 31',
                'category' => 'Leadership',
                'completedCount' => 18,
                'totalEnrolled' => 47,
                'percentage' => 38,
                'progressColor' => 'bg-[#b91c1c]',
                'userCompleted' => false,
            ],
            [
                'id' => 3,
                'title' => 'Agile & Scrum Certification',
                'mandatory' => false,
                'provider' => 'Udemy',
                'duration' => '12h',
                'deadline' => 'Sep 15',
                'category' => 'Tech',
                'completedCount' => 27,
                'totalEnrolled' => 32,
                'percentage' => 84,
                'progressColor' => 'bg-emerald-500',
                'userCompleted' => true,
            ],
            [
                'id' => 4,
                'title' => 'Financial Modeling in Excel',
                'mandatory' => false,
                'provider' => 'Internal',
                'duration' => '6h',
                'deadline' => 'Oct 15',
                'category' => 'Finance',
                'completedCount' => 9,
                'totalEnrolled' => 15,
                'percentage' => 60,
                'progressColor' => 'bg-[#b91c1c]',
                'userCompleted' => false,
            ],
            [
                'id' => 5,
                'title' => 'Effective Communication',
                'mandatory' => true,
                'provider' => 'Coursera',
                'duration' => '5h',
                'deadline' => 'Nov 1',
                'category' => 'Soft Skills',
                'completedCount' => 89,
                'totalEnrolled' => 156,
                'percentage' => 57,
                'progressColor' => 'bg-[#b91c1c]',
                'userCompleted' => false,
            ],
        ];
    }

    public function openCreateModal(): void
    {
        $this->reset(['newTitle', 'newMandatory', 'editingCourseId']);
        $this->newProvider = 'Coursera';
        $this->newDuration = '4h';
        $this->newDeadline = 'Nov 30';
        $this->newCategory = 'Compliance';
        $this->newTotalEnrolled = 150;
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
    }

    public function openEditModal(int $courseId): void
    {
        foreach ($this->courses as $course) {
            if ($course['id'] === $courseId) {
                $this->editingCourseId = $courseId;
                $this->newTitle = $course['title'];
                $this->newProvider = $course['provider'];
                $this->newDuration = $course['duration'];
                $this->newDeadline = $course['deadline'];
                $this->newCategory = $course['category'];
                $this->newMandatory = $course['mandatory'];
                $this->newTotalEnrolled = $course['totalEnrolled'];
                $this->showEditModal = true;
                break;
            }
        }
    }

    public function createTrainingSession(): void
    {
        $this->validate([
            'newTitle' => 'required|min:3|max:100',
            'newCategory' => 'required',
            'newProvider' => 'required',
            'newDuration' => 'required',
            'newDeadline' => 'required',
        ]);

        $newId = count($this->courses) + 1;
        $newCourse = [
            'id' => $newId,
            'title' => $this->newTitle,
            'mandatory' => $this->newMandatory,
            'provider' => $this->newProvider,
            'duration' => $this->newDuration,
            'deadline' => $this->newDeadline,
            'category' => $this->newCategory,
            'completedCount' => 0,
            'totalEnrolled' => $this->newTotalEnrolled > 0 ? $this->newTotalEnrolled : 100,
            'percentage' => 0,
            'progressColor' => 'bg-[#b91c1c]',
            'userCompleted' => false,
        ];

        array_unshift($this->courses, $newCourse);

        $this->successMessage = 'Training session "' . $this->newTitle . '" created successfully!';
        $this->showCreateModal = false;
    }

    public function updateTrainingSession(): void
    {
        $this->validate([
            'newTitle' => 'required|min:3|max:100',
            'newCategory' => 'required',
            'newProvider' => 'required',
            'newDuration' => 'required',
            'newDeadline' => 'required',
        ]);

        foreach ($this->courses as &$course) {
            if ($course['id'] === $this->editingCourseId) {
                $course['title'] = $this->newTitle;
                $course['provider'] = $this->newProvider;
                $course['duration'] = $this->newDuration;
                $course['deadline'] = $this->newDeadline;
                $course['category'] = $this->newCategory;
                $course['mandatory'] = $this->newMandatory;
                $course['totalEnrolled'] = $this->newTotalEnrolled;
                $course['percentage'] = round(($course['completedCount'] / max(1, $course['totalEnrolled'])) * 100);
                break;
            }
        }

        $this->successMessage = 'Training session "' . $this->newTitle . '" updated successfully!';
        $this->showEditModal = false;
    }

    public function deleteCourse(int $courseId): void
    {
        $this->courses = array_values(array_filter($this->courses, fn($c) => $c['id'] !== $courseId));
        $this->successMessage = 'Training session deleted successfully!';
    }

    public function dismissSuccessMessage(): void
    {
        $this->successMessage = null;
    }

    public function toggleEnrollment(int $courseId): void
    {
        foreach ($this->courses as &$course) {
            if ($course['id'] === $courseId) {
                $course['userCompleted'] = !$course['userCompleted'];
                if ($course['userCompleted']) {
                    $course['completedCount']++;
                } else {
                    $course['completedCount'] = max(0, $course['completedCount'] - 1);
                }
                $course['percentage'] = round(($course['completedCount'] / max(1, $course['totalEnrolled'])) * 100);
                $course['progressColor'] = $course['percentage'] >= 75 ? 'bg-emerald-500' : 'bg-[#b91c1c]';
                break;
            }
        }
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $canAddTraining = $user && ($user->isAdmin() || $user->hasAnyRole(['System Administrator', 'Company Administrator', 'HR Senior', 'HR Manager', 'HR Junior']));

        return view('livewire.training.training-dashboard', [
            'user' => $user,
            'courses' => $this->courses,
            'canAddTraining' => $canAddTraining,
        ])->layout('components.layout.app', [
            'title' => 'Training & Development - CEYWork'
        ]);
    }
}
