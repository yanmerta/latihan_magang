<?php

namespace App\Http\Controllers;

use App\Imports\MultipleSheetsImport;
use App\Imports\UserImport;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\Return_;

class BelajarController extends Controller
{
    public function cache(Request $request){

        $data = Cache::remember('users',now()->addMinutes(5),function(){
            return User::get();
        });

        return view('belajar.cache',compact('data'));
    }

    public function import(Request $request){

        return view('import');
    }

    public function import_proses(Request $request){
        try {
            
            Excel::import(new MultipleSheetsImport(), $request->file('file'));
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function enkripsi(Request $request){

        $string = "Saya suka kamu";
        $enkripsi = Crypt::encryptString('Saya suka kamu');
        $deskripsi = Crypt::decryptString($enkripsi);

        echo "String: " . $string. "<br><br>";
        echo "Hasil Enkripsi: " . $enkripsi . "<br><br>";
        echo "Hasil Deskripsi : " . $deskripsi;

        $params = [
            'nama' => 'Nico Dwi Novianto',
            'hobby' => 'Mendengar Musik',
            'makanan_favorit' => 'Sate Padang',
        ];

        $params = Crypt::encrypt($params);

        echo "<a href=".route('enkripsi-detail',['params' => $params]).">Lihat detail Disini</a>";
    }

    public function enkripsi_detail(Request $request, $parms)
    {
        $params = Crypt::decrypt($params);

        dd($params);
    }
}