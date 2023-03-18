<div class="card ">
    <div class="card-body ">
        <form class="max-w-sm m-auto m-1 p-4 rounded dark:bg-gray-900 ">
            <div class="relative z-0 w-full mb-6 group">
                <input wire:model.defer="team1" type="text" name="team1" id="team1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="team1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Team 1</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input wire:model.defer="team2" type="text" name="team2" id="team2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="team2" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Team 2</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="isActive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select wire:model.defer="isActive" type="text" name="isActive" id="isActive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option></option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
            </div>
            <div class="flex justify-between">

                <button @if($addMatch) wire:click.prevent="storeMatch()" @elseif($updateMatch) wire:click.prevent="updateMatch()" @endif class="bg-green-500 text-center hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Save</button>
                <button wire:click.prevent="cancelMatch()" class="bg-gray-500 text-center hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>
