<?php

namespace App\Http\Controllers\Teams;

use App\{Team, User};
use App\Teams\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamUserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['in_team:' . $request->team]);

        $this->middleware(['permission:add users,' . $request->team])
             ->only('store');
    }

    public function index(Team $team)
    {
        return view('teams.users.index', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email'
        ]);

        $team->users()->syncWithoutDetaching(
            $user = User::where('email', $request->email)->first()
        );

        $user->attachRole(Roles::$roleWhenJoiningTeam, $team->id);

        return back();
    }

    public function delete(Team $team, User $user)
    {
        return view('teams.users.delete', compact('team', 'user'));
    }

    public function destroy(Team $team, User $user)
    {
        if (!$team->users->contains($user)) {
            return back();
        }

        $team->users()->detach($user);

        $user->detachRoles([], $team->id);

        return redirect()->route('teams.users.index', $team);
    }
}
