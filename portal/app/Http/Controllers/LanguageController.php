<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageUpdateRequest;
use App\UsernameLanguage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * @param LanguageUpdateRequest $request
     * @return $this
     */
    public function update(LanguageUpdateRequest $request)
    {
        $language = $request->input('language');
        if (get_user())
        {
            $usernameLanguage = UsernameLanguage::firstOrNew([
                'username' => get_user()->username
            ]);
            $usernameLanguage->language = $language;
            $usernameLanguage->save();
        }

        $now = Carbon::now("UTC");
        $oneYearOut = clone $now;
        $oneYearOut->addYear();

        return response()->json([
            'success' => true,
        ])->cookie('language',$language, $now->diffInSeconds($oneYearOut));
    }
}
