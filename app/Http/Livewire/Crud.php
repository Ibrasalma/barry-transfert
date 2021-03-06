<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Student;
use Livewire\WithFileUploads;


class Crud extends Component
{
    use WithFileUploads;
    public $students, $old_picture, $name, $email, $mobile, $student_id, $photo, $modelId, $photo_name, $delete_id;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;
    public $isDeleteModalOpen = 0;

    public function render()
    {
        $this->students = Student::all();
        return view('livewire.crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function suprimer($id)
    {
        $this->delete_id = $id;
        $this->openDeleteModalPopover();
    }

    public function openDeleteModalPopover()
    {
        $this->isDeleteModalOpen = true;
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function closeDeleteModalPopover()
    {
        $this->isDeleteModalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->photo = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'photo' => empty($this->student_id) ? validateImage() : '',
        ]);
        if(!empty($this->photo)){
            $this->photo_name = $this->photo->getClientOriginalName();
            $this->photo->storeAs('clients', $this->photo_name);
        }
        if(!empty($this->student_id)){
            $old_values = Student::findOrFail($this->student_id);
            $this->old_picture = $old_values->photo;
        }
        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'photo' => !empty($this->old_picture) ? $this->old_picture : $this->photo_name
        ]);

        session()->flash('message', $this->student_id ? 'Client modifi??.' : 'Client cr??e.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->mobile = $student->mobile;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Student::find($id)->delete();
        $this->closeDeleteModalPopover();
        session()->flash('message', 'Client supprim??.');
    }

}