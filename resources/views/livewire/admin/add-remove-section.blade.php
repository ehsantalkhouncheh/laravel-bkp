<div>
    <form action="" method="POST">
    @csrf

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
                                <x-input.text name="layoutRegions[{{$index}}][content]" wire:model="layoutRegions.{{$index}}.content" id="content" placeholder="Component" />
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.secondary type="button" wire:click.prevent="removeRegion({{$index}})">remove</x-button.secondary>
                            </x-table.cell>

                            <x-table.cell>

                                <x-input.select wire:model="layoutRegions.{{$index}}.region_id" id="layoutRegions[{{$index}}][region_id]">
                                    <option value="" disabled>Section Type...</option>

                                    @foreach ($sectionTypes as $region)
                                        <option value="{{ $region->id }}">
                                            {{ $region->name }} {{ $region->content}}
                                        </option>
                                    @endforeach
                                </x-input.select>

                            </x-table.cell>

                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            <x-button.primary type="button" wire:click.prevent="addRegion">+ Add Another Region</x-button.primary>
        </div>
    </form>
</div>
