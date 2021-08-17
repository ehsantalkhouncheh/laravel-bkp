<div>
    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div>
                <x-input.text wire:model="filters.search" placeholder="Search pages..."/>
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
                        <x-icon.download class="text-cool-gray-400"/>
                        <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                                     class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/>
                        <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>


                <x-button.primary wire:click="create">
                    <x-icon.plus/>
                    New
                </x-button.primary>
            </div>
        </div>

        <!-- pages Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage"/>
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')"
                                     :direction="$sorts['name'] ?? null">Name
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('guard_name')"
                                     :direction="$sorts['guard_name'] ?? null">Guard Name
                    </x-table.heading>
                    <x-table.heading/>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless ($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $pages->count() }}</strong> pages, do you want to select all <strong>{{ $pages->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All
                                        </x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $pages->total() }}</strong> pages.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($pages as $page)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $page->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $page->id }}"/>
                            </x-table.cell>

                            <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400"/>

                                <p class="text-cool-gray-600 truncate">
                                    {{ $page->title }}
                                </p>
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                                <span class="text-cool-gray-900 font-medium">{{ $page->slug }} </span>
                            </x-table.cell>

                            <x-table.cell>
                                <x-button.link wire:click="edit({{ $page->id }})">Edit</x-button.link>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400"/>
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No pages found...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $pages->links() }}
            </div>
        </div>
    </div>

    <!-- Delete pages Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Page</x-slot>

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
            <x-slot name="title">Page</x-slot>

            <x-slot name="content">

                <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2" x-data="{ isShowing: false }">

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                        <x-input.text wire:model="editing.title" id="title" placeholder="Title"/>
                        <x-input.error for="editing.title" class="mt-2"/>
                    </div>

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                        <x-input.text wire:model="editing.slug" id="slug" placeholder="Slug"/>
                        <x-input.error for="editing.slug" class="mt-2"/>
                    </div>

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3" >
                        <x-input.select wire:model="editing.layout_id" id="layout" x-on:change="isShowing = $event.target.value">
                            <option value="">Select Layout...</option>
                            @foreach (App\Models\Layout::all()  as $key=>$layout)
                                <option value="{{ $layout->id }}">
                                    {{ $layout->name }}
                                </option>
                            @endforeach
                        </x-input.select>
                        <x-input.error for="editing.layout_id" class="mt-2"/>

                    </div>

                    <livewire:admin.section-field wire:model=""/>

                </div>

                <div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-2 md:-mx-2 lg:-mx-2 xl:-mx-2">

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                        <x-input.textarea wire:model="editing.meta_title" id="meta_title" placeholder="Meta Title"/>
                        <x-input.error for="editing.meta_title" class="mt-2"/>
                    </div>

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                        <x-input.textarea wire:model="editing.meta_description" id="meta_description" placeholder="Meta Description"/>
                        <x-input.error for="editing.meta_description" class="mt-2"/>
                    </div>

                    <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-2 sm:px-2 md:my-2 md:px-2 md:w-1/3 lg:my-2 lg:px-2 lg:w-1/3 xl:my-2 xl:px-2 xl:w-1/3">
                        <x-input.textarea wire:model="editing.meta_keyword" id="meta_keyword" placeholder="Meta Keyword"/>
                        <x-input.error for="editing.meta_keyword" class="mt-2"/>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
