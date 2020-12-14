<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Deposit;
use App\Models\Balance;
use App\Models\Transfer;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $transfer = db::table('transfer')
            ->where('user_id', Auth()->id())
            ->select('receiver', 'account', 'value', 'created_at')
            ->get();


        $deposit = db::table('deposit')
            ->where('user_id', Auth()->id())
            ->select('value', 'created_at')
            ->get();

        $bal = db::table('balance')
            ->where('user_id', Auth()->id())
            ->select(DB::raw("SUM(value) as value"))
            ->first();

        return view('home', compact('transfer','deposit', 'bal'));
    }

    public function deposit()
    {
        return view('deposit');
    }

    public function depositsave(Request $request)
    {
        $this->validate($request, [
            'value' => 'required|min:0',
        ]);

        $post = new Deposit();
        $post->id = $request->id;
        $post->value = $request->value;
        $post->user_id = Auth()->id();
        $post->created_at = carbon::now();
        $post->updated_at = carbon::now();

        $balan = new Balance();
        $balan->value = $request->value;
        $balan->user_id = Auth()->id();
        $balan->created_at = carbon::now();
        $balan->updated_at = carbon::now();

        DB::beginTransaction();

            $post->save();

            $bals = db::table('balance')
                ->where('user_id', Auth()->id())
                ->sum('value');

            if (empty( $bals ) ) {
                $balan->save();
            }

            $bal = db::table('deposit')
                ->where('user_id', Auth()->id())
                ->sum('value');

            DB::table('balance')->where('user_id',Auth()->id())->update(['value'=> $bal]);

            DB::commit();
            return redirect()->back()->with('success','Data has been added');
        }



    public function transfer()
    {
        $balance = db::table('balance')
            ->where('user_id', Auth()->id())
            ->select(DB::raw("SUM(value) as value"))
            ->first();


        return view('transfer', compact('balance'));

    }

    public function transfersave(Request $request)
    {
        $balance = db::table('balance')
            ->where('user_id', Auth()->id())
            ->sum('value');


        $this->validate($request, [
            'value' => "required|min:0|max:$balance",
            'account' => "required",
            'receiver' => "required",
        ]);


        $post = new transfer();
        $post->value = $request->value;
        $post->user_id = Auth()->id();
        $post->account = $request->account;
        $post->receiver = $request->receiver;
        $post->created_at = carbon::now();
        $post->updated_at = carbon::now();

        DB::beginTransaction();



            $post->save();
            $bal = $balance-$post->value;

            DB::table('balance')->where('user_id',Auth()->id())->update(['value'=> $bal]);

            DB::commit();
            return redirect()->back()->with('success','Data has been added');
        }


}
