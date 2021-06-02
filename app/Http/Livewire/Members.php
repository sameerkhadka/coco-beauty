<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class Members extends Component
{
    public $memberID, $firstName, $lastName, $address, $phone, $email, $dob, $members, $totalMembers, $submitButton = false, $checkedItems=[], $checkAll=false;

    public function editMember($id){
        $this->memberID = $id;
        $member = Member::find($id);
        $this->firstName = $member->first_name;
        $this->lastName = $member->last_name;
        $this->address = $member->address;
        $this->phone = $member->phone;
        $this->email = $member->email;
        $this->dob = $member->dob;
    }

    public function pluckedMembers(){
        return array_map(function($el) {
            return  (string)$el;
          }, $this->members->pluck('id')->toArray());
    }

    public function deleteSelected(){
        Member::destroy($this->checkedItems);
        $this->checkAll = false;
    }

    public function updatedCheckAll(){
        if($this->checkAll){
            $this->checkedItems = $this->pluckedMembers();
        }
        else{
            $this->checkedItems = [];
        }
    }

    public function updatedCheckedItems(){
        if(array_sum($this->checkedItems) == array_sum($this->members->pluck('id')->toArray())){
            $this->checkAll = true;
        }
        else{
            $this->checkAll = false;
        }
    }

    public function render()
    {
        $this->checkForSubmitButton();
        $this->members = Member::orderBy('created_at','desc')->get();
        $this->totalMembers = $this->members->count();
        return view('livewire.members');
    }

    private function checkForSubmitButton(){
        if(!empty($this->firstName) || !empty($this->lastName) || !empty($this->address) || !empty($this->phone) || !empty($this->email) || !empty($this->dob)){
            $this->submitButton = true;
        }
        else{
            $this->submitButton = false;
        }
    }

    public function cancelEdit(){
        $this->memberID = null;
        $this->emptyData();
    }

    public function submit(){
        if($this->memberID){
            $member = Member::find($this->memberID);
            $member->first_name = $this->firstName;
            $member->last_name = $this->lastName;
            $member->address = $this->address;
            $member->phone = $this->phone;
            $member->email = $this->email;
            if($this->dob){
                $member->dob = $this->dob;
            }
            $member->update();
            $this->memberID = null;
        }
        else{
            $member = new Member();
            $member->first_name = $this->firstName;
            $member->last_name = $this->lastName;
            $member->address = $this->address;
            $member->phone = $this->phone;
            $member->email = $this->email;
            if($this->dob){
                $member->dob = $this->dob;
            }
            $member->save();
        }
        $this->emptyData();
    }

    private function emptyData(){
        $this->firstName = "";
        $this->lastName = "";
        $this->address = "";
        $this->phone = "";
        $this->email = "";
        $this->dob = "";
    }
}
