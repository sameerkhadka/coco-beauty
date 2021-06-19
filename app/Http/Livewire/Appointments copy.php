<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Member;
use Livewire\Component;

class Appointments extends Component
{
    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];
    //commons
    public $appointments,$checkbox,$menuOpen=false, $appointmentID, $totalAppointments, $submitButton = false, $checkedItems=[], $checkAll=false;

    //model data
    public  $memberID, $phone, $date, $time, $technicianName;


    //deleting
    public function deleteSelected(){
         Appointment::destroy($this->checkedItems);

        // if appointmentID has been
        if(in_array($this->appointmentID,$this->checkedItems)){
            $this->appointmentID = null;
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

    //add data
    public function addData(){
        $this->menuOpen = true;
        $this->emptyData();
    }

    //edit data
    public function editData($id){
        $this->appointmentID = $id;
        $this->menuOpen = true;
        $appointment = Appointment::find($id);
        $this->memberID = $appointment->member_id;
        $this->phone = $appointment->phone;
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $this->technicianName = $appointment->technician_name;
    }


    public function pluckedMembers(){
        return array_map(function($el) {
            return  (string)$el;
          }, $this->appointments->pluck('id')->toArray());
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
        if(array_sum($this->checkedItems) == array_sum($this->appointments->pluck('id')->toArray())){
            $this->checkAll = true;
        }
        else{
            $this->checkAll = false;
        }
    }



    // private function checkForSubmitButton(){
    //     if(!empty($this->firstName) || !empty($this->lastName) || !empty($this->address) || !empty($this->phone) || !empty($this->email) || !empty($this->dob)){
    //         $this->submitButton = true;
    //     }
    //     else{
    //         $this->submitButton = false;
    //     }
    // }
    //cancel can be used in both add and update as it only empty appointments data;
    public function cancelEdit(){
        $this->menuOpen = false;
        $this->appointmentID = null;
        $this->emptyData();
    }

    public function submit(){
        if($this->appointmentID){
            $appointment = Appointment::find($this->appointmentID);
            $appointment->member_id=$this->memberID;
            $appointment->phone=$this->phone;
            $appointment->time=$this->time;
            $appointment->technician_name=$this->technicianName;
            if($this->date){
                $appointment->date=$this->date;
            }
            $appointment->update();
            $this->appointmentID = null;
            $this->menuOpen = false;
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Member Updated Successfully']);
        }
        else{
            $appointment = new Appointment();
            $appointment->member_id = $this->memberID;
            $appointment->phone=$this->phone;
            $appointment->time=$this->time;
            $appointment->technician_name=$this->technicianName;
            if($this->date){
                $appointment->date=$this->date;
            }
            $appointment->save();
            $this->menuOpen = false;
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Member Added Successfully']);
        }
        $this->emptyData();
    }

    private function emptyData(){
        $this->memberID = "";
        $this->phone = "";
        $this->date = "";
        $this->time = "";
        $this->technicianName = "";
    }

    public function render()
    {
         // $this->checkForSubmitButton();
         $this->appointments = Appointment::orderBy('created_at','desc')->get();
         $this->totalAppointments = $this->appointments->count();
        return view('livewire.appointments');
    }

}
