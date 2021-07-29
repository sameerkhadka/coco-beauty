<div class="main">
    <div class="main-content {{ $menuOpen ? 'aside-open' : '' }}">
        <div class="main-header" x-data>
            <h2>Gift Vouchers</h2>
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
                    <th>V Num</th>
                    <th>Gift For</th>
                    <th>Amount</th>
                    <th>Issue Date</th>
                    <th>Expiry Date</th>
                    <th>Used Date</th>
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
                        <td>GC{{ $item->id }}</td>
                        <td>{{ $item->member->first_name }}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{ $item->issue_date }}</td>
                        <td>{{ $item->expiry_date }}</td>
                        <td>{{ $item->used_date ?? 'Not Used' }}</td>
                        <td>
                            <div class="actn-btn">
                                <a href="member-detail.html" class="view-btn"><i class="far fa-eye"></i></a>
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
            <h4>{{ isset($modelData['id']) ? 'Update' : 'Add' }} Gift Vouchers</h4>
            <form wire:submit.prevent="submit" autocomplete="off">
                <div class="addm-sing">
                    <label>Gift To</label>
                    <select id="searchable" style="width: 100%" wire:model.debounce.500ms="modelData.gift_for">
                        <option value="0" disabled>Select Member</option>
                        @foreach ($members as $item)
                            <option value="{{ $item->id }}">CBL{{ "{$item->id} - {$item->first_name} {$item->last_name}, {$item->phone}" }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="addm-sing">
                    <label>Amount</label>
                    <input type="text" wire:model.debounce.500ms="modelData.amount">
                </div>
                <div class="addm-sing">
                    <label>Issued Date</label>
                    <input type="date" wire:model.debounce.500ms="modelData.issue_date">
                </div>
                <div class="addm-sing">
                    <label>Expiry Date</label>
                    <input type="date" wire:model.debounce.500ms="modelData.expiry_date">
                </div>
                <button wire:loading.attr="disabled" class="aside-btn ">{{ isset($modelData['id']) ? 'Update' : 'Add' }}
                    Gift Vouchers</button>
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
            @this.set('modelData.gift_for',data);
            });
        })
    </script>
@endpush
