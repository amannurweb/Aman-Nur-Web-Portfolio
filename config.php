<?php
/**
 * Site configuration & content.
 *
 * Everything shown on the site lives here — edit this one file to update
 * text, services, projects, testimonials and contact details.
 */

return [

    /* ------------------------------------------------------------------
     | Site settings
     * ------------------------------------------------------------------ */
    'site' => [
        'name'        => 'Md Aman Ullah',
        'brand'       => 'Aman',            // logo text, rendered as "Aman.dev"
        'role'        => 'PHP Developer & Digital Marketer',
        'title'       => 'Md Aman Ullah — PHP Developer & Digital Marketer | Saudi Arabia',
        'description' => 'Full Stack PHP Developer & Digital Marketer based in Dammam, Saudi Arabia. 350+ websites, 160+ online stores and 50+ custom apps delivered worldwide.',
        // Public URL of the site without trailing slash (used for canonical links, sitemap, OG tags).
        'url'         => 'https://amannurweb.com',
        'locale'      => 'en_US',
        'timezone'    => 'Asia/Riyadh',
        // Set to false if your host has no URL rewriting (links become index.php?p=...).
        'pretty_urls' => true,
        'available'   => true,              // shows the "Available for new projects" badge
    ],

    'contact' => [
        'email'      => 'mdamanullah.ksa@gmail.com',
        'phone'      => '+966 555 963 438',
        'whatsapp'   => '966555963438',     // digits only, used for wa.me links
        'location'   => 'Dammam, Saudi Arabia',
        'company'    => 'SRACO Company',
        'response'   => 'I reply within 24 hours.',
    ],

    'social' => [
        'LinkedIn' => 'https://linkedin.com/in/amannurweb',
        'Fiverr'   => 'https://www.fiverr.com/amanun',
        'Blog'     => 'https://amannurweb.blogspot.com',
        'GitHub'   => 'https://github.com/amannurweb',
    ],

    /* ------------------------------------------------------------------
     | Contact form & admin inbox
     * ------------------------------------------------------------------ */
    'mail' => [
        // Messages are ALWAYS saved to storage/messages/ and viewable at /admin.
        // Set 'send' to true to also email each message using PHP's mail().
        'send' => false,
        'to'   => 'mdamanullah.ksa@gmail.com',
        'from' => 'no-reply@amannurweb.com', // should be an address on your own domain
    ],

    // Password hash for the /admin inbox. Generate one with:
    //   php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"
    // Leave empty to disable the admin area.
    'admin_password_hash' => '',

    /* ------------------------------------------------------------------
     | Content
     * ------------------------------------------------------------------ */
    'stats' => [
        ['value' => 350, 'suffix' => '+', 'label' => 'Websites delivered'],
        ['value' => 160, 'suffix' => '+', 'label' => 'Online stores built'],
        ['value' => 50,  'suffix' => '+', 'label' => 'Custom PHP apps'],
        ['value' => 6,   'suffix' => '+', 'label' => 'Years of experience'],
    ],

    'hero_tags' => ['PHP', 'WordPress', 'Shopify', 'MySQL', 'SEO', 'JavaScript'],

    'profile_meta' => [
        ['icon' => 'pin',   'label' => 'Location',     'value' => 'Dammam, Saudi Arabia 🇸🇦'],
        ['icon' => 'phone', 'label' => 'WhatsApp',     'value' => '+966 555 963 438'],
        ['icon' => 'brief', 'label' => 'Currently at', 'value' => 'SRACO Company'],
        ['icon' => 'star',  'label' => 'Fiverr',       'value' => 'Level 2 Seller'],
    ],

    'services' => [
        [
            'icon'  => 'globe',
            'title' => 'WordPress Development',
            'short' => 'Custom WordPress websites that are fast, secure, and built to convert visitors into clients.',
            'long'  => 'Custom WordPress websites built for speed, security, and conversions. Includes theme customization, plugin integration, WooCommerce, and full mobile responsiveness.',
            'tags'  => ['WordPress', 'WooCommerce', 'Elementor', 'PHP'],
            'price' => 'From $200',
            'time'  => '5–10 days',
        ],
        [
            'icon'  => 'cart',
            'title' => 'Shopify & WooCommerce',
            'short' => 'High-converting online stores with seamless checkout, mobile design, and payment integration.',
            'long'  => 'Complete Shopify stores with custom themes, product setup, payment gateways, and conversion-optimized design. Dropshipping, B2B and B2C all supported.',
            'tags'  => ['Shopify', 'Liquid', 'Dropshipping', 'B2B'],
            'price' => 'From $300',
            'time'  => '7–14 days',
        ],
        [
            'icon'  => 'code',
            'title' => 'PHP Custom Software',
            'short' => 'Scalable web applications built with PHP & MySQL — tailored to your exact business logic.',
            'long'  => 'Tailor-made web applications using PHP, MySQL and JavaScript. CRM systems, booking platforms, management dashboards and more — built exactly how you need it.',
            'tags'  => ['PHP', 'MySQL', 'JavaScript', 'REST API'],
            'price' => 'From $500',
            'time'  => 'Project-based',
        ],
        [
            'icon'  => 'chart',
            'title' => 'SEO & Google Ranking',
            'short' => 'Get your business on Google page 1 with technical, on-page and local SEO.',
            'long'  => 'Technical SEO, local SEO, keyword optimization and Google Business setup. I have ranked businesses in Saudi Arabia, UAE, USA and UK.',
            'tags'  => ['SEO', 'Local SEO', 'Google Business', 'Yoast'],
            'price' => 'From $150/mo',
            'time'  => 'Monthly',
        ],
        [
            'icon'  => 'megaphone',
            'title' => 'Digital Marketing & Ads',
            'short' => 'Google, Facebook and Instagram campaigns that bring real leads — not just clicks.',
            'long'  => 'Google Ads, Facebook Ads and Instagram campaigns. I set up, manage and optimize your ad budget to bring real leads — not just clicks.',
            'tags'  => ['Google Ads', 'Meta Ads', 'Analytics', 'Tracking'],
            'price' => 'From $200/mo',
            'time'  => 'Monthly',
        ],
        [
            'icon'  => 'wrench',
            'title' => 'Maintenance & Speed',
            'short' => 'Updates, backups, security and speed tuning so your site never breaks and always performs.',
            'long'  => 'Monthly maintenance packages — updates, backups, security hardening, speed optimization (sub-3-second loads) and content changes.',
            'tags'  => ['Maintenance', 'Security', 'Backups', 'Core Web Vitals'],
            'price' => 'From $50/mo',
            'time'  => 'Monthly',
        ],
    ],

    'skills' => [
        ['name' => 'PHP & WordPress',         'level' => 92],
        ['name' => 'Shopify Development',     'level' => 88],
        ['name' => 'Digital Marketing & SEO', 'level' => 85],
        ['name' => 'UI / Web Design',         'level' => 85],
        ['name' => 'JavaScript / Frontend',   'level' => 80],
        ['name' => 'Google Ads / Meta Ads',   'level' => 78],
    ],

    'tech' => ['PHP', 'MySQL', 'JavaScript', 'WordPress', 'Shopify', 'WooCommerce', 'Liquid', 'Elementor',
               'HTML / CSS', 'REST API', 'Git', 'Figma', 'Wix', 'SEO', 'Google Ads', 'Meta Ads', 'GA4'],

    'process' => [
        ['title' => 'Discovery call',   'text' => 'We discuss your goals, target audience, and what success looks like for your business.'],
        ['title' => 'Strategy & plan',  'text' => 'A clear plan — design, features, timeline and budget — all agreed upfront.'],
        ['title' => 'Build & deliver',  'text' => 'Fast development with regular updates. You see progress at every step, no surprises.'],
        ['title' => 'Launch & support', 'text' => 'Go live with confidence: full handover, training and after-launch support.'],
    ],

    // Categories used by the filter on the Work page.
    'project_categories' => [
        'wordpress' => 'WordPress',
        'shopify'   => 'Shopify',
        'php'       => 'Custom PHP',
        'seo'       => 'SEO & Marketing',
    ],

    'projects' => [
        [
            'slug'      => 'coastal-hot-sauce',
            'title'     => 'Coastal Hot Sauce',
            'country'   => 'USA',
            'year'      => '2025',
            'category'  => 'wordpress',
            'hue'       => 14,
            'url'       => 'https://www.coastalsauces.com',
            'featured'  => true,
            'summary'   => 'Custom wholesale WooCommerce store with state-based restrictions, a gift ordering system and a 4-step checkout.',
            'challenge' => 'The client sells hot sauce both retail and wholesale across the US, but shipping rules differ by state and gift orders needed their own flow. Off-the-shelf plugins could not handle both.',
            'solution'  => 'A WooCommerce build with custom PHP: state-based product restrictions at checkout, a dedicated gift ordering system and a streamlined 4-step checkout for wholesale buyers.',
            'results'   => ['Wholesale and retail in one store', 'State shipping rules enforced automatically', 'Clean, maintainable custom code'],
            'tags'      => ['WordPress', 'WooCommerce', 'Custom PHP'],
        ],
        [
            'slug'      => 'pureface',
            'title'     => 'PureFace.pk',
            'country'   => 'Pakistan',
            'year'      => '2024',
            'category'  => 'shopify',
            'hue'       => 330,
            'url'       => 'https://pureface.pk',
            'featured'  => true,
            'summary'   => '5,000+ product Shopify cosmetics store with a premium theme, custom apps and a seamless mobile shopping experience.',
            'challenge' => 'A large cosmetics catalogue with thousands of SKUs needed to stay fast and easy to browse — especially on mobile, where most customers shop.',
            'solution'  => 'Premium Shopify theme customized for the brand, structured collections and filters for 5,000+ products, and custom app integrations for a smooth mobile checkout.',
            'results'   => ['5,000+ products organised and searchable', 'Mobile-first shopping experience', 'Custom app integrations'],
            'tags'      => ['Shopify', 'Cosmetics', '5000+ SKUs'],
        ],
        [
            'slug'      => 'lh-firewood',
            'title'     => 'LH Landscape & Firewood',
            'country'   => 'Australia',
            'year'      => '2024',
            'category'  => 'wordpress',
            'hue'       => 32,
            'url'       => 'https://www.lhlandscapefirewood.com.au',
            'featured'  => true,
            'summary'   => 'Eco-friendly landscape & firewood WooCommerce store using the WoodMart theme with a full product catalogue.',
            'challenge' => 'A local supplier needed to move from phone orders to online sales with a catalogue that feels premium and trustworthy.',
            'solution'  => 'WooCommerce on the WoodMart theme, full product catalogue with delivery options, and a design that highlights the eco-friendly brand.',
            'results'   => ['Online ordering 24/7', 'Complete product catalogue', 'Premium brand presentation'],
            'tags'      => ['WooCommerce', 'WoodMart', 'Australia'],
        ],
        [
            'slug'      => 'riyadh-restaurant-seo',
            'title'     => 'Restaurant Local SEO',
            'country'   => 'Riyadh, KSA',
            'year'      => '2025',
            'category'  => 'seo',
            'hue'       => 150,
            'url'       => '',
            'featured'  => false,
            'summary'   => 'Google page 1 ranking in 6 weeks with a WordPress site, local SEO and Google Business optimization. Online orders increased 3×.',
            'challenge' => 'A Riyadh restaurant was invisible on Google Maps and search, losing orders to competitors with weaker food but better visibility.',
            'solution'  => 'A fast WordPress site, local keyword targeting, a fully optimized Google Business profile, and on-page SEO for every menu and location page.',
            'results'   => ['Google page 1 in 6 weeks', 'Online orders up 3×', 'Optimized Google Business profile'],
            'tags'      => ['WordPress', 'Local SEO', 'Saudi Arabia'],
        ],
        [
            'slug'      => 'dammam-corporate',
            'title'     => 'Corporate Website',
            'country'   => 'Dammam, KSA',
            'year'      => '2024',
            'category'  => 'php',
            'hue'       => 210,
            'url'       => '',
            'featured'  => false,
            'summary'   => 'Multi-page corporate website with a custom PHP backend, Arabic/English content and lead generation forms.',
            'challenge' => 'The company needed a bilingual web presence that its own team could update, plus a reliable way to capture and route business enquiries.',
            'solution'  => 'Custom PHP & MySQL backend with an easy content editor, full Arabic (RTL) and English versions, and lead forms routed to the right department.',
            'results'   => ['Bilingual Arabic / English', 'Team-editable content', 'Structured lead capture'],
            'tags'      => ['PHP', 'MySQL', 'Arabic RTL', 'Corporate'],
        ],
        [
            'slug'      => 'prayer-pray',
            'title'     => 'Prayer Pray',
            'country'   => 'Global',
            'year'      => '2023',
            'category'  => 'wordpress',
            'hue'       => 265,
            'url'       => '',
            'featured'  => false,
            'summary'   => 'WordPress music & meditation website with YouTube live streaming integration and a mobile-first design.',
            'challenge' => 'A music and meditation platform wanted to stream live sessions to a worldwide audience without a complex video infrastructure.',
            'solution'  => 'WordPress build with YouTube live streaming integration, a calm mobile-first design, and simple content management for new sessions.',
            'results'   => ['Live streaming via YouTube API', 'Mobile-first design', 'Global audience reach'],
            'tags'      => ['WordPress', 'YouTube API', 'Mobile'],
        ],
    ],

    'testimonials' => [
        [
            'quote' => 'Aman built our WooCommerce store from scratch. Fast delivery, clean code, and the site loads in under 2 seconds. Our sales increased 3× in the first month!',
            'name'  => 'James Morrison',
            'role'  => 'E-commerce owner, USA',
        ],
        [
            'quote' => 'Our restaurant hit Google page 1 in Riyadh within 6 weeks. Aman knows SEO better than anyone I have worked with. Highly recommend!',
            'name'  => 'Ahmed Al-Khalid',
            'role'  => 'Restaurant owner, Saudi Arabia',
        ],
        [
            'quote' => 'The Shopify store Aman built for us is stunning. Custom features, mobile-perfect, and support even after launch. Best investment we made.',
            'name'  => 'Sarah Rahman',
            'role'  => 'Fashion brand, UK',
        ],
    ],

    'highlights' => [
        ['title' => 'Fast delivery',     'text' => 'Most projects delivered ahead of schedule without compromising quality.'],
        ['title' => 'Result-focused',    'text' => 'I build websites that bring leads, not just look good.'],
        ['title' => 'Ongoing support',   'text' => 'After-project support is always included. You are never alone.'],
        ['title' => 'Global experience', 'text' => 'Clients from 10+ countries across 3 continents.'],
    ],

    'experience' => [
        [
            'date'    => '2023 – Present',
            'title'   => 'Marketing Coordinator',
            'company' => 'SRACO Company · Dammam, Saudi Arabia',
            'text'    => 'Managing company websites, digital campaigns, social media strategy and client digital relations.',
        ],
        [
            'date'    => '2020 – Present',
            'title'   => 'Freelance PHP Developer & Digital Marketer',
            'company' => 'Fiverr Level 2 Seller · Worldwide',
            'text'    => '350+ websites, 160+ stores and 50+ custom apps delivered for clients in the USA, UK, Australia, Saudi Arabia, Pakistan and more.',
        ],
        [
            'date'    => '2018 – 2020',
            'title'   => 'Web Designer',
            'company' => 'ThemeForest & TemplateMonster',
            'text'    => 'Started a professional web design career building premium WordPress themes and templates for global marketplaces.',
        ],
    ],

    'blog' => [
        [
            'title'    => '5 Things That Get Any Business to Google Page 1',
            'excerpt'  => 'No ads. No big budget. I ranked a Riyadh shop on page 1 in 6 weeks using these exact steps.',
            'category' => 'SEO',
            'date'     => '2026-03-01',
            'url'      => 'https://amannurweb.blogspot.com',
        ],
        [
            'title'    => 'WordPress vs Shopify: Which One Should You Choose?',
            'excerpt'  => 'I have built 160+ online stores on both platforms. Here is the honest comparison based on real experience.',
            'category' => 'E-commerce',
            'date'     => '2026-02-01',
            'url'      => 'https://amannurweb.blogspot.com',
        ],
        [
            'title'    => 'How I Earn Online as a Successful Freelancer',
            'excerpt'  => 'The exact rules I followed from zero to Fiverr Level 2 Seller — and what most people get wrong.',
            'category' => 'Freelancing',
            'date'     => '2026-01-01',
            'url'      => 'https://amannurweb.blogspot.com',
        ],
    ],

    'faq' => [
        ['q' => 'How long does a typical website take?',
         'a' => 'Most WordPress sites are delivered in 5–10 days and Shopify stores in 7–14 days. Custom PHP software is scheduled per project once the scope is agreed.'],
        ['q' => 'Do you work with clients outside Saudi Arabia?',
         'a' => 'Yes. I have delivered projects for clients in the USA, UK, Australia, Pakistan, the UAE and more. Everything runs smoothly online via WhatsApp, email and video calls.'],
        ['q' => 'Can you build bilingual Arabic / English websites?',
         'a' => 'Yes — including proper right-to-left (RTL) layouts for Arabic content.'],
        ['q' => 'What happens after my website launches?',
         'a' => 'You get a full handover and training, plus after-launch support. Optional monthly maintenance packages cover updates, backups, security and speed.'],
        ['q' => 'How do payments work?',
         'a' => 'Scope, price and timeline are agreed upfront. Projects can be paid in milestones, or through Fiverr if you prefer platform protection.'],
    ],

    'budgets'  => ['Under $200', '$200 – $500', '$500 – $1,000', '$1,000 – $3,000', '$3,000+'],
];
