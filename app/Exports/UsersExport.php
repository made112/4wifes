<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('export-users', [
            'users' => User::where('name','!=','admin')->select('name', 'email', 'house_count')->get(),
        ]);
    }
}
