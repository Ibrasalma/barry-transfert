<x-slot name="header">
    <h2 class="text-center">Liste des factures non payéss</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Compte</th>
                        <th class="px-4 py-2">Numero de facture</th>
                        <th class="px-4 py-2">Montant (RMB)</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Reçu</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">Date de dépôt</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($transferts_not_paid as $transfert)
                    <tr>
                        <?php 
                            $le_client = App\Models\Compte::where('id',$transfert->compte_id)->firstOrFail();
                        ?>
                        <td class="border px-4 py-2">{{ $le_client->marque }}</td>
                        <td class="border px-4 py-2">{{ $transfert->numero_facture}}</td>
                        <td class="border px-4 py-2">{{ $transfert->montant_rmb}}</td>
                        <td class="border px-4 py-2">{{ $transfert->statut}}</td>
                        <td class="border px-4 py-2"><img src="{{ url(imagePath('factures',$transferts->photo)) }}"></td>
                        <td class="border px-4 py-2">{{ $transfert->detail}}</td>
                        <td class="border px-4 py-2">{{ $transfert->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>