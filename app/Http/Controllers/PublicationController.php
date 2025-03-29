<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicationRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

use App\Models\Publication;

class PublicationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $publications = Publication::with('users')->paginate(10);
        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(StorePublicationRequest $request)
    {
        $publication = Publication::create($request->validated());
        $publication->users()->attach(Auth::user()->id);
        return redirect()->route('publications.index')->with('success', 'Publication created successfully.');
    }

    public function edit(Publication $publication)
    {
        $this->authorize('update', $publication);
        return view('publications.edit', compact('publication'));
    }

    public function update(StorePublicationRequest $request, Publication $publication)
    {
        $this->authorize('update', $publication);
        $publication->update($request->validated());
        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    public function show(Publication $publication)
    {
        $this->authorize('view', $publication);
        return view('publications.show', compact('publication'));
    }

    public function destroy(Publication $publication)
    {
        $this->authorize('delete', $publication);
        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Publication deleted successfully.');
    }
}
