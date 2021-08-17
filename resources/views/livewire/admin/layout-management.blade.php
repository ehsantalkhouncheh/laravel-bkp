<div>
    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div>
                <x-input.text wire:model="filters.search" placeholder="Search layouts..." />
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



                <x-button.primary wire:click="create"><x-icon.plus/> New</x-button.primary>
            </div>
        </div>

        <!-- layouts Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('description')" :direction="$sorts['description'] ?? null">Description</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless ($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $layouts->count() }}</strong> layouts, do you want to select all <strong>{{ $layouts->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $layouts->total() }}</strong> layouts.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($layouts as $Layout)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $Layout->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $Layout->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400"/>

                                <p class="text-cool-gray-600 truncate">
                                    {{ $Layout->name }}
                                </p>
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $Layout->description }} </span>
                            </x-table.cell>

                            <x-table.cell>
                                <x-button.link wire:click="edit({{ $Layout->id }})">Edit</x-button.link>
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.link wire:click="editSection({{ $Layout->id }})">Sections</x-button.link>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No layouts found...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $layouts->links() }}
            </div>
        </div>
    </div>

    <!-- Delete layouts Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Layout</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Save Layout Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Layout</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="Name" :error="$errors->first('editing.name')">
                    <x-input.text wire:model="editing.name" id="name" placeholder="Name" />
                </x-input.group>

                <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                    <x-input.text wire:model="editing.description" id="description" placeholder="Description" />
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Save Section Modal -->
    <form wire:submit.prevent="saveSection">
        <x-modal.dialog wire:model.defer="showSectionModal">
            <x-slot name="title">Edit Section</x-slot>

            <x-slot name="content">

                <!-- Region Table -->
                <div class="flex-col space-y-4">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Section Name</x-table.heading>
                            <x-table.heading>Section Type</x-table.heading>
                            <x-table.heading></x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($layoutRegions as $index => $layoutRegion)
                                <x-table.row>

                                    <x-table.cell>
                                        <x-input.text name="layoutRegions[{{$index}}][name]" wire:model="layoutRegions.{{$index}}.name" id="layoutRegions[{{$index}}][name]" placeholder="Section Name" />
                                        <x-input.text type="hidden" name="layout_id" wire:model="layout_id" id="layoutRegions[{{$index}}][layout_id]"/>
                                    </x-table.cell>

                                    <x-table.cell>

                                        <x-input.select wire:model.debounce.10000ms="layoutRegions.{{$index}}.type" id="layoutRegions[{{$index}}][type]">
                                            <option value="" disabled>Section Type...</option>

                                            @foreach ($sectionTypes as $key=>$section)
                                                <option id="{{$key}}" value="{{ $section->name }}">
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </x-input.select>

                                    </x-table.cell>

                                    <x-table.cell>
                                        <x-button.secondary type="button" wire:click.prevent="removeRegion({{$index}})">remove</x-button.secondary>
                                    </x-table.cell>

                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                    <x-button.primary type="button" wire:click.prevent="addRegion">+ Add Another Section</x-button.primary>
                </div>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showSectionModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
