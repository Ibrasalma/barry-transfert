<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form enctype="form-data/multipart">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Marque du client:</label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="compte_id" id="compte_id" class="form-control">
                                <option>Selectionnez votre client</option>
                                @foreach($les_comptes as $le_compte)
                                    <option value="{!! $le_compte['id'] !!}"
                                            wire:key="{{$le_compte['id']}}"
                                            {{ $le_compte['id'] == $compte_id ? 'selected' : ''}}>
                                        {!! $le_compte['marque'] !!}
                                    </option>
                                @endforeach
                            </select>
                            @error('compte_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput4"
                                class="block text-gray-700 text-sm font-bold mb-2">Numero de facture:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput4" placeholder="Entrer le numéro de la facture" wire:model="numero_facture">
                            @error('numero_facture') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Montant:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput2" placeholder="Entrer le montant à payer en rmb" wire:model="montant">
                            @error('montant') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput3"
                                class="block text-gray-700 text-sm font-bold mb-2">Reçu:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput3" placeholder="Télécharger la photo" wire:model="photo">
                            @error('photo') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div> 
                        <div class="mb-4">
                            <label for="exampleFormControlDate"
                                class="block text-gray-700 text-sm font-bold mb-2">Date de dépôt:</label>
                            
                            <input 
                                wire:model="created_at"
                                type="date" 
                                placeholder="Date de depot" 
                                autocomplete="off"
                                data-provide="datepicker" data-date-autoclose="true" 
                                data-date-format="yyyy/dd/mm" data-date-today-highlight="true"                        
                                onchange="this.dispatchEvent(new InputEvent('input'))"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            >      
                            @error('created_at') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>  
                        <div class="mb-4">
                            <label for="exampleFormControlInput10"
                                class="block text-gray-700 text-sm font-bold mb-2">Détails:</label>
                            <textarea type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput10" placeholder="Mentionnez les détails du dépôt" wire:model="detail">
                            </textarea>
                            @error('detail') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>               
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Enregister
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Fermer
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>