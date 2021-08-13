<?php

namespace App\Http\Livewire;

use App\Models\BandiColourGel;
use Livewire\Component;

class CrudBandiColourGel extends Component
{

    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];

    //commons
    public $items,$checkbox,$menuOpen=false, $submitButton = false, $checkedItems=[], $checkAll=false;

    //model data
    public $modelData = [
        'name'=>'',
    ];

    //deleting
    public function deleteSelected(){
        BandiColourGel::destroy($this->checkedItems);

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
    }

    //edit data
    public function editData($id){
        $this->emptyData();
        $appointment = BandiColourGel::find($id)->toArray();
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
        if(isset($this->modelData['id'])){
            BandiColourGel::find($this->modelData['id'])->update($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Item Updated Successfully']);
        }
        else{
            BandiColourGel::create($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Item Added Successfully']);
        }
        $this->emptyData();
        $this->menuOpen = false;
    }

    private function emptyData(){
        $this->checkAll=false;
        $this->checkedItems = [];
        $this->modelData = [
            'name'=>'',
        ];

    }

    public function mount()
    {

    }
    public function render()
    {
        $this->items = BandiColourGel::orderBy('id','desc')->get();
        return view('livewire.crud-bandi-colour-gel');
    }
}
