<x-slot name="header">
    <h2 class="text-center">Liste des dépôts d'argent déjà payés</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Client</th>
                        <th class="px-4 py-2">Code</th>
                        <th class="px-4 py-2">Montant (Dollar)</th>
                        <th class="px-4 py-2">Montant (RMB)</th>
                        <th class="px-4 py-2">Recepteur</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">Date de dépôt</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($depots_paid as $depot)
                    <tr>
                        <?php 
                            $le_client = App\Models\Student::where('id',$depot->client_id)->firstOrFail();
                        ?>
                        <td class="border px-4 py-2">{{ $le_client->name }}</td>
                        <td class="border px-4 py-2">{{ $depot->code_depot}}</td>
                        <td class="border px-4 py-2">{{ $depot->montant}}</td>
                        <td class="border px-4 py-2">{{ $depot->montant_rmb}}</td>
                        <td class="border px-4 py-2">{{ $depot->recepteur}}</td>
                        <td class="border px-4 py-2">{{ $depot->detail}}</td>
                        <td class="border px-4 py-2">{{ $depot->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>