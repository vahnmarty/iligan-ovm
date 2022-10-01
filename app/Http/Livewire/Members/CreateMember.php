<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use App\Models\Purok;
use App\Models\User;
use App\Models\Person;
use Auth;

class CreateMember extends Component
{
    public $last_name, 
    $first_name,  
    $middle_name,
    $name_extension,
    $nickname,
    $barangay_id,
    $purok,
    $street_address,
    $cellphone,
    $telephone,
    $email,
    $date_of_birth,
    $place_of_birth,
    $religion,
    $sex,
    $civil_status;

    public $primary_education,
    $secondary_education,
    $tertiary_education,
    $occupation,
    $company;

    public $emergency_contact_person,
    $emergency_contact_number,
    $receiving_person;

    public $is_success;

    public $person;

    public $puroks = [];


    protected $queryString = ['barangay_id'];

    protected $rules = [
        'last_name' => 'required',
        'first_name' => 'required',
        'middle_name' => 'required',
        'name_extension' => 'nullable',
        'nickname' => 'nullable',
        'barangay_id' => 'required',
        'purok' => 'required',
        'street_address' => 'nullable',
        'cellphone' => 'required',
        'telephone' => 'nullable',
        'email' => 'nullable|unique:users,email',
        'date_of_birth' => 'required',
        'place_of_birth' => 'required',
        'religion' => 'nullable',
        'sex' => 'required',
        'civil_status' => 'required',
        'primary_education' => 'nullable',
        'secondary_education' => 'nullable',
        'tertiary_education' => 'nullable',
        'occupation' => 'nullable',
        'company' => 'nullable',
        'emergency_contact_person' => 'nullable',
        'emergency_contact_number' => 'nullable',
        'receiving_person' => 'nullable',
    ];

    public function render()
    {
        return view('livewire.members.create-member')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getPuroks();
    }

    public function save()
    {
        $data = $this->validate();

        $user = $this->createUser();

        $this->createPerson($user, $data);
    }

    public function createUser()
    {
        $user = new User;
        $user->name = $this->first_name . ' ' . $this->last_name;
        $user->email = $this->email;
        $user->password = bcrypt( strtolower($this->middle_name) );
        $user->active = false;
        $user->deactivated_by = Auth::id();
        $user->deactivated_at = now();
        $user->save();

        $user->assignRole(User::USER_ROLE);

        return $user;
    }

    protected function createPerson(User $user, $data)
    {
        $person = new Person;
        $person->user_id = $user->id;
        $person->fill($data);
        $person->created_by = Auth::id();
        $person->date_registered = date('Y-m-d');
        $person->save();

        $user->setStatus(User::PAYMENT_PENDING);

        $this->person = $person;
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    public function next()
    {
        $this->save();

        $this->is_success = true;

    }

    public function getPuroks()
    {
        $this->puroks = Purok::orderBy('name')->get();
    }

    public function exit()
    {
        return redirect('admin/members/index');
    }

    public function createNew()
    {
        $this->resetExcept('barangay_id', 'purok');
    }
    

}
