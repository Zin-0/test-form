<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
        $form = $request->only(['last-name', 'first-name', 'gender', 'email', 'postcode', 'address', 'building_name', 'opinion']);
        return view('confirm', compact('form'));
    }
    public function store(Request $request)
    {
        if ($request->get('action') === 'back') {
            return redirect('/')->withInput();
        }
        $contact = $request->only(['fullname', 'gender', 'email', 'postcode', 'address', 'building_name', 'opinion']);
        Contact::create($contact);
        return view('thanks');
    }
    public function management()
    {
        $contacts = Contact::paginate(10);
        return view('management', ['forms' => $contacts]);
    }
    public function search(Request $request)
    {
        $request->only(['fullname', 'gender', 'email', 'postcode', 'address', 'building_name', 'opinion']);
        if ($request->gender == '0') {
            if ($request->date_from == null && $request->date_to !== null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '<=', "{$request->date_to}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } elseif ($request->date_from !== null && $request->date_to == null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '>=', "{$request->date_from}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } elseif ($request->date_from == null && $request->date_to == null) {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            } else {
                $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
                ->whereDate('created_at', '<=', "{$request->date_to}")
                ->whereDate('created_at', '>=', "{$request->date_from}")
                ->where('email', 'LIKE', "%{$request->email}%")
                ->paginate(10);
                return view('management', ['forms' => $result]);
            }
        }
        if ($request->date_from == null && $request->date_to !== null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '<=', "{$request->date_to}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } elseif ($request->date_from !== null && $request->date_to == null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '>=', "{$request->date_from}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } elseif ($request->date_from == null && $request->date_to == null) {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        } else {
            $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', $request->gender)
            ->whereDate('created_at', '<=', "{$request->date_to}")            ->whereDate('created_at', '>=', "{$request->date_from}")
            ->where('email', 'LIKE', "%{$request->email}%")
            ->paginate(10);
            return view('management', ['forms' => $result]);
        }
    }
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        if ($request->currentPage == 1) {
            return redirect($request->firstPage);
        } else {
            return back();
        }
    }
}
