<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // Max 5MB
        ]);

        try {
            $response = $this->geminiService->generateAdContent($request->file('image'));
            
            // Extract the text content from Gemini's response structure
            if (isset($response['candidates'][0]['content']['parts'][0]['text'])) {
                $rawText = $response['candidates'][0]['content']['parts'][0]['text'];
                
                // Clean markdown code blocks if present
                $cleanJson = str_replace(['```json', '```'], '', $rawText);
                $data = json_decode($cleanJson, true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Failed to parse AI response: ' . $rawText);
                }
                
                return response()->json([
                    'success' => true,
                    'data' => $data
                ]);
            }

            throw new \Exception('Invalid response structure from AI.');

        } catch (\Exception $e) {
            Log::error('AI Generation Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
