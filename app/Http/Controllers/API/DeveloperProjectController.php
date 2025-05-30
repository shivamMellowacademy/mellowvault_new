<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeveloperProjectDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;


class DeveloperProjectController extends Controller
{
    public function index(Request $request)
    {
        $devId = $request->developerId;

        try {
            if (!$devId) {
                return response()->json(['status' => false, 'message' => 'Developer not logged in.'], 401);
            }

            $projects = DeveloperProjectDetail::where('developer_id', $devId)->get();

            // Append full image URL
            $projects->transform(function ($project) {
                $project->screenshot_image = $project->screenshot_image 
                    ? asset('public/upload/screenshot/' . $project->screenshot_image) 
                    : null;
                return $project;
            });

            return response()->json(['status' => true, 'data' => $projects]);
        } catch (\Exception $e) {
            Log::error('Project Index Error: ' . $e->getMessage());

            return response()->json(['status' => false, 'message' => 'Error fetching projects'], 500);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_link' => 'required|url',
            'screenshot_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $devId = $request->developer_id;
        $getscreenshotimage = null;

        if ($request->hasFile('screenshot_image')) {
            $file = $request->file('screenshot_image');
            $getscreenshotimage = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/screenshot'), $getscreenshotimage);
        }

        $project = DeveloperProjectDetail::create([
            'developer_id' => $devId,
            'project_link' => $request->project_link,
            'screenshot_image' => $getscreenshotimage
        ]);

        return response()->json(['status' => true, 'data' => $project, 'message' => 'Project created successfully']);
    }

    public function show($id)
    {
        $project = DeveloperProjectDetail::find($id);

        if (!$project) {
            return response()->json(['status' => false, 'message' => 'Project not found'], 404);
        }

        return response()->json(['status' => true, 'data' => $project]);
    }

    public function update(Request $request, $id)
    {
        $project = DeveloperProjectDetail::find($id);
        if (!$project) {
            return response()->json(['status' => false, 'message' => 'Project not found'], 404);
        }

        try {
            $getscreenshotimage = $project->screenshot_image;

            if ($request->hasFile('screenshot_image')) {
                // Optional: delete old image if exists
                if ($project->screenshot_image && file_exists(public_path('upload/screenshot/' . $project->screenshot_image))) {
                    unlink(public_path('upload/screenshot/' . $project->screenshot_image));
                }

                // Upload new image
                $file = $request->file('screenshot_image');
                $getscreenshotimage = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/screenshot'), $getscreenshotimage);
            }

            $project->update([
                'project_link' => $request->project_link,
                'screenshot_image' => $getscreenshotimage
            ]);

            return response()->json([
                'status' => true,
                'data' => $project,
                'message' => 'Project updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Project Update Error: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error updating project'], 500);
        }
    }


    public function destroy($id)
    {
        $project = DeveloperProjectDetail::find($id);

        if (!$project) {
            return response()->json(['status' => false, 'message' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['status' => true, 'message' => 'Project deleted successfully']);
    }

}

