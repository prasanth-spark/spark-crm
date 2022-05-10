<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\LanguageSkill;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    
    /**
     * Language List .
     */
    public function languageList()
    {
        $languages = LanguageSkill::all();
        return view('admin/language/language-list',compact('languages'));
    }

    /**
     * Language Form.
     */
    public function addLanguageForm()
    {
        return view('admin/language/language-add');
    }

    /**
     * Add Language.
     */
    public function addLanguageProcess(Request $request)
    {
        $language = new LanguageSkill();
        $language->language = $request->language;
        $language->save();
        return redirect()->route('language-list')->with('success', 'Language Added Successfully');
    }
    /**
     * Edit Language.
     */
     public function editLanguage($id)
     {
        $language = LanguageSkill::find($id);
        return view('admin/language/edit-language',compact('language'));
     }

    /**
     * Update Language.
     */
      public function updateLanguage(Request $request)
      {
        $language = LanguageSkill::find($request->id);
        $language->language = $request->language;   
        $language->save();
        return redirect()->route('language-list')->with('success', 'Language Updated Successfully');
      }

    /**
     * Delete Language.
     */
        public function deleteLanguage(Request $request)
        {
            $language = LanguageSkill::find($request->id);
            $language->delete();
            return redirect()->route('language-list')->with('success', 'Language Deleted Successfully');
        }
}
