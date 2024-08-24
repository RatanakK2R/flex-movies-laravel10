<?php
// app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profile_image' => 'nullable|image|max:2048', // Optional image upload
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profile_image' => 'nullable|image|max:2048', // Optional image upload
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($member->profile_image) {
                Storage::delete($member->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profile_images');
        }

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        if ($member->profile_image) {
            Storage::delete($member->profile_image);
        }
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
