<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function generateAdContent(UploadedFile $image)
    {
        if (!$this->apiKey) {
            throw new \Exception('Gemini API Key is not configured.');
        }

        // Convert image to base64
        $imageData = base64_encode(file_get_contents($image->getRealPath()));
        $mimeType = $image->getMimeType();

        // Construct the prompt
        $prompt = "You are a professional marketing copywriter for a premium skincare brand called 'Maxie Skincare'. 
        Analyze the uploaded product image and generate the following in a JSON format:
        1. 'headline': A catchy, innovative ad headline (max 10 words).
        2. 'description': A persuasive, benefit-driven product description (approx 50-70 words).
        3. 'hashtags': 5 trending hashtags for Instagram/TikTok.
        
        Ensure the tone is elegant, confident, and trustworthy. Language: Indonesian (or English if the product name suggests otherwise, but default to Indonesian market).";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            [
                                'inline_data' => [
                                    'mime_type' => $mimeType,
                                    'data' => $imageData
                                ]
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json'
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                throw new \Exception('Failed to communicate with AI service.');
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }
}
