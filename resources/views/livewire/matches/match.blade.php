<div class="relative m-5 justify-items-center">
    @if(session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Success alert!</span> {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Danger alert!</span> {{ session()->get('error') }}
        </div>
    @endif
    @if(!$addMatch && !$updateMatch)
        <div class="text-center">
            <button wire:click="addMatch()" class="bg-green-500 text-center hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Add New Match</button>
        </div>
    @endif
    @if($addMatch || $updateMatch)
        @include('livewire.matches.updateOrCreate')
    @endif
    @php($isAdmin = rand(1,100)<=50)

    @if(!$hideMatches)
        <table class="max-w-screen-sm mt-5 m-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Team1
            </th>
            <th scope="col" class="px-6 py-3">
                Team2
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>

            @if($isAdmin)
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            @endif
        </tr>
        </thead>
        <tbody x-data="">
        @forelse ($matches as $match)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap
                {{ $match['voted_team_nr'] == 1 ? "dark:text-white" : "text-gray"}} ">
                    <button @click="voteTeam({{$match['id']}},1)" type="button">{{$match['team1']}}</button>
                </th>
                <td class="px-6 py-4
                {{ $match['voted_team_nr'] == 2 ? "dark:text-white" : "text-gray"}} ">
                    <button @click="voteTeam({{$match['id']}},2)" type="button">{{$match['team2']}}</button>
                </td>
                <td class="px-6 py-4">
                    {{$match['isActive'] ? 'Active' : 'Inactive'}}
                </td>
                @if($isAdmin)
                    <td class="px-6 py-4">
                        <button wire:click="editMatch({{$match['id']}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                        <button onclick="deleteMatch({{$match['id']}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </td>
                @endif
            </tr>
        @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="@if($isAdmin){{4}}@else{{3}}@endif" class="px-6 py-4 text-center">No matches</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @endif
</div>

@section('local-scripts')
    <script type="text/javascript">
        function voteTeam(id,team_nr) {
            if(confirm("Are you sure to vote for Team "+team_nr))
                window.livewire.emit('voteMatchListener',id,team_nr);
        }

        function deleteMatch(id){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteMatchListener',id);
        }
    </script>
@endsection

