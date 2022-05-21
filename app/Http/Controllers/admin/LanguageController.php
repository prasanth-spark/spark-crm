<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\LanguageSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
    /**
     * Language list Pagination.
     */     

    public function languageListPagination(Request $request)
    {
        $languagesList = LanguageSkill::query();
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;


        if ($request->sSearch != '') {
            $keyword = $request->sSearch;
            $languagesList->where('language', 'like', '%' . $keyword . '%');
        }       

        $total_data = $languagesList->count();
        $languagesList = $languagesList->when(($limit != '-1' && isset($offset)),
            function ($q) use ($limit, $offset) {
                return $q->offset($offset)->limit($limit);
            }
        );

        $languagesLists = $languagesList->get();

        $column = array();
        $languagesListsData = [];
        foreach ($languagesLists as $languagesList) {


            $col['id'] = $offset + 1;
            $col['language'] = $languagesList->language;
            $col['action'] = '<div class="flex justify-center items-center">
                            
                             <a class="flex items-center mr-3" href="' . url('/') . '/admin/language-edit/' . $languagesList->id . '">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4 mr-1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit
                            </a>
                            <a class="flex items-center text-theme-21" data-toggle="modal" data-target="#delete-confirmation-modal-' . $languagesList->id . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete
                            </a>
                            </div>
                            <div id="delete-confirmation-modal-' . $languagesList->id . '" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="' . route('language-delete') . '" method="post">
                                <input type="hidden" name="_token" id="csrf-token" value="' . Session::token() . '"/>
                                <input type="hidden" name="id" value="' . $languagesList->id . '">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <em data-feather="x-circle" class="w-16 h-16 text-theme-21 mx-auto mt-3"></em>
                                                <div class="text-3xl mt-5">Are you sure?</div>
                                                <div class="text-gray-600 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                                <button type="submit" class="btn btn-danger w-24">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>';



            array_push($column, $col);
            $offset++;
        }
        
        $languagesListsData['sEcho'] = $request->sEcho;
        $languagesListsData['aaData'] = $column;
        $languagesListsData['iTotalRecords'] = $total_data;
        $languagesListsData['iTotalDisplayRecords'] = $total_data;


        return json_encode($languagesListsData);

    }
}
