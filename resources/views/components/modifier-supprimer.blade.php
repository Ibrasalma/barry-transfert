                        <td class="px-4 py-2 text-right text-sm">
                            <x-jet-button wire:click="edit({{ props.modifier }})">
                                Modifier
                            </x-jet-button>
                            <x-jet-danger-button wire:click="delete({{ props.suprimer }})">
                                Suprimer
                            </x-jet-button>
                        </td>