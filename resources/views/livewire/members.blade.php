<div class="main">
    <div class="main-content {{ $menuOpen ? 'aside-open' : '' }}">
        <div class="main-header" x-data>
            <h2>Members</h2>
            <div class="mn-right">
                @if (!$memberID && !$menuOpen)
                <a href="#" id="deleteMultiple" wire:click="{{ !empty($checkedItems) ? 'confirmBox()' : '' }}" class="del-btn">Delete</a>
                <a href="#" wire:click="addMember()" class="new-btn">Add New</a>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>

                <tbody x-data>
                    @foreach ($members as $item)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $item->id }}" wire:model="checkedItems">
                                <span class="checkmark"></span>
                            </td>
                            <td>CBL{{ $item->id }}</td>
                            <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <div class="actn-btn">
                                    <a href="" class="servie-btn"><i class="fas fa-external-link-alt"></i></a>
                                    <a href="{{ route('member-detail',"id={$item->id}") }}" class="view-btn"><i class="far fa-eye"></i></a>
                                    <a href="#" wire:click="editMember({{ $item->id }})" class="edit-btn"><i class="far fa-edit"></i></a>
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
            <h4>{{ $memberID ? 'Update' : 'Add' }} Membership</h4>
            <form wire:submit.prevent="submit" autocomplete="off">
                <div class="addm-sing">
                    <label>First Name</label>
                    <input type="text" wire:model.debounce.500ms="firstName" autocomplete="off">
                </div>

                <div class="addm-sing">
                    <label>Last Name</label>
                    <input type="text" wire:model.debounce.500ms="lastName" autocomplete="off">
                </div>

                <div class="addm-sing">
                    <label>Address</label>
                    <input type="text" wire:model.debounce.500ms="address" autocomplete="off">
                </div>

                <div class="addm-sing">
                    <label>Phone</label>
                    <input type="number" wire:model.debounce.500ms="phone" autocomplete="off">
                </div>

                <div class="addm-sing">
                    <label>Email</label>
                    <input type="email" wire:model.debounce.500ms="email" autocomplete="off">
                </div>

                <div class="addm-sing">
                    <label>DOB</label>
                    <input type="date" wire:model.debounce.500ms="dob">
                </div>
                <button wire:loading.attr="disabled" class="aside-btn ">{{ $memberID ? 'Update' : 'Add' }}
                        Membership</button>
            </form>
        </div>
    </div>
    <div wire:loading wire:target = "editMember, cancelEdit, submit,addMember" class="loading">
        Loading! Please Wait...
    </div>
</div>

<style>
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
