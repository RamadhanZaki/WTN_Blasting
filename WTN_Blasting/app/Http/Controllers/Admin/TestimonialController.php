<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(12);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:100',
            'content'       => 'required|string|max:1000',
            'image'         => 'nullable|image|max:5120',
            'rating'        => 'required|integer|min:1|max:5',
            'is_published'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }
        $data['is_published'] = $request->boolean('is_published');

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:100',
            'content'       => 'required|string|max:1000',
            'image'         => 'nullable|image|max:5120',
            'rating'        => 'required|integer|min:1|max:5',
            'is_published'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }
        $data['is_published'] = $request->boolean('is_published');

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimoni dihapus.');
    }
}
