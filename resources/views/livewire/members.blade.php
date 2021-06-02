<div class="main">
    <div class="main-content">
        <div class="main-header" x-data>
            <h2>Members</h2>
            @if (!$memberID)
                <button x-on:click="confirm('Are You Sure') ? @this.deleteSelected() : ''">Delete Selected</button>
            @endif
        </div>

        <div class="search">
            <input type="text" placeholder="Search" class="searchInput" onkeyup="searchFunction()">
            <i class="fas fa-search"></i>
        </div>

        <div class="content">
            <table class="member " id="member">
                <thead>
                    <tr>
                        <th><input type="checkbox" wire:model="checkAll">
                            <span class="checkmark"></span>
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($members as $item)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $item->id }}" wire:model="checkedItems">
                                <span class="checkmark"></span>
                            </td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td><button wire:click="editMember({{ $item->id }})">Edit</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-aside">
        <div class="main-header">
            <h4>All Members</h4>

            <h2>{{ $totalMembers }}</h2>
        </div>

        <div class="add-mem">
            <h4>{{ $memberID ? 'Update' : 'Add' }} Membership</h4>
            @if ($memberID)
                <button wire:click="cancelEdit">Cancel</button>
            @endif
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
                @if ($submitButton)
                    <button wire:loading.attr="disabled" class="aside-btn ">{{ $memberID ? 'Update' : 'Add' }}
                        Membership</button>
                @endif
            </form>
        </div>
    </div>
    <div wire:loading.delay class="loading">
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
