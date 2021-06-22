<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
class CrudServices extends Component
{
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed'=>'deleteSelected'];


    //extra
    public $serviceHardImage;

    //commons
    public $items,$checkbox,$menuOpen=false, $submitButton = false, $checkedItems=[], $checkAll=false;

    //model data
    public $modelData = [
        'name'=>'',
        'image'=>'',
        'order'=>null
    ];

    //deleting
    public function deleteSelected(){
        Service::destroy($this->checkedItems);

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
        $appointment = Service::find($id)->toArray();
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
            if($this->serviceHardImage){
                $imageName = md5($this->serviceHardImage->getClientOriginalName() . time()).'.'.$this->serviceHardImage->getClientOriginalExtension();
                // store image to directory and location to modelData.image i.e services/image.jpg
                $this->serviceHardImage->storeAs('public/services', $imageName);
                $this->modelData['image'] = "services/{$imageName}";
                Service::find($this->modelData['id'])->update($this->modelData);
            }
            $this->emptyData();
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Service Updated Successfully']);
        }
        else{
            $id = Service::create($this->modelData)->id;
            if($this->serviceHardImage){
                $imageName = md5($this->serviceHardImage->getClientOriginalName() . time()).'.'.$this->serviceHardImage->getClientOriginalExtension();
                // store image to directory and location to modelData.image i.e services/image.jpg
                $this->serviceHardImage->storeAs('public/services', $imageName);
                $this->modelData['image'] = "services/{$imageName}";
                Service::find($id)->update($this->modelData);
            }
            $this->emptyData();
            $this->dispatchBrowserEvent('from-backend',['is'=>'toastr','type'=>'success','message'=>'Service Added Successfully']);
        }
        $this->menuOpen = false;
    }

    private function emptyData(){
        $this->checkAll=false;
        $this->serviceHardImage = null;
        $this->checkedItems = [];
        $this->modelData = [
            'name'=>'',
            'image'=>'',
            'order'=>null
        ];
    }

    public function mount()
    {
        $this->sortDate = [
            'date' => null,
            'type' => 'all'
        ];
    }

    public function render()
    {
        $this->items = Service::orderBy('created_at','desc')->get();
        return view('livewire.crud-services');
    }
}
