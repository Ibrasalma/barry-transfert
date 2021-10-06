<x-slot name="header">
    <h2 class="text-center">Gestion des factures</h2>
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
                Enregistrer une nouvelle facture
            </button>
            @if($isModalOpen)
            @include('livewire.create_facture')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Compte</th>
                        <th class="px-4 py-2">Numero de facture</th>
                        <th class="px-4 py-2">Montant (RMB)</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Reçu</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">Date de facturation</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($factures as $facture)
                    <tr>
                        <?php 
                            $le_client = App\Models\Compte::where('id',$facture->compte_id)->firstOrFail();
                        ?>
                        <td class="border px-4 py-2">{{ $le_client->marque }}</td>
                        <td class="border px-4 py-2">{{ $facture->numero_facture}}</td>
                        <td class="border px-4 py-2">{{ $facture->montant_rmb}}</td>
                        <td class="border px-4 py-2">{{ $facture->statut}}</td>
                        <td class="border px-4 py-2"><img src="{{ url(imagePath('factures',$facture->photo)) }}"></td>
                        <td class="border px-4 py-2">{{ $facture->detail}}</td>
                        <td class="border px-4 py-2">{{ $facture->created_at}}</td>
                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ $facture->id }})">
                                {{ __('Modifier') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="suprimer({{ $facture->id }})">
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