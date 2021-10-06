<x-slot name="header">
    <h2 class="text-center">Gestion des comptes</h2>
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
                Enregistrer un nouveau compte
            </button>
            @if($isModalOpen)
            @include('livewire.create_compte')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nom complet</th>
                        <th class="px-4 py-2">Marque</th>
                        <th class="px-4 py-2">Telephone</th>
                        <th class="px-4 py-2">Wechat ID</th>
                        <th class="px-4 py-2">Compte bancaire</th>
                        <th class="px-4 py-2">QR Wechat</th>
                        <th class="px-4 py-2">QR Alipay</th>
                        <th class="px-4 py-2">Date de création</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comptes as $compte)
                    <tr>
                        <td class="border px-4 py-2">{{ $compte->name }}</td>
                        <td class="border px-4 py-2">{{ $compte->marque}}</td>
                        <td class="border px-4 py-2">{{ $compte->telephone}}</td>
                        <td class="border px-4 py-2">{{ $compte->wechat_id}}</td>
                        <td class="border px-4 py-2">{{ $compte->compte_bancaire}}</td>
                        <td class="border px-4 py-2"><img src="{{ url(imagePath('comptes',$compte->qr_wechat)) }}"></td>
                        <td class="border px-4 py-2"><img src="{{ url(imagePath('comptes',$compte->qr_alipay)) }}"></td>
                        <td class="border px-4 py-2">{{ $compte->created_at}}</td>
                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ $compte->id }})">
                                {{ __('Modifier') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="suprimer({{ $compte->id }})">
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