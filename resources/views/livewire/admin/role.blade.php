<div>
    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div>
                <x-input.text wire:model="filters.search" placeholder="Search roles..." />
            </div>

            <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400"/> <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>

                <livewire:import-roles />

                <x-button.primary wire:click="create"><x-icon.plus/> New</x-button.primary>
            </div>
        </div>

        <!-- roles Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('guard_name')" :direction="$sorts['guard_name'] ?? null">Guard Name</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless ($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $roles->count() }}</strong> roles, do you want to select all <strong>{{ $roles->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $roles->total() }}</strong> roles.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($roles as $role)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $role->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $role->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400"/>

                                <p class="text-cool-gray-600 truncate">
                                    {{ $role->name }}
                                </p>
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $role->guard_name }} </span>
                            </x-table.cell>

                            <x-table.cell>
                                <x-button.link wire:click="edit({{ $role->id }})">Edit</x-button.link>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No roles found...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>

    <!-- Delete roles Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Role</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Save Transaction Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Role</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="Name" :error="$errors->first('editing.name')">
                    <x-input.text wire:model="editing.name" id="name" placeholder="Name" />
                </x-input.group>

                <x-input.group for="guard_name" label="Guard Name" :error="$errors->first('editing.guard_name')">
                    <x-input.text wire:model="editing.guard_name" id="guard_name" placeholder="Guard Name" />
                </x-input.group>

                <x-input.group for="selectedPermission" label="Permissions" :error="$errors->first('permissions')">
                    @foreach($permissions as $index=> $permission)
                        <x-input.checkbox2 wire:model="selectedPermission.{{$permission->id}}" id="{{$permission->id}}">{{$permission->name}}</x-input.checkbox2>
                    @endforeach
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
