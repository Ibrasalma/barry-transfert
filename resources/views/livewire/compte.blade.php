<x-slot name="header">
    <h2 class="text-center">Gestion des clients</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                Enregistrer un nouveau client
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
                        <td class="border px-4 py-2">{{ $compte->qr_wechat}}</td>
                        <td class="border px-4 py-2">{{ $compte->qr_alipay}}</td>
                        <td class="border px-4 py-2">{{ $compte->created_at}}</td>
                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ $compte->id }})">
                                {{ __('Update') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="delete({{ $compte->id }})">
                                {{ __('Delete') }}
                            </x-jet-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- The Delete Modal --}}

    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this page? Once the page is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Page') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>