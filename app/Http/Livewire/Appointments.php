<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Member;
use Carbon\Carbon;
use Livewire\Component;
use Mail;

class Appointments extends Component
{
    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];

    //extra variables
    public $members, $sortDate, $isMember="0";

    //commons
    public $items,$checkbox,$menuOpen=false, $submitButton = false, $checkedItems=[], $checkAll=false;

    //model data
    public $modelData = [
        'member_id'=>'',
        'name'=>'',
        'phone'=>'',
        'email'=>'',
        'date'=>'',
        'time'=>'',
        'technician_name'=>''
    ];

    public function gotoCheckOutPage(){
        if(session('cart')){
            $cart = session('cart');
            if(count($cart['items'])>0){
                return $this->redirect('/checkout');
            }

        }
        $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'info','message'=>'Cart is empty.']);
    }

    public function updatedIsMember(){
        $this->modelData['member_id']="0";
        $this->modelData['name'] = "";
    }

    //deleting
    public function deleteSelected(){
         Appointment::destroy($this->checkedItems);

        // if appointmentID has been
        if(isset($this->modelData['id'])){
            if(in_array($this->modelData['id'],$this->checkedItems)){
                $this->emptyData();
                $this->menuOpen = false;
            }
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
        $this->emptyData();
        $this->menuOpen = true;
        $this->modelData['member_id'] = "0";
    }

    //edit data
    public function editData($id){
        $this->emptyData();
        $appointment = Appointment::find($id)->toArray();
        $this->modelData = $appointment;
        $this->menuOpen = true;
    }


    public function pluckedMembers(){
        return array_map(function($el) {
            return  (string)$el;
          }, $this->items->pluck('id')->toArray());
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
        if(array_sum($this->checkedItems) == array_sum($this->items->pluck('id')->toArray())){
            $this->checkAll = true;
        }
        else{
            $this->checkAll = false;
        }
    }

    //cancel can be used in both add and update as it only empty items data;
    public function cancelEdit(){
        $this->menuOpen = false;
        $this->emptyData();
    }

    public function submit(){
        $data = [
            'email' => '',
            'name' => '',
            'creation' => '',
            'time'=> $this->modelData['time'],
            'date'=> $this->modelData['date'],
            'technician_name' => $this->modelData['technician_name']
        ];
        // if date is empty then set it to null as it will throw error
        if(!$this->modelData['date']) $this->modelData['date'] = null;
        if(!$this->modelData['member_id']) {
            $this->modelData['member_id'] = null;
        }
        else{
            // if user is member
            $member = Member::find($this->modelData['member_id']);
            // if member have their email account then set data
            if($member->email){
                $data['email'] = $member->email;
                $data['name'] = $member->first_name.' '.$member->last_name;
            }
        }

        if(isset($this->modelData['id'])){
            $appointment = Appointment::find($this->modelData['id'])->update($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Appointment Updated Successfully']);
        }
        else{
            if($data['email']){
                Mail::send('email.appointment.creation', $data , function($message) use ($data)
                {
                    $message->from('test@keronevatravel.com','Coco Beauty Lounge');
                    $message->to($data['email'], $data['name']);
                    $message->subject('Appointment on '.$data['date']);
                });
            }
            Appointment::create($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Appointment Added Successfully']);
        }
        // updateSorting function have empty data and sorting to null
        $this->updateSorting('all');
        $this->menuOpen = false;
    }

    private function emptyData(){
        $this->checkAll=false;
        $this->checkedItems = [];
        $this->modelData = [
            'member_id'=>'',
            'name'=>'',
            'phone'=>'',
            'email'=>'',
            'date'=>'',
            'time'=>'',
            'technician_name'=>''
        ];
    }

    public function mount()
    {
        $this->sortDate = [
            'date' => null,
            'type' => 'all'
        ];
    }

    public function updateSorting($type){
        $this->emptyData();
        switch($type){
            case 'today':
                $this->sortDate=[
                    'date' => Carbon::today()->toDateString(),
                    'type' => $type
                ];
                break;
            case 'tomorrow':
                $this->sortDate=[
                    'date' => Carbon::today()->addDays(1)->toDateString(),
                    'type' => $type
                ];
                break;
            case 'nextWeek':
                $this->sortDate=[
                    'date' => Carbon::today()->addDays(7)->toDateString(),
                    'type' => $type
                ];
                break;
            default:
                $this->sortDate = [
                    'date' => null,
                    'type' => 'all'
                ];
                break;
        }

    }

    public function render()
    {
        $this->dispatchBrowserEvent('select2');
        $this->members =  Member::all();
        if($this->modelData['member_id']) $this->isMember = "1";

        // sortDate is an array which stores date and type of sorting (eg: type: tomorrow)
        $sortDate = $this->sortDate;
        $this->items = Appointment::orderBy('created_at','desc')->when($sortDate['date'], function($query) use ($sortDate) {
             return $query->whereDate('date','=',$sortDate['date']);
            })->get();
        return view('livewire.appointments');
    }

}
