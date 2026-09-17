<?php

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new #[Layout('layouts::academy')]
class extends Component {
    use Toast;
    use WithPagination;
    public string $title = 'دانش‌آموزان آموزشگاه';

    public string $search = '';

    public string $first_name = '';

    public string $last_name = '';

    public string $mobile = '';

    public bool $showCreateModal = false;
    public ?int $editingStudentId = null;

    public bool $showEditModal = false;

    public string $edit_first_name = '';

    public string $edit_last_name = '';

    public string $edit_mobile = '';
    public ?int $deletingStudentId = null;

    public bool $showDeleteModal = false;
    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:50'],
            'last_name' => ['required', 'string', 'min:2', 'max:50'],
            'mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
        ];
    }
    public function saveStudent()
    {
        $this->validate();
        Student::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
        ]);
        $this->reset([
            'first_name',
            'last_name',
            'mobile',
        ]);
        $this->showCreateModal = false;
        $this->success(
            'ثبت موفق',
            'دانش‌آموز با موفقیت ثبت شد.'
        );
    }
    public function editStudent(int $id): void
    {
        $student = Student::findOrFail($id);

        $this->editingStudentId = $student->id;

        $this->edit_first_name = $student->first_name;
        $this->edit_last_name = $student->last_name;
        $this->edit_mobile = $student->mobile;

        $this->showEditModal = true;
    }
    public function updateStudent(): void
    {
        $this->validate([
            'edit_first_name' => ['required', 'string', 'min:2', 'max:50'],
            'edit_last_name' => ['required', 'string', 'min:2', 'max:50'],
            'edit_mobile' => ['required', 'string', 'regex:/^09[0-9]{9}$/'],
        ]);

        $student = Student::findOrFail($this->editingStudentId);

        $student->update([
            'first_name' => $this->edit_first_name,
            'last_name' => $this->edit_last_name,
            'mobile' => $this->edit_mobile,
        ]);

        $this->showEditModal = false;

        $this->resetEditForm();

        $this->success(
            'ویرایش موفق',
            'اطلاعات دانش‌آموز با موفقیت به‌روزرسانی شد.'
        );
    }
    public function resetEditForm(): void
    {
        $this->reset([
            'editingStudentId',
            'edit_first_name',
            'edit_last_name',
            'edit_mobile',
        ]);
    }
    public function confirmDelete(int $id): void
    {
        $this->deletingStudentId = $id;

        $this->showDeleteModal = true;
    }
    public function deleteStudent(): void
    {
        $student = Student::findOrFail($this->deletingStudentId);

        $student->delete();

        $this->showDeleteModal = false;

        $this->deletingStudentId = null;

        $this->success(
            'حذف موفق',
            'دانش‌آموز با موفقیت حذف شد.'
        );
    }
    public array $headers = [
        ['key' => 'row_number', 'label' => '#'],
        ['key' => 'first_name', 'label' => 'نام'],
        ['key' => 'last_name', 'label' => 'نام خانوادگی'],
        ['key' => 'mobile', 'label' => 'موبایل'],
        ['key' => 'created_at', 'label' => 'تاریخ ثبت'],
    ];
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    #[Computed]
    public function students()
    {
        $students = Student::query()
            ->where(function ($query) {
                $query
                    ->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('mobile', 'like', '%' . $this->search . '%');
            })
            ->paginate(3);

        $students->getCollection()->transform(
            function ($student, $index) use ($students) {
                $student->row_number = $students->firstItem() + $index;

                return $student;
            }
        );

        return $students;
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

        <x-button label="دانش‌آموز جدید" icon="o-plus" class="btn-primary" wire:click="$set('showCreateModal', true)" />

    </div>
    <x-modal wire:model="showCreateModal" title="ثبت دانش‌آموز جدید" separator>
        <div class="space-y-4">

            <x-input label="نام" wire:model="first_name" placeholder="مثلاً علی" error="first_name" />

            <x-input label="نام خانوادگی" wire:model="last_name" placeholder="مثلاً رضایی" error="last_name" />

            <x-input label="شماره موبایل" wire:model="mobile" placeholder="مثلاً 09123456789" error="mobile" />

        </div>

        <x-slot:actions>

            <x-button label="انصراف" wire:click="$set('showCreateModal', false)" />

            <x-button label="ثبت دانش‌آموز" icon="o-check" class="btn-primary" wire:click="saveStudent" wire:loading.attr="disabled"
                wire:target="saveStudent" />

        </x-slot:actions>

    </x-modal>
    <x-modal
        wire:model="showEditModal"
        title="ویرایش دانش‌آموز"
        separator>
        <div class="space-y-4">

            <x-input
                label="نام"
                wire:model="edit_first_name"
                placeholder="مثلاً علی"
                error="edit_first_name" />

            <x-input
                label="نام خانوادگی"
                wire:model="edit_last_name"
                placeholder="مثلاً رضایی"
                error="edit_last_name" />

            <x-input
                label="شماره موبایل"
                wire:model="edit_mobile"
                placeholder="مثلاً 09123456789"
                error="edit_mobile" />

        </div>

        <x-slot:actions>

            <x-button
                label="انصراف"
                wire:click="$set('showEditModal', false)" />

            <x-button
                label="ذخیره تغییرات"
                icon="o-check"
                class="btn-primary"
                wire:click="updateStudent"
                wire:loading.attr="disabled"
                wire:target="updateStudent" />

        </x-slot:actions>

    </x-modal>
    <x-modal
        wire:model="showDeleteModal"
        title="حذف دانش‌آموز"
        separator>
        <div class="py-4">
            <p class="text-base">
                آیا از حذف این دانش‌آموز مطمئن هستید؟
            </p>

            <p class="mt-2 text-sm text-gray-500">
                این عملیات قابل بازگشت نیست.
            </p>
        </div>

        <x-slot:actions>

            <x-button
                label="انصراف"
                wire:click="$set('showDeleteModal', false)" />

            <x-button
                label="بله، حذف شود"
                icon="o-trash"
                class="btn-error"
                wire:click="deleteStudent"
                wire:loading.attr="disabled"
                wire:target="deleteStudent" />

        </x-slot:actions>

    </x-modal>
    <x-alert title="مدیریت دانش‌آموزان" description="در این بخش می‌توانید اطلاعات دانش‌آموزان آموزشگاه را مدیریت کنید."
        icon="o-information-circle" class="mb-6" />

    <div class="mb-6">

        <x-input label="جستجوی دانش‌آموز" placeholder="نام، نام خانوادگی یا شماره موبایل..." icon="o-magnifying-glass"
            wire:model.live="search" />

    </div>

    <div class="bg-base-100 rounded-box shadow">

        @if ($this->students->isEmpty())
        <div class="bg-base-100 rounded-box shadow p-10 text-center">
            <div class="flex justify-center mb-4">
                <x-icon
                    name="o-magnifying-glass"
                    class="w-12 h-12 opacity-30" />
            </div>

            <h3 class="text-lg font-bold">
                دانش‌آموزی پیدا نشد
            </h3>

            <p class="text-sm opacity-60 mt-2">
                @if ($search)
                دانش‌آموزی با عبارت «{{ $search }}» پیدا نشد.
                @else
                هنوز هیچ دانش‌آموزی ثبت نشده است.
                @endif
            </p>

            @if ($search)
            <x-button
                label="پاک کردن جستجو"
                icon="o-x-mark"
                class="btn-sm mt-4"
                wire:click="$set('search', '')" />
            @endif
        </div>
        @else
        <div class="bg-base-100 rounded-box shadow overflow-hidden">
            <div class="overflow-x-auto">
                <x-table
                    :headers="$headers"
                    :rows="$this->students"
                    striped
                    hover>
                    @scope('actions', $student)
                    <div class="flex items-center gap-1">
                        <x-button
                            icon="o-pencil"
                            class="btn-sm btn-ghost"
                            wire:click="editStudent({{ $student->id }})"
                            aria-label="ویرایش" />

                        <x-button
                            icon="o-trash"
                            class="btn-sm btn-ghost text-error"
                            wire:click="confirmDelete({{ $student->id }})"
                            aria-label="حذف" />
                    </div>
                    @endscope
                    @scope('cell_created_at', $student)
                    {{ $student->created_at->format('Y/m/d') }}
                    @endscope
                </x-table>
            </div>
        </div>

        <div class="mt-4">
            {{ $this->students->links() }}
        </div>
        @endif

    </div>

</div>