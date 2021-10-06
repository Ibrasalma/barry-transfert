<x-slot name="header">
    <h2 class="text-center">Gestion des dépôt d'argent</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($isDeleteModalOpen)
        @include('livewire.delete_modal')
        @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            @include('livewire.session_message')
            @endif
            <button wire:click="create()"
                class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                Enregistrer un nouveau depot
            </button>
            @if($isModalOpen)
            @include('livewire.create_depot')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Client</th>
                        <th class="px-4 py-2">Code</th>
                        <th class="px-4 py-2">Montant (Dollar)</th>
                        <th class="px-4 py-2">Montant (RMB)</th>
                        <th class="px-4 py-2">Recepteur</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">Date de dépôt</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($depots as $depot)
                    <tr>
                        <?php 
                            $le_client = App\Models\Student::where('id',$depot->client_id)->firstOrFail();
                        ?>
                        <td class="border px-4 py-2">{{ $le_client->name }}</td>
                        <td class="border px-4 py-2">{{ $depot->code_depot}}</td>
                        <td class="border px-4 py-2">{{ $depot->montant}}</td>
                        <td class="border px-4 py-2">{{ $depot->montant_rmb}}</td>
                        <td class="border px-4 py-2">{{ $depot->recepteur}}</td>
                        <td class="border px-4 py-2">{{ $depot->statut}}</td>
                        <td class="border px-4 py-2">{{ $depot->detail}}</td>
                        <td class="border px-4 py-2">{{ $depot->created_at}}</td>
                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ $depot->id }})">
                                {{ __('Modifier') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="suprimer({{ $depot->id }})">
                                {{ __('Suprimer') }}
                            </x-jet-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>