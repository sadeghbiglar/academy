<?php

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::academy')] class extends Component
{
    public string $title = 'دانش‌آموزان آموزشگاه';

    public string $search = '';

    public function getStudents()
    {
        return Student::query()
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('mobile', 'like', '%' . $this->search . '%')
            ->get();
    }
};
?>
<div class="p-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                {{ $title }}
            </h1>

            <p class="text-sm opacity-60 mt-1">
                مدیریت اطلاعات دانش‌آموزان آموزشگاه
            </p>
        </div>

        <x-button
            label="دانش‌آموز جدید"
            icon="o-plus"
            class="btn-primary"
        />

    </div>

    <x-alert
        title="مدیریت دانش‌آموزان"
        description="در این بخش می‌توانید اطلاعات دانش‌آموزان آموزشگاه را مدیریت کنید."
        icon="o-information-circle"
        class="mb-6"
    />

    <div class="mb-6">

        <x-input
            label="جستجوی دانش‌آموز"
            placeholder="نام، نام خانوادگی یا شماره موبایل..."
            icon="o-magnifying-glass"
            wire:model.live="search"
        />

    </div>

    <div class="bg-base-100 rounded-box shadow">

        <div class="overflow-x-auto">

            <table class="table">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>نام و نام خانوادگی</th>
                        <th>موبایل</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($this->getStudents() as $student)

                        <tr>

                            <td>
                                {{ $student->id }}
                            </td>

                            <td class="font-medium">
                                {{ $student->first_name }}
                                {{ $student->last_name }}
                            </td>

                            <td>
                                {{ $student->mobile }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>