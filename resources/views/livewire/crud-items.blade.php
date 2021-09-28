<div class="main">
    <div class="main-content {{ $menuOpen ? 'aside-open' : '' }}">
        <div class="main-header" x-data>
            <h2>Items</h2>
            <div class="mn-right">
                @if (!isset($modelData['id']) && !$menuOpen)
                    <a href="#" id="deleteMultiple" wire:click="{{ !empty($checkedItems) ? 'confirmBox()' : '' }}" class="del-btn">Delete</a>
                    <a href="#" wire:click="addData()" class="new-btn">Add New</a>
                @endif
                @if($menuOpen)
                    <a href="#" wire:click="cancelEdit()" class="new-btn">Cancel</a>
                @endif
            </div>
        </div>

        <div class="search">
            <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
            <i class="fas fa-search"></i>
        </div>
        <div class="content">
            <table class="member" id="member">
                <thead>
                <tr>
                    <th><input type="checkbox" wire:model="checkAll">
                        <span class="checkmark"></span>
                    </th>
                    <th>Name</th>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th class="action">Action</th>
                </tr>
                </thead>

                <tbody x-data>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $item->id }}" wire:model="checkedItems">
                            <span class="checkmark"></span>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->service->name }}</td>
                        <td>{{ $item->type ?? '-' }}</td>
                        <td>{{ $item->price ? '$'.$item->price : '$'.$item->range ?? '-' }}</td>
                        <td>
                            <div class="actn-btn">
                                <a href="#" wire:click="editData({{ $item->id }})" class="edit-btn"><i class="far fa-edit"></i></a>
                                <a href="#" wire:click="confirmBox({{ $item->id }})" class="delete-single"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-aside {{ $menuOpen ? 'open' : '' }}">
        <div class="add-mem">
            <h4>{{ isset($modelData['id']) ? 'Update' : 'Add' }} Items</h4>
            <form wire:submit.prevent="submit" autocomplete="off">
                <div class="addm-sing">
                    <label>Service</label>
                    <select id="searchable" style="width: 100%" wire:model.debounce.500ms="modelData.service_id">
                        @foreach ($services as $item)
                            <option value="{{ $item->id }}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="addm-sing">
                    <label>Name</label>
                    <input type="text" wire:model.debounce.500ms="modelData.name">
                </div>
                <div class="addm-sing">
                    <label>Type</label>
                    <input type="text" wire:model.debounce.500ms="modelData.type">
                </div>
                <div class="addm-sing">
                    <label>Price</label>
                    <input type="number" wire:model.debounce.500ms="modelData.price">
                </div>
                <div class="addm-sing">
                    <label>Price Range</label>
                    <input type="text" wire:model.debounce.500ms="modelData.range">
                </div>
                <button wire:loading.attr="disabled" class="aside-btn ">{{ isset($modelData['id']) ? 'Update' : 'Add' }}
                    Items</button>
            </form>
        </div>
    </div>
    <div wire:loading wire:target = "editData, cancelEdit, submit,addData, confirmBox, updateSorting" class="loading">
        Loading! Please Wait...
    </div>
</div>

<style>
    .search-filter a.filter-active{
        background: #b1b1b4;
        color: #000;
    }
    .loading {
        background: #d6be58;
        position: absolute;
        color: #000001;
        top: 50%;
        left: 48%;
        padding: 0px 5px;
        border: 1px solid #786618;
        font-size: 12px;
        border-radius: 4px;
    }

</style>

@push('scripts')
    <script>
        window.addEventListener('select2', function(e) {
            $('#searchable').select2();
            $('#searchable').change(function(){
                var data = $('#searchable').select2("val");
                @this.set('modelData.service_id',data);
            });
        })
    </script>
@endpush
