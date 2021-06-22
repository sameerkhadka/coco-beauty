<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Service;
use Livewire\Component;

class CrudItems extends Component
{

    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];

    //extra
    public $services;

    //commons
    public $items,$checkbox,$menuOpen=false, $submitButton = false, $checkedItems=[], $checkAll=false;

    //model data
    public $modelData = [
        'name'=>'',
        'service_id'=>'',
        'type'=>null,
        'price'=>null,
        'range'=>''
    ];

    //deleting
    public function deleteSelected(){
        Item::destroy($this->checkedItems);

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
        $this->modelData['service_id'] = $this->services[0]['id'];

    }

    //edit data
    public function editData($id){
        $this->emptyData();
        $appointment = Item::find($id)->toArray();
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
            if(!$this->modelData['price']) $this->modelData['price'] = null;
            Item::find($this->modelData['id'])->update($this->modelData);
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Item Updated Successfully']);
        }
        else{
            if(!$this->modelData['price']) $this->modelData['price'] = null;
            Item::create($this->modelData);
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
            'service_id'=>'',
            'type'=>null,
            'price'=>null,
            'range'=>''
        ];

    }

    public function mount()
    {
        $this->services = Service::orderBy('created_at','desc')->get();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('select2');
        $this->items = Item::orderBy('created_at','desc')->get();
        return view('livewire.crud-items');
    }
}
