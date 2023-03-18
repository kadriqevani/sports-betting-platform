<?php

namespace App\Http\Livewire;

use App\Models\UserHasMatches;
use App\Models\Matches as MatchesModel;
use Livewire\Component;


class Matches extends Component
{

    public int $userId = 0;

    public $team1;
    public $team2;
    public $isActive;
    public $matchId;
    public $hideMatches;

    protected $listeners = [
        'refresh-me' => '$refresh',
        'deleteMatchListener'=>'deleteMatch',
        'voteMatchListener'=>'voteMatch'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'team1' => 'required',
        'team2' => 'required',
        'isActive' => 'required'
    ];

    public $addMatch;

    public $updateMatch;

    public function refreshComponent(){
        $this->emitSelf('refresh-me');
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->team1 = '';
        $this->team2 = '';
        $this->isActive = '';
    }

    public function render()
    {
        $matches = [];
        if (!$this->hideMatches) {
            $results = MatchesModel::query()->with('userhasmatches');

            foreach($results->get()->toArray() as $result) {
                $votedTeamNr = '';
                foreach ($result['userhasmatches'] as $userhasmatch) {
                    if ($userhasmatch['user_id'] == auth()->user()->id){
                        $votedTeamNr = $userhasmatch['voted_team_nr'];
                        break;
                    }
                }
                $matches[] = [
                    'id' => $result['id'],
                    'team1' => $result['team1'],
                    'team2' => $result['team2'],
                    'isActive' => $result['isActive'],
                    'voted_team_nr' => $votedTeamNr
                ];
            }
        }
        return view('livewire/matches/match',compact('matches'));

    }

    /**
     * Open Add Post form
     * @return void
     */
    public function addMatch()
    {
        $this->resetFields();
        $this->addMatch = true;
        $this->updateMatch = false;
        $this->hideMatches = true;
    }

    public function cancelMatch(){
        $this->addMatch = false;
        $this->updateMatch = false;
        $this->hideMatches = false;
        $this->resetFields();
    }

    public function editMatch($id) {
        $match = MatchesModel::findOrFail($id);
        if( !$match) {
            session()->flash('error','Post not found');
        } else {
            $this->team1 = $match->team1;
            $this->team2 = $match->team2;
            $this->isActive = $match->isActive;
            $this->matchId = $match->id;
            $this->updateMatch = true;
            $this->hideMatches = true;
            $this->addMatch = false;
        }
    }

    public function updateMatch()
    {
        $this->validate();
        try {
            MatchesModel::whereId($this->matchId)->update([
                'team1' => $this->team1,
                'team2' => $this->team2,
                'isActive' => $this->isActive
            ]);
            session()->flash('success','Match Updated Successfully!!');
            $this->resetFields();
            $this->updateMatch = false;
            $this->hideMatches = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    public function storeMatch()
    {
        $this->validate();
        try {
            MatchesModel::create([
                'team1' => $this->team1,
                'team2' => $this->team2,
                'isActive' => $this->isActive
            ]);
            session()->flash('success','Post Created Successfully!!');
            $this->resetFields();
            $this->addMatch = false;
            $this->hideMatches = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }
    public function deleteMatch($id) {
        try{
            MatchesModel::find($id)->delete();
            session()->flash('success',"Post Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }

    public function voteMatch($matchId,$votedTeamNr) {
        try {
            UserHasMatches::query()->updateOrInsert(
                ['user_id'=>auth()->user()->id,'match_id'=>$matchId],
                [
                    'user_id' => auth()->user()->id,
                    'match_id' => $matchId,
                    'voted_team_nr' => $votedTeamNr
                ]
            );
        } catch (\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
