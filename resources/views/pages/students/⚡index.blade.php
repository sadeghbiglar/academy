<?php

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::academy')] class extends Component
{
    public string $title = 'دانش‌آموزان آموزشگاه';

    public function getStudents()
    {
        return Student::all();
    }
};
?>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        {{ $title }}
    </h1>

    <div class="space-y-3">

        @foreach ($this->getStudents() as $student)

            <div class="p-4 bg-white rounded-lg shadow">

                <div class="font-bold">
                    {{ $student->first_name }}
                    {{ $student->last_name }}
                </div>

                <div class="text-sm opacity-60">
                    {{ $student->mobile }}
                </div>

            </div>

        @endforeach

    </div>

</div>