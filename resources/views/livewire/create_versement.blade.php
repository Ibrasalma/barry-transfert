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
                                class="block text-gray-700 text-sm font-bold mb-2">Code de depôt:</label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="depot_id" id="depot_id" class="form-control">
                                <option>Selectionnez votre facture</option>
                                @foreach($les_depots as $le_depot)
                                    <option value="{!! $le_depot->id !!}"
                                            wire:key="{{$le_depot->id}}"
                                            {{ $le_depot->id == $depot_id ? 'selected' : ''}}>
                                        {!! $le_depot['code_depot'] !!}
                                    </option>
                                @endforeach
                            </select>
                            @error('depot_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4"> 
                            <label for="montant"
                                class="block text-gray-700 text-sm font-bold mb-2">Montant:{{ value(App\Models\Depot::where('id',$depot_id)->get('montant_rmb')) }} et {{ value(App\Models\Versement::where('code',$depot_id)->orderBy('id', 'desc')->take(1)->get('reste'))}}</label> 
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="montant" placeholder="Entrer le montant déposé en dollar" wire:model="montant">
                            @error('montant') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput6"
                                class="block text-gray-700 text-sm font-bold mb-2">Moyen de payement:</label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="moyen_payement" id="exampleFormControlInput6" class="form-control">
                                <option>Selectionnez la methode de payement client</option>
                                <option value="cash" wire:key="cash">
                                    Par Cash
                                </option>
                                <option value="carte_bancaire" wire:key="carte_bancaire">
                                    Par Carte banquaire
                                </option>
                                <option value="alipay" wire:key="alipay">
                                    Par Alipay
                                </option>
                                <option value="wechat" wire:key="wechat">
                                    Par Wechat
                                </option>
                            </select>
                            @error('moyen_payement') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput3"
                                class="block text-gray-700 text-sm font-bold mb-2">Reçu de notification:</label>
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
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">      
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