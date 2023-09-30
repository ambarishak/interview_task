<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\SuccessfulFormCreation;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();

        return view('admin.forms.index', compact('forms'));
    }
    public function list()
    {
        $forms = Form::all();

        return view('index', compact('forms'));
    }
    public function view($id)
    {

        $forms = Form::find($id);

        return view('forms', compact('forms'));
    }
    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        $form = Form::create($validatedData);


        $customElementsData = json_decode($request->input('custom_elements_data'), true);

        if (!empty($customElementsData)) {
            $formControls = [];
            foreach ($customElementsData as $elementData) {
                $formControls[] = [
                    'form_id' => $form->id,
                    'label' => $elementData['label'],
                    'type' => $elementData['type'],
                    'value' => $elementData['value'],
                ];
            }
            DB::table('formcontrols')->insert($formControls);
        }

        return redirect()->route('admin.forms.edit', $form->id)->with('success', 'Form created successfully.');
    }
    public function edit($id)
    {
        $form = Form::find($id);
        return view('admin.forms.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $form = Form::find($id);
        if (!$form) {
            return redirect()->route('admin.forms')->with('error', 'Form not found.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'custom_elements.*.label' => 'required|string|max:255',
            'custom_elements.*.type' => 'required|string|in:text,textarea,select,radio,checkbox',
            'custom_elements.*.options' => 'nullable|string',
        ]);


        $form->formControls()->delete();

        $form->update($validatedData);

        if ($request->has('custom_elements')) {
            $customElements = $request->input('custom_elements');

            if (!empty($customElements)) {
                foreach ($customElements as $elementData) {

                    FormControl::create([
                        'form_id' => $form->id,
                        'label' => $elementData['label'],
                        'name' => strtolower(str_replace(' ', '-', $elementData['label'])),
                        'type' => $elementData['type'],
                        'options' => $elementData['options'],
                    ]);
                }
            }
        }
        $formData = [
            'title' => $form->title,

        ];


        // Notification::route('mail', 'admin@example.com')
        //     ->notify(new SuccessfulFormCreation($formData));
        return redirect()->route('admin.forms')->with('success', 'Form updated successfully.');
    }






    public function destroy($id)
    {

        $form = Form::find($id);

        if (!$form) {
            return redirect()->route('admin.forms')->with('error', 'Form not found.');
        }
        $form->delete();

        return redirect()->route('admin.forms')->with('success', 'Form deleted successfully.');
    }
}
