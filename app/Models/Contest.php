<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'contestants_needed',
        'prize',        
        'registration_start_at',
        'registration_end_at',
        'vote_start_at',
        'vote_end_at',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function contestants(){
        return $this->hasMany(Contestant::class);
    }

    public function total_votes(){
        $votes = 0;
        foreach($this->contestants as $contestant){
            foreach($contestant->votes as $vote){
                $votes +=  $vote->number_of_votes;
            }            
        }
        return $votes;
    }

    public function registration_status(){
        return now() < $this->registration_start_at ? null : (now() < $this->registration_end_at ? "active" : "closed");
    }

    public function voting_status(){
        return now() < $this->vote_start_at ? null : (now() < $this->vote_end_at ? "active" : "closed");
    }

    public function highest_votes(){
        $first_contestant = $this->contestants()->orderBy('number_of_votes', 'DESC')->first();
        return $first_contestant->number_of_votes ?? null;
    }

    public function registration_duration(){
        return round($this->getDuration($this->registration_start_at, $this->registration_end_at));
    }

    public function voting_duration(){
        return round($this->getDuration($this->vote_start_at, $this->vote_end_at));
    }

    private function getDuration($start_date, $end_date){
        $durationInSeconds = strtotime($end_date) - strtotime($start_date);
        $durationInDays = $durationInSeconds/(24 * 60 * 60);
        return $durationInDays;
    }
}
