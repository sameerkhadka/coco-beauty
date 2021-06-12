<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class Members extends Component
{
    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];
    public $menuOpen=false, $memberID, $firstName, $lastName, $address, $phone, $email, $dob, $members, $totalMembers, $submitButton = false, $checkedItems=[], $checkAll=false;


    //deleting
    public function deleteSelected(){
        Member::destroy($this->checkedItems);

        // if memberID has been
        if(in_array($this->memberID,$this->checkedItems)){
            $this->memberID = null;
            $this->emptyData();
            $this->menuOpen = false;
        }
        // reverting array to empty
        $this->checkedItems = [];
        $this->checkedItems = false;
        $this->checkAll = false;
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Successfully Deleted']);
    }

    public function confirmBox($id=null){
        // if id is null then, it is deleteAll
        if($id){
            $this->checkAll = false;
            $this->checkedItems = [];
            $this->checkedItems[] = (string)$id;
            $this->dispatchBrowserEvent('from-backend',['is'=>'alert']);
        }
        else{
            $this->dispatchBrowserEvent('from-backend',['is'=>'alert']);
        }
    }

    //add member
    public function addMember(){
        $this->menuOpen = true;
        $this->emptyData();
    }

    //edit member
    public function editMember($id){
        $this->memberID = $id;
        $this->menuOpen = true;
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
        // $this->checkForSubmitButton();
        $this->members = Member::orderBy('created_at','desc')->get();
        $this->totalMembers = $this->members->count();
        return view('livewire.members');
    }

    // private function checkForSubmitButton(){
    //     if(!empty($this->firstName) || !empty($this->lastName) || !empty($this->address) || !empty($this->phone) || !empty($this->email) || !empty($this->dob)){
    //         $this->submitButton = true;
    //     }
    //     else{
    //         $this->submitButton = false;
    //     }
    // }
    //cancel can be used in both add and update as it only empty members data;
    public function cancelEdit(){
        $this->menuOpen = false;
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
            $this->menuOpen = false;
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Member Updated Successfully']);
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
            $this->menuOpen = false;
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Member Added Successfully']);

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
