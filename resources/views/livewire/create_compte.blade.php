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
                                class="block text-gray-700 text-sm font-bold mb-2">Nom complet:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Entrer le nom réel ecrit sur son compte bancaire + english name" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>               
                        <div class="mb-4">
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Marque:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput2" placeholder="Taper la marque de votre client" wire:model="marque">
                            @error('marque') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>     
                        <div class="mb-4">
                            <label for="exampleFormControlInput3"
                                class="block text-gray-700 text-sm font-bold mb-2">Téléphone:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput3" placeholder="Entrer le numéro de téléphone de votre client" wire:model="mobile">
                            @error('mobile') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>     
                        <div class="mb-4">
                            <label for="exampleFormControlInput4"
                                class="block text-gray-700 text-sm font-bold mb-2">Wechat ID:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput4" placeholder="Entrer le nom réel ecrit sur son compte bancaire + english name" wire:model="wechat_id">
                            @error('wechat_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>     
                        <div class="mb-4">
                            <label for="exampleFormControlInput5"
                                class="block text-gray-700 text-sm font-bold mb-2">Compte banquaire:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput5" placeholder="Entrer le compte bancaire de votre client" wire:model="compte_bancaire">
                            @error('compte_bancaire') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>     
                        <div class="mb-4">
                            <label for="exampleFormControlInput6"
                                class="block text-gray-700 text-sm font-bold mb-2">Qr Wechat:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput6" placeholder="uploader le code qr wechat de votre client" wire:model="qr_wechat">
                            @error('qr_wechat') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>  
                        <div class="mb-4">
                            <label for="exampleFormControlInput7"
                                class="block text-gray-700 text-sm font-bold mb-2">Qr Alipay:</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput7" placeholder="uploader le code qr wechat de votre client" wire:model="qr_alipay">
                            @error('qr_alipay') <span class="text-red-500">{{ $message }}</span>@enderror
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