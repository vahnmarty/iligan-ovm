<div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
    <div class="space-y-6 sm:space-y-5">
        <div class="space-y-1 sm:space-y-1">
            

            <x-form.form-section>
                <x-slot name="title">Personal Information</x-slot>

                <x-form.form-inline-group label="First Name">
                    <x-form.input-text wire:model.defer="first_name" required :invalid="$errors->has('first_name')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Middle Name">
                    <x-form.input-text wire:model.defer="middle_name" :invalid="$errors->has('middle_name')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Last Name">
                    <x-form.input-text wire:model.defer="last_name" required :invalid="$errors->has('last_name')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Name Extension">
                    <x-form.select>
                        <option>JR</option>
                        <option>SR</option>
                    </x-form.select>
                </x-form.form-inline-group>
                
                <x-form.form-inline-group label="Nickname">
                    <x-form.input-text wire:model.defer="nickname" :invalid="$errors->has('last_name')"/>
                </x-form.form-inline-group>

            </x-form.form-section>
            
            <x-form.form-section>
                <x-slot name="title">Address</x-slot>

                <x-form.form-inline-group label="Barangay" x-show="isOpen">
                    <x-form.select wire:model="barangay_id">
                        @foreach(Helpers::get_barangays() as $brgy)
                        <option value="{{ $brgy->id }}">{{ $brgy->name }}</option>
                        @endforeach
                    </x-form.select>
                </x-form.form-inline-group>

                <x-form.form-inline-group label="Purok">
                    <x-form.select wire:model="purok">
                        @foreach($puroks as $purok)
                        @if($purok->barangay_id == $barangay_id)
                        <option>{{ $purok->name }}</option>
                        @endif
                        @endforeach
                    </x-form.select>
                </x-form.form-inline-group>

            </x-form.form-section>

            <x-form.form-section>
                <x-slot name="title">Contact Details</x-slot>

                <x-form.form-inline-group label="Cellphone">
                    <x-form.input-text wire:model.defer="cellphone" required :invalid="$errors->has('cellphone')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Telephone">
                    <x-form.input-text wire:model.defer="telephone" :invalid="$errors->has('telephone')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Email">
                    <x-form.input-text wire:model.defer="email" type="email" :invalid="$errors->has('email')"/>
                </x-form.form-inline-group>

            </x-form.form-section>

            <x-form.form-section>
                <x-slot name="title">Status</x-slot>

                <x-form.form-inline-group label="Date of Birth">
                    <x-form.input-text wire:model.defer="date_of_birth" required type="date" :invalid="$errors->has('date_of_birth')"/>
                </x-form.form-inline-group>
    
    
                <x-form.form-inline-group label="Place of Birth">
                    <x-form.input-text wire:model.defer="place_of_birth" required  :invalid="$errors->has('place_of_birth')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Religion">
                    <x-form.select wire:model="religion">
                        @foreach(Helpers::get_religions() as $helper_item)
                        <option>{{ $helper_item }}</option>
                        @endforeach
                    </x-form.select>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Sex">
                    <x-form.select wire:model="sex">
                        <option>Male</option>
                        <option>Female</option>
                    </x-form.select>
                </x-form.form-inline-group>
                
                <x-form.form-inline-group label="Civil Status">
                    <x-form.select wire:model="civil_status">
                        @foreach(Helpers::get_civil_status() as $helper_item)
                        <option>{{ $helper_item }}</option>
                        @endforeach
                    </x-form.select>
                </x-form.form-inline-group>

            </x-form.form-section>

            <x-form.form-section>
                <x-slot name="title">Education Background</x-slot>

                <x-form.form-inline-group label="Primary Education">
                    <x-form.input-text wire:model.defer="primary_education"  :invalid="$errors->has('primary_education')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Secondary Education">
                    <x-form.input-text wire:model.defer="secondary_education"  :invalid="$errors->has('secondary_education')"/>
                </x-form.form-inline-group>
    
                <x-form.form-inline-group label="Tertiary Education">
                    <x-form.input-text wire:model.defer="tertiary_education"  :invalid="$errors->has('tertiary_education')"/>
                </x-form.form-inline-group>

            </x-form.form-section>

            
            <x-form.form-section>
                <x-slot name="title">Work</x-slot>

                <x-form.form-inline-group label="Occupation">
                    <x-form.input-text wire:model.defer="occupation"  :invalid="$errors->has('occupation')"/>
                </x-form.form-inline-group>
                
                <x-form.form-inline-group label="Company">
                    <x-form.input-text wire:model.defer="company"  :invalid="$errors->has('company')"/>
                </x-form.form-inline-group>

            </x-form.form-section>

            <x-form.form-section>
                <x-slot name="title">Emergency Contact</x-slot>

                <x-form.form-inline-group label="Contact Person">
                    <x-form.input-text wire:model.defer="emergency_contact_person"  :invalid="$errors->has('emergency_contact_person')"/>
                </x-form.form-inline-group>
                
                <x-form.form-inline-group label="Contact Number">
                    <x-form.input-text wire:model.defer="emergency_contact_number"  :invalid="$errors->has('emergency_contact_person')"/>
                </x-form.form-inline-group>

                <x-form.form-inline-group label="Authorized Receiving Person">
                    <x-form.input-text wire:model.defer="receiving_person"  :invalid="$errors->has('receiving_person')"/>
                </x-form.form-inline-group>

            </x-form.form-section>
            
            
        </div>
    </div>
</div>