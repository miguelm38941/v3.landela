<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Helpers\General\CollectionHelper;
use \App\ExamensPrescrit;
use Auth;

class ExamensPrescrits extends Controller
{
    public function index()
    {
        $examens = ExamensPrescrit::All()->paginate(10);
        dd($examens);
    }

    public function examsByUser(int $userid, $filter)
    {
        if ($filter=='MEDECIN'):
            $examens = ExamensPrescrit::where('medecin_id', $myId)->paginate(10);
        elseif ($filter=='PVV'):
            $examens = ExamensPrescrit::where('pvv_id', $myId)->paginate(10);
        elseif ($filter=='LABORANTIN'):
            $examens = ExamensPrescrit::where('laborantin_id', $myId)->paginate(10);
        endif;
        dd($examens);
    }

    public function myExams(int $myid)
    {
        if (Auth::user()->isMedecin()):
            $examens = ExamensPrescrit::where('medecin_id', $myid)->get();
        elseif (Auth::user()->isPvv()):
            $examens = ExamensPrescrit::where('pvv_id', $myid)->get();
        elseif (Auth::user()->isLaborantin()):
            $examens = ExamensPrescrit::where('laborantin_id', $myid)->get();
        endif;
        $total = $examens->count();
        $pageSize = 20;
        $examens = CollectionHelper::paginate($examens, $total, $pageSize);
        //dd($examens);
        return view('examens.index', compact('examens'));

    }
}
