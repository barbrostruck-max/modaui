<?php

namespace Database\Seeders;

use App\Models\Extension;
use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extensions = [
            [
                'slug' => 'chatbot',
                'name' => 'Chatbot',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'focus-mode',
                'name' => 'Focus Mode',
                'category' => 'Productivity',
                'installed' => true,
            ],
            [
                'slug' => 'newsletter',
                'name' => 'Newsletter',
                'category' => 'Marketing',
                'installed' => true,
            ],
            [
                'slug' => 'photo-studio',
                'name' => 'Photo Studio',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-product-shot',
                'name' => 'AI Product Shot',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-avatar',
                'name' => 'AI Avatar',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-persona',
                'name' => 'AI Persona',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-music',
                'name' => 'AI Music',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-video-pro',
                'name' => 'AI Video Pro',
                'category' => 'Video Tools',
                'installed' => true,
            ],
            [
                'slug' => 'seo-tool',
                'name' => 'SEO Tool',
                'category' => 'Marketing',
                'installed' => true,
            ],
            [
                'slug' => 'ai-social-media',
                'name' => 'AI Social Media',
                'category' => 'Social Media',
                'installed' => true,
            ],
            [
                'slug' => 'webchat',
                'name' => 'Web Chat',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'onboarding',
                'name' => 'Onboarding',
                'category' => 'User Experience',
                'installed' => true,
            ],
            [
                'slug' => 'flux-pro',
                'name' => 'Flux Pro',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'chat-share',
                'name' => 'Chat Share',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'voice-isolator',
                'name' => 'Voice Isolator',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'chat-setting',
                'name' => 'Chat Setting',
                'category' => 'Settings',
                'installed' => true,
            ],
            [
                'slug' => 'hubspot',
                'name' => 'HubSpot',
                'category' => 'CRM',
                'installed' => true,
            ],
            [
                'slug' => 'menu',
                'name' => 'Menu',
                'category' => 'UI Components',
                'installed' => true,
            ],
            [
                'slug' => 'azure-tts',
                'name' => 'Azure TTS',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'plagiarism',
                'name' => 'Plagiarism',
                'category' => 'Writing Tools',
                'installed' => true,
            ],
            [
                'slug' => 'cloudflare-r2',
                'name' => 'Cloudflare R2',
                'category' => 'Storage',
                'installed' => true,
            ],
            [
                'slug' => 'wordpress',
                'name' => 'WordPress',
                'category' => 'Integration',
                'installed' => true,
            ],
            [
                'slug' => 'cryptomus',
                'name' => 'Cryptomus',
                'category' => 'Payment',
                'installed' => true,
            ],
            [
                'slug' => 'affilate',
                'name' => 'Affiliate',
                'category' => 'Marketing',
                'installed' => true,
            ],
            [
                'slug' => 'mailchimp-newsletter',
                'name' => 'Mailchimp Newsletter',
                'category' => 'Marketing',
                'installed' => true,
            ],
            [
                'slug' => 'ai-writer-templates',
                'name' => 'AI Writer Templates',
                'category' => 'Writing Tools',
                'installed' => true,
            ],
            [
                'slug' => 'maintenance',
                'name' => 'Maintenance',
                'category' => 'System',
                'installed' => true,
            ],
            [
                'slug' => 'open-router',
                'name' => 'Open Router',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'advanced-image',
                'name' => 'Advanced Image',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'mega-menu',
                'name' => 'Mega Menu',
                'category' => 'UI Components',
                'installed' => true,
            ],
            [
                'slug' => 'onboarding-pro',
                'name' => 'Onboarding Pro',
                'category' => 'User Experience',
                'installed' => true,
            ],
            [
                'slug' => 'ideogram',
                'name' => 'Ideogram',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'perplexity',
                'name' => 'Perplexity',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'checkout-registration',
                'name' => 'Checkout Registration',
                'category' => 'E-commerce',
                'installed' => true,
            ],
            [
                'slug' => 'openai-realtime-chat',
                'name' => 'OpenAI Realtime Chat',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-video-to-video',
                'name' => 'AI Video to Video',
                'category' => 'Video Tools',
                'installed' => true,
            ],
            [
                'slug' => 'midjourney',
                'name' => 'Midjourney',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'social-media',
                'name' => 'Social Media',
                'category' => 'Social Media',
                'installed' => true,
            ],
            [
                'slug' => 'social-media-agent',
                'name' => 'Social Media Agent',
                'category' => 'Social Media',
                'installed' => true,
            ],
            [
                'slug' => 'blogpilot',
                'name' => 'Blog Pilot',
                'category' => 'Writing Tools',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-agent',
                'name' => 'Chatbot Agent',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-booking',
                'name' => 'Chatbot Booking',
                'category' => 'Booking',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-ecommerce',
                'name' => 'Chatbot E-commerce',
                'category' => 'E-commerce',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-customer-tag',
                'name' => 'Chatbot Customer Tag',
                'category' => 'CRM',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-review',
                'name' => 'Chatbot Review',
                'category' => 'Feedback',
                'installed' => true,
            ],
            [
                'slug' => 'xero',
                'name' => 'Xero',
                'category' => 'Accounting',
                'installed' => true,
            ],
            [
                'slug' => 'speechify-tts',
                'name' => 'Speechify TTS',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro',
                'name' => 'AI Chat Pro',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'announcement',
                'name' => 'Announcement',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'ai-realtime-image',
                'name' => 'AI Realtime Image',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'azure-openai',
                'name' => 'Azure OpenAI',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-voice',
                'name' => 'Chatbot Voice',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-voice-call',
                'name' => 'Chatbot Voice Call',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-telegram',
                'name' => 'Chatbot Telegram',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-whatsapp',
                'name' => 'Chatbot WhatsApp',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-messenger',
                'name' => 'Chatbot Messenger',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'chatbot-instagram',
                'name' => 'Chatbot Instagram',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'marketing-bot',
                'name' => 'Marketing Bot',
                'category' => 'Marketing',
                'installed' => true,
            ],
            [
                'slug' => 'migration',
                'name' => 'Migration',
                'category' => 'System',
                'installed' => true,
            ],
            [
                'slug' => 'live-customizer',
                'name' => 'Live Customizer',
                'category' => 'UI Components',
                'installed' => true,
            ],
            [
                'slug' => 'elevenlabs-voice-chat',
                'name' => 'ElevenLabs Voice Chat',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'creative-suite',
                'name' => 'Creative Suite',
                'category' => 'Creative Tools',
                'installed' => true,
            ],
            [
                'slug' => 'url-to-video',
                'name' => 'URL to Video',
                'category' => 'Video Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-viral-clips',
                'name' => 'AI Viral Clips',
                'category' => 'Video Tools',
                'installed' => true,
            ],
            [
                'slug' => 'influencer-avatar',
                'name' => 'Influencer Avatar',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'content-manager',
                'name' => 'Content Manager',
                'category' => 'Content',
                'installed' => true,
            ],
            [
                'slug' => 'canvas',
                'name' => 'Canvas',
                'category' => 'Creative Tools',
                'installed' => true,
            ],
            [
                'slug' => 'discount-manager',
                'name' => 'Discount Manager',
                'category' => 'E-commerce',
                'installed' => true,
            ],
            [
                'slug' => 'footer-menu',
                'name' => 'Footer Menu',
                'category' => 'UI Components',
                'installed' => true,
            ],
            [
                'slug' => 'chat-pro-temp-chat',
                'name' => 'Chat Pro Temp Chat',
                'category' => 'Communication',
                'installed' => true,
            ],
            [
                'slug' => 'demo-extension',
                'name' => 'Demo Extension',
                'category' => 'Demo',
                'installed' => true,
            ],
            [
                'slug' => 'multi-model',
                'name' => 'Multi Model',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'model-council',
                'name' => 'Model Council',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-skills',
                'name' => 'AI Chat Pro Skills',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-deep-research',
                'name' => 'AI Chat Pro Deep Research',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'nano-banana',
                'name' => 'Nano Banana',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-file-chat',
                'name' => 'AI Chat Pro File Chat',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-music-pro',
                'name' => 'AI Music Pro',
                'category' => 'Audio Tools',
                'installed' => true,
            ],
            [
                'slug' => 'see-dream-v4',
                'name' => 'See Dream V4',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-presentation',
                'name' => 'AI Presentation',
                'category' => 'Presentation',
                'installed' => true,
            ],
            [
                'slug' => 'ai-image-pro',
                'name' => 'AI Image Pro',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-image-chat',
                'name' => 'AI Chat Pro Image Chat',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-folders',
                'name' => 'AI Chat Pro Folders',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-memory',
                'name' => 'AI Chat Pro Memory',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-smart-image',
                'name' => 'AI Chat Pro Smart Image',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'fashion-studio',
                'name' => 'Fashion Studio',
                'category' => 'Image Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-entity-highlight',
                'name' => 'AI Chat Pro Entity Highlight',
                'category' => 'AI Tools',
                'installed' => true,
            ],
            [
                'slug' => 'ai-chat-pro-highlight-to-ask',
                'name' => 'AI Chat Pro Highlight to Ask',
                'category' => 'AI Tools',
                'installed' => true,
            ],
        ];

        foreach ($extensions as $extension) {
            Extension::updateOrCreate(
                ['slug' => $extension['slug']],
                $extension
            );
        }
    }
}