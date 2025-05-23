<?php

namespace App\View\Components\Compuest;

use App\Models\User;
use Illuminate\View\Component;

class UsersTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $users = User::with('personalData')->paginate(10);
        return view('components.compuest.users-table', compact('users'));
    }
}
