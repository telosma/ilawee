<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Signer;

class SignerController extends Controller
{
    public function ajaxListFullInfo()
    {
        $signers = Signer::with('organization')->get();
        foreach ($signers as $signer) {
            $signer['info'] = $signer->name . ' - ' . $signer->jobTitle . ' - ' . $signer->organization->name;
        }
        return $signers;
    }
}
