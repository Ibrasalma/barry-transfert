<x-slot name="header">
    <h2 class="text-center">Gestion des payements de facture</h2>
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
                Enregistrer un nouveau payement de facture
            </button>
            @if($isModalOpen)
            @include('livewire.create_payment')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Numero de facture</th>
                        <th class="px-4 py-2">Montant (RMB)</th>
                        <th class="px-4 py-2">Total versée</th>
                        <th class="px-4 py-2">Reste à versée</th>
                        <th class="px-4 py-2">Moyen de payement</th>
                        <th class="px-4 py-2">Reçu</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">Date de dépôt</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($payments as $payement)
                    <tr>
                        <?php 
                            $le_code = App\Models\Facture::where('id',$payement->code)->firstOrFail();
                        ?>
                        <td class="border px-4 py-2">{{ $le_code->numero_facture }}</td>
                        <td class="border px-4 py-2">{{ $payement->montant_versee}}</td>
                        <td class="border px-4 py-2">{{ $payement->total_versee}}</td>
                        <td class="border px-4 py-2">{{ $payement->reste}}</td>
                        <td class="border px-4 py-2">{{ $payement->moyen_versement}}</td>
                        <td class="border px-4 py-2"><img src="{{ url(imagePath('payments',$payement->notification)) }}"></td>
                        <td class="border px-4 py-2">{{ $payement->detail}}</td>
                        <td class="border px-4 py-2">{{ $payement->created_at}}</td>
                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ $payement->id }})">
                                {{ __('Modifier') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="suprimer({{ $payement->id }})">
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