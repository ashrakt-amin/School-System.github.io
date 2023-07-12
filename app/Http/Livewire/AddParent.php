<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MyParent;
use App\Models\Religion;
use App\Models\TypeBlood;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public $catchError, $updateMode = false,  $currentStep = 1,  $successMessage = '', $showTable = true;
    // Father_INPUTS
    public $email, $password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id,

        // Attachments
        $photos, $Parent_id;



    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods'   => TypeBlood::all(),
            'Religions'     => Religion::all(),
            'myParents'     => MyParent::all()
        ]);
    }


    public function showTable()
    {
        $this->showTable = false;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => "min:10|regex:/^([0-9\s\-\+\(\)]*)$/",
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => "min:10|regex:/^([0-9\s\-\+\(\)]*)$/",
        ]);
    }
    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,Email,' . $this->id,
            'password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => "required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/",
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => "required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/",
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {
        try {
            $My_Parent = new MyParent();

            // Father_INPUTS
            $My_Parent->create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'National_ID_Father' => $this->National_ID_Father,
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => $this->Address_Father,

                // Mother_INPUTS
                'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => $this->Address_Mother

            ]);

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id
                    ]);
                }
            }

            $this->successMessage = trans('Messages.success');
            $this->clearForm();
            return redirect()->to('add/parent');
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function edit($id)
    {

        $parent = MyParent::findOrFail($id);
        // dd($parent);
        $this->showTable = false;
        $this->currentStep = 1;
        $this->updateMode = true;
        $this->email = $parent->email;
        $this->Parent_id = $id;
        $this->password = $parent->password;
        $this->Name_Father_en = $parent->getTranslation('Name_Father', 'en');
        $this->Name_Father = $parent->getTranslation('Name_Father', 'ar');
        $this->National_ID_Father = $parent->Nationality_Father_id;
        $this->Passport_ID_Father = $parent->Passport_ID_Father;
        $this->Phone_Father = $parent->Phone_Father;
        $this->Job_Father_en =  $parent->getTranslation('Job_Father', 'en');
        $this->Job_Father =  $parent->getTranslation('Job_Father', 'ar');
        $this->Passport_ID_Father = $parent->Passport_ID_Father;
        $this->Nationality_Father_id = $parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $parent->Blood_Type_Father_id;
        $this->Religion_Father_id = $parent->Religion_Father_id;
        $this->Address_Father = $parent->Address_Father;

        // Mother_INPUTS
        $this->Name_Mother_en = $parent->getTranslation('Name_Mother', 'en');
        $this->Name_Mother = $parent->getTranslation('Name_Mother', 'ar');
        $this->National_ID_Mother = $parent->National_ID_Mother;
        $this->Passport_ID_Mother = $parent->Passport_ID_Mother;
        $this->Phone_Mother = $parent->Phone_Mother;
        $this->Job_Mother_en = $parent->getTranslation('Job_Mother', 'en');
        $this->Job_Mother = $parent->getTranslation('Job_Mother', 'ar');
        $this->Passport_ID_Mother = $parent->Passport_ID_Mother;
        $this->Nationality_Mother_id = $parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $parent->Blood_Type_Mother_id;
        $this->Religion_Mother_id = $parent->Religion_Mother_id;
        $this->Address_Mother = $parent->Address_Mother;
    }

    public function firstStepedit()
    {

        $this->showTable = false;
        $this->currentStep = 2;
        $this->updateMode = true;
    }

    public function secondStepedit()
    {
        $this->showTable = false;
        $this->currentStep = 3;
    }

    public function submitForm_edit()
    {
        //   dd($this->Parent_id);
        if ($this->Parent_id) {
            $parent = MyParent::findOrFail($this->Parent_id);
            $parent->update([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'National_ID_Father' => $this->National_ID_Father,
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => $this->Address_Father,

                // Mother_INPUTS
                'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => $this->Address_Mother

            ]);
        }
        return redirect()->to('add/parent');
    }
    public function delete($id)
    {
        // dd($id);
        MyParent::findOrFail($id)->delete();
        return redirect()->to('add/parent');
    }

     //clearForm
     public function clearForm()
     {
         $this->email = '';
         $this->password = '';
         $this->Name_Father = '';
         $this->Job_Father = '';
         $this->Job_Father_en = '';
         $this->Name_Father_en = '';
         $this->National_ID_Father ='';
         $this->Passport_ID_Father = '';
         $this->Phone_Father = '';
         $this->Nationality_Father_id = '';
         $this->Blood_Type_Father_id = '';
         $this->Address_Father ='';
         $this->Religion_Father_id ='';
 
         $this->Name_Mother = '';
         $this->Job_Mother = '';
         $this->Job_Mother_en = '';
         $this->Name_Mother_en = '';
         $this->National_ID_Mother ='';
         $this->Passport_ID_Mother = '';
         $this->Phone_Mother = '';
         $this->Nationality_Mother_id = '';
         $this->Blood_Type_Mother_id = '';
         $this->Address_Mother ='';
         $this->Religion_Mother_id ='';
 
     }
 
}
