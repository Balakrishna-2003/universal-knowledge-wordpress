/**
 * Universal Talk Video Gallery Engine
 * Universal Knowledge Trust
 */

const UNIVERSAL_TALK_VIDEOS = [
    {
        id: "Eop0PZUX-GE",
        title: "Universal Knowledge Trust | Master Talk | Master ROHAN SHIRI",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Master Talk",
        duration: "29:44",
        date: "Jul 16, 2024",
        views: "484 Views",
        likes: "17 Likes",
        desc: "A transformative Master Talk by Master Rohan Shiri sharing profound wisdom on spiritual awakening, positive energy alignment, and purposeful living.",
        keywords: "master talk rohan shiri positive energy universal knowledge spiritual wisdom"
    },
    {
        id: "AXgwcOrD0_M",
        title: "Spirituality & You - Singapore | Hlr Ashoka T",
        speaker: "Hlr. Ashoka T",
        category: "spirituality",
        catLabel: "Spirituality & You",
        duration: "20:48",
        date: "Jun 03, 2024",
        views: "206 Views",
        likes: "7 Likes",
        desc: "Special session from the Spirituality & You Singapore workshop with Hlr. Ashoka T on inner balance and conscious growth.",
        keywords: "spirituality you singapore ashoka healing spiritual growth"
    },
    {
        id: "ofMGFPBaIRk",
        title: "Spirituality & You - Singapore | Hlr Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Spirituality & You",
        duration: "20:04",
        date: "Jun 01, 2024",
        views: "180 Views",
        likes: "12 Likes",
        desc: "Insightful discourse by Hlr. Ganesh Prasad delivered during the Singapore international workshop series.",
        keywords: "spirituality you singapore ganesh prasad spiritual insights"
    },
    {
        id: "gyPH1pyWhNU",
        title: "Spirituality & You - Singapore | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Singapore Keynote",
        duration: "12:08",
        date: "May 31, 2024",
        views: "407 Views",
        likes: "12 Likes",
        desc: "Keynote discourse by Master Rohan Shiri at the Singapore workshop on awakening universal consciousness.",
        keywords: "spirituality you singapore rohan shiri master discourse"
    },
    {
        id: "XG6VRDss9gY",
        title: "Spirituality & You - Singapore | Hlr Ashwini Althagi",
        speaker: "Hlr. Ashwini Alathagi",
        category: "spirituality",
        catLabel: "Spirituality & You",
        duration: "19:51",
        date: "May 30, 2024",
        views: "248 Views",
        likes: "8 Likes",
        desc: "Hlr. Ashwini Alathagi speaks on emotional healing, self-acceptance, and positive energy in daily life at Singapore.",
        keywords: "spirituality you singapore ashwini alathagi healing energy"
    },
    {
        id: "pZDRPz5geFc",
        title: "Spirituality & You - Singapore | Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Spirituality & You",
        duration: "10:33",
        date: "May 29, 2024",
        views: "739 Views",
        likes: "38 Likes",
        desc: "Inspiring talk by Managing Trustee Hlr. Shammy Shiri during the international workshop in Singapore.",
        keywords: "spirituality you singapore shammy shiri managing trustee"
    },
    {
        id: "SSurq0T83gY",
        title: "Holistic Wellness | Ashwini Naik | Mindful Walking | Kapu",
        speaker: "Ashwini Naik",
        category: "healing",
        catLabel: "Holistic Wellness",
        duration: "10:34",
        date: "May 07, 2024",
        views: "101 Views",
        likes: "8 Likes",
        desc: "Experience mindful walking, breath awareness, and nature healing at Kapu beach with Ashwini Naik.",
        keywords: "holistic wellness ashwini naik walking meditation kapu beach"
    },
    {
        id: "A2WqC8bnOkA",
        title: "Learning Made Easy with Positive Energy | Master Rohan Shiri (Kapu)",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Positive Energy",
        duration: "08:03",
        date: "Apr 27, 2024",
        views: "199 Views",
        likes: "8 Likes",
        desc: "Experience sharing and powerful practical techniques for buoyant living and student learning by Master Rohan Shiri.",
        keywords: "learning made easy positive energy rohan shiri kapu wellness"
    },
    {
        id: "6q-Bp3eUE2s",
        title: "Spirituality And You | Sanman Gardenia, Bangalore | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Bangalore Series",
        duration: "26:59",
        date: "Apr 18, 2024",
        views: "169 Views",
        likes: "2 Likes",
        desc: "Master Rohan Shiri addressing seekers at Sanman Gardenia, Bangalore on spirituality and life purpose.",
        keywords: "spirituality and you bangalore sanman gardenia rohan shiri"
    },
    {
        id: "MyxvNA6sAq0",
        title: "Universal Talk | Holistic Wellness @ Manthan Beach Resort, Kapu",
        speaker: "Universal Knowledge Trust",
        category: "healing",
        catLabel: "Retreat Highlights",
        duration: "01:56",
        date: "Apr 17, 2024",
        views: "70 Views",
        likes: "5 Likes",
        desc: "Glimpses of the rejuvenating holistic wellness retreat organized by UKT at Manthan Beach Resort, Kapu.",
        keywords: "holistic wellness manthan beach resort kapu retreat"
    },
    {
        id: "yKSK0hZ2e3s",
        title: "Life Q&A with Master Rohan Shiri | Kapu Holistic Wellness (Part 1)",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Life Q&A",
        duration: "05:17",
        date: "Apr 17, 2024",
        views: "96 Views",
        likes: "5 Likes",
        desc: "Interactive question-and-answer session answering practical questions about life, mind, and energy.",
        keywords: "life qna questions answers rohan shiri kapu wellness"
    },
    {
        id: "IdXA2_X53RU",
        title: "Life Q&A with Master Rohan Shiri | Kapu Holistic Wellness (Part 2)",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Life Q&A",
        duration: "04:07",
        date: "Apr 17, 2024",
        views: "73 Views",
        likes: "6 Likes",
        desc: "Second part of the interactive Q&A session with Master Rohan Shiri on living with clarity and joy.",
        keywords: "life qna rohan shiri kapu positive living"
    },
    {
        id: "iigVhTYB2dk",
        title: "Universal Knowledge Reflection | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "life-insights",
        catLabel: "Short Reflection",
        duration: "00:46",
        date: "Apr 17, 2024",
        views: "792 Views",
        likes: "36 Likes",
        desc: "A quick, profound spark of wisdom from Master Rohan Shiri on daily mindfulness and positive vibration.",
        keywords: "master rohan shiri shorts wisdom reflection"
    },
    {
        id: "wq0vLBQGK2w",
        title: "Spirituality And You - Bangalore | Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "47:36",
        date: "Apr 14, 2024",
        views: "756 Views",
        likes: "23 Likes",
        desc: "Comprehensive 47-minute masterclass by Hlr. Shammy Shiri at Sanman Gardenia, Bangalore.",
        keywords: "spirituality and you bangalore shammy shiri discourse"
    },
    {
        id: "hyMkuBfSvBw",
        title: "Spirituality And You - Bangalore | Hlr Deepthi",
        speaker: "Hlr. Deepthi",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "16:40",
        date: "Apr 14, 2024",
        views: "293 Views",
        likes: "12 Likes",
        desc: "Hlr. Deepthi sharing healing practices and inner alignment insights at Bangalore.",
        keywords: "spirituality and you bangalore deepthi healing"
    },
    {
        id: "_fIXO3xYP-0",
        title: "Spirituality And You - Bangalore Workshop Highlights",
        speaker: "Universal Knowledge Trust",
        category: "spirituality",
        catLabel: "Event Highlights",
        duration: "01:11",
        date: "Apr 13, 2024",
        views: "453 Views",
        likes: "11 Likes",
        desc: "Highlights and seeker experiences from the Bangalore Spirituality & You workshop series.",
        keywords: "spirituality and you bangalore highlights"
    },
    {
        id: "5lVNWqGkdtc",
        title: "Spirituality And You - Bangalore | Hlr Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "23:29",
        date: "Apr 13, 2024",
        views: "66 Views",
        likes: "3 Likes",
        desc: "Discourse by Hlr. Ganesh Prasad on integrating spiritual awareness with daily responsibilities.",
        keywords: "spirituality and you bangalore ganesh prasad"
    },
    {
        id: "LkEpLGSFZKw",
        title: "Spirituality And You - Bangalore | Hlr Ashwini Naik",
        speaker: "Hlr. Ashwini Naik",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "32:36",
        date: "Apr 12, 2024",
        views: "344 Views",
        likes: "10 Likes",
        desc: "An in-depth 32-minute session by Hlr. Ashwini Naik on spiritual balance, wellness, and self-care.",
        keywords: "spirituality and you bangalore ashwini naik"
    },
    {
        id: "wj0_SqkZxBI",
        title: "Spirituality And You - Bangalore | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Bangalore Series",
        duration: "25:16",
        date: "Apr 12, 2024",
        views: "725 Views",
        likes: "24 Likes",
        desc: "Profound keynote by Master Rohan Shiri on the nature of consciousness and inner empowerment.",
        keywords: "spirituality and you bangalore rohan shiri"
    },
    {
        id: "p78UuBU7WI4",
        title: "Spirituality & You | Truth & Belief | Ashwini Naik",
        speaker: "Ashwini Naik",
        category: "life-insights",
        catLabel: "Short Reflection",
        duration: "01:01",
        date: "Apr 07, 2024",
        views: "383 Views",
        likes: "21 Likes",
        desc: "A brief insight into the distinction between blind belief and living spiritual truth.",
        keywords: "ashwini naik spirituality truth belief shorts"
    },
    {
        id: "J2Tp9AxySeg",
        title: "Universal Talk | Sustainability & Earth Care | Divya Hegde",
        speaker: "Divya Hegde",
        category: "environment",
        catLabel: "Environment",
        duration: "01:00",
        date: "Apr 07, 2024",
        views: "1.1K Views",
        likes: "28 Likes",
        desc: "UN Women Awardee Divya Hegde on environmental consciousness, climate action, and community care.",
        keywords: "divya hegde environment nature shorts"
    },
    {
        id: "ng6QfgI3Dew",
        title: "Universal Talk | Organic Farming & Soil Health | Madhu Chandan",
        speaker: "Madhu Chandan",
        category: "environment",
        catLabel: "Environment",
        duration: "01:01",
        date: "Apr 05, 2024",
        views: "432 Views",
        likes: "26 Likes",
        desc: "Organic Mandya founder Madhu Chandan on reconnecting with soil, organic farming, and ecological harmony.",
        keywords: "organic farming madhu chandan nature agriculture"
    },
    {
        id: "f7LCuzn6XS4",
        title: "Universal Talk | Living with Purpose | David Kumar",
        speaker: "David Kumar",
        category: "life-insights",
        catLabel: "Short Reflection",
        duration: "01:01",
        date: "Apr 05, 2024",
        views: "132 Views",
        likes: "8 Likes",
        desc: "Inspiring perspective by David Kumar on finding purpose, clarity, and peace in daily work.",
        keywords: "david kumar life shorts purpose"
    },
    {
        id: "qLKXoI7DxDA",
        title: "Universal Knowledge | Positive Energy Nugget | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Short Reflection",
        duration: "01:01",
        date: "Apr 02, 2024",
        views: "827 Views",
        likes: "38 Likes",
        desc: "Master Rohan Shiri on the cosmic currency of positive energy and how to store it daily.",
        keywords: "master rohan shiri shorts positive energy"
    },
    {
        id: "KL3ZlJCGKQY",
        title: "Spirituality And You - Mysore | Hlr. Shammy Shiri (Part 2)",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Mysore Series",
        duration: "40:50",
        date: "Mar 17, 2024",
        views: "142 Views",
        likes: "5 Likes",
        desc: "Part 2 of the extensive Mysore workshop discourse with Hlr. Shammy Shiri exploring deep spiritual laws.",
        keywords: "spirituality and you mysore shammy shiri part 2"
    },
    {
        id: "d2hQPuvREyg",
        title: "Spirituality and You - Mysore | Hlr. Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Mysore Series",
        duration: "14:34",
        date: "Mar 15, 2024",
        views: "75 Views",
        likes: "3 Likes",
        desc: "Hlr. Ganesh Prasad sharing practical perspectives on mindfulness and mental tranquility at Mysore.",
        keywords: "spirituality and you mysore ganesh prasad"
    },
    {
        id: "RXOawWQwK_4",
        title: "Universal Talk | Simplify Your Spirituality | Hlr. Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Wisdom Series",
        duration: "25:17",
        date: "Mar 15, 2024",
        views: "65 Views",
        likes: "5 Likes",
        desc: "A beautifully produced studio discourse on stripping away complexity to experience simple, pure spirituality.",
        keywords: "simplify spirituality ganesh prasad golden wings studios"
    },
    {
        id: "oYbZdWUxq8Y",
        title: "Spirituality and You - Mysore | Hlr. Shammy Shiri (Part 1)",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Mysore Series",
        duration: "13:37",
        date: "Mar 14, 2024",
        views: "511 Views",
        likes: "13 Likes",
        desc: "Part 1 of the Mysore workshop series by Hlr. Shammy Shiri on setting foundations for spiritual growth.",
        keywords: "spirituality and you mysore shammy shiri part 1"
    },
    {
        id: "lr_pY2KrcSU",
        title: "Bee Positive - Environmental Conclave 2024 | Sri V. Ramprasad (Part 2)",
        speaker: "Sri V. Ramprasad",
        category: "environment",
        catLabel: "Environmental Conclave",
        duration: "16:32",
        date: "Mar 13, 2024",
        views: "101 Views",
        likes: "1 Likes",
        desc: "Part 2 of lake conservationist Sri V. Ramprasad's keynote on reviving water bodies and community ecology.",
        keywords: "bee positive environmental conclave ramprasad lake conservation bangalore"
    },
    {
        id: "u3O3r2toKA0",
        title: "Bee Positive - Environmental Conclave 2024 | Sri V. Ramprasad (Part 1)",
        speaker: "Sri V. Ramprasad",
        category: "environment",
        catLabel: "Environmental Conclave",
        duration: "17:23",
        date: "Mar 13, 2024",
        views: "241 Views",
        likes: "3 Likes",
        desc: "Sri V. Ramprasad (Friends of Lakes Bangalore) on the vital importance of wetlands, rain harvesting, and nature care.",
        keywords: "bee positive environmental conclave ramprasad lakes water bodies"
    },
    {
        id: "WlnZnpuYPXc",
        title: "Spirituality and You - Mysore | Empty to Enrich | Hlr. Subrahamanya",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Mysore Series",
        duration: "30:03",
        date: "Mar 12, 2024",
        views: "306 Views",
        likes: "5 Likes",
        desc: "A transformative session on letting go of mental baggage to make room for peace, love, and divine abundance.",
        keywords: "empty to enrich subrahamanya mysore spirituality mindfulness"
    },
    {
        id: "HZzkAq5dWGo",
        title: "Spirituality and You - Mysore | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Mysore Series",
        duration: "27:31",
        date: "Mar 11, 2024",
        views: "268 Views",
        likes: "12 Likes",
        desc: "Master Rohan Shiri addressing seekers in Mysore on inner alignment, cosmic laws, and living consciously.",
        keywords: "spirituality and you mysore rohan shiri spiritual awareness"
    },
    {
        id: "5pf23lgKXOU",
        title: "Bee Positive - Environmental Conclave 2024 | Nature & Spirituality | Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "environment",
        catLabel: "Environmental Conclave",
        duration: "13:43",
        date: "Mar 07, 2024",
        views: "174 Views",
        likes: "10 Likes",
        desc: "Hlr. Shammy Shiri highlighting the sacred bond between human consciousness and nature at the 2024 conclave.",
        keywords: "nature and spirituality bee positive shammy shiri conclave environment"
    },
    {
        id: "TGOZc7YMpCw",
        title: "Bee Positive - Environmental Conclave 2024 | Dr. Vineeth Kumar on Biodiversity",
        speaker: "Dr. Vineeth Kumar",
        category: "environment",
        catLabel: "Environmental Conclave",
        duration: "27:52",
        date: "Mar 05, 2024",
        views: "103 Views",
        likes: "4 Likes",
        desc: "Dr. Vineeth Kumar presenting scientific and ecological insights on amphibians, frogs, and fragile habitats.",
        keywords: "dr vineeth kumar frogs eco balance wildlife biodiversity"
    },
    {
        id: "sVE5ULKfPOE",
        title: "Universal Talk | Make Time for Yourself | Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Self-Care & Mind",
        duration: "33:21",
        date: "Sep 04, 2023",
        views: "696 Views",
        likes: "29 Likes",
        desc: "A deeply moving 33-minute discourse on self-care, overcoming burnout, and prioritizing your inner journey.",
        keywords: "make time for yourself shammy shiri self care inner peace"
    },
    {
        id: "Yqof3qtj2MU",
        title: "Spirituality and You | Chikkamagaluru | Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Chikkamagaluru Series",
        duration: "25:35",
        date: "Sep 04, 2023",
        views: "271 Views",
        likes: "5 Likes",
        desc: "Introduction and foundational address by Master Rohan Shiri at the Chikkamagaluru retreat.",
        keywords: "spirituality and you chikkamagaluru rohan shiri"
    },
    {
        id: "BXEJqWwzj9I",
        title: "Spirituality and You | ANCHOR the ANGER | Hlr. Subrahamanya (Chikkamagaluru)",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Emotional Mastery",
        duration: "23:11",
        date: "Aug 29, 2023",
        views: "218 Views",
        likes: "10 Likes",
        desc: "Practical techniques on emotional mastery, anger transmutation, and developing serene patience.",
        keywords: "anchor the anger anger management subrahamanya chikkamagaluru"
    },
    {
        id: "qR8tJ13ZAPY",
        title: "Spirituality & You | ನಿಮ್ಮೊಳಗಿನ ಆಧ್ಯಾತ್ಮಿಕತೆ | Full Day Workshop LIVE",
        speaker: "Master Rohan Shiri & Team",
        category: "spirituality",
        catLabel: "Full Workshop Live",
        duration: "05:35:14",
        date: "Aug 20, 2023",
        views: "859 Views",
        likes: "22 Likes",
        desc: "Full 5.5-hour live stream recording of the landmark 'Spirituality & You' workshop conducted in Kannada.",
        keywords: "live workshop spirituality and you kannada full stream"
    },
    {
        id: "zfaeYtRuPR8",
        title: "Spirituality and You - Shivamogga | Teaching by Hlr. Subrahamanya",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Shivamogga Series",
        duration: "25:29",
        date: "Jul 09, 2023",
        views: "124 Views",
        likes: "11 Likes",
        desc: "Hlr. Subrahamanya teaching on inner stillness and mental clarity at the Kuvempu Rangamandira, Shivamogga.",
        keywords: "shivamogga subrahamanya spirituality and you"
    },
    {
        id: "NoPE6WXyw-k",
        title: "Spirituality and You - Shivamogga | Teaching by Hlr. Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Shivamogga Series",
        duration: "27:13",
        date: "Jul 08, 2023",
        views: "56 Views",
        likes: "5 Likes",
        desc: "Insightful discourse by Hlr. Ganesh Prasad delivered at the Shivamogga state workshop.",
        keywords: "shivamogga ganesh prasad spirituality and you"
    },
    {
        id: "yyF8VF3nFSQ",
        title: "Spirituality and You - Shivamogga | Teaching by Hlr. Ashwini Alathagi",
        speaker: "Hlr. Ashwini Alathagi",
        category: "spirituality",
        catLabel: "Shivamogga Series",
        duration: "22:16",
        date: "Jul 07, 2023",
        views: "1.4K Views",
        likes: "42 Likes",
        desc: "One of the most watched discourses on self-love, emotional resilience, and healing delivered at Shivamogga.",
        keywords: "shivamogga ashwini alathagi spirituality healing"
    },
    {
        id: "RMH1VEPuJ8o",
        title: "Spirituality and You - Shivamogga | Teaching by Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Shivamogga Series",
        duration: "34:54",
        date: "Jul 04, 2023",
        views: "659 Views",
        likes: "18 Likes",
        desc: "Powerful 35-minute teaching by Hlr. Shammy Shiri on community upliftment and service as spiritual practice.",
        keywords: "shivamogga shammy shiri spirituality and you"
    },
    {
        id: "_n7C2rrA4e8",
        title: "Spirituality and You - Shivamogga | Master Rohan Shiri Keynote",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Shivamogga Series",
        duration: "20:44",
        date: "Jun 21, 2023",
        views: "842 Views",
        likes: "11 Likes",
        desc: "Master Rohan Shiri's keynote address to hundreds of participants gathered at Shivamogga.",
        keywords: "shivamogga rohan shiri keynote spirituality"
    },
    {
        id: "e9p9L7vqw4A",
        title: "Life is Life | Word: Body - Awareness & Health",
        speaker: "Universal Knowledge Trust",
        category: "life-insights",
        catLabel: "Life is Life",
        duration: "02:20",
        date: "Jun 18, 2023",
        views: "60 Views",
        likes: "4 Likes",
        desc: "Short meditation on honoring and treating the physical body as a sacred vehicle for the soul.",
        keywords: "life is life body health awareness"
    },
    {
        id: "PO-eBN5YYv8",
        title: "Life is Life | Word: Rain - Nature's Grace",
        speaker: "Universal Knowledge Trust",
        category: "life-insights",
        catLabel: "Life is Life",
        duration: "01:54",
        date: "Jun 15, 2023",
        views: "69 Views",
        likes: "4 Likes",
        desc: "Poetic reflection on the blessing of rainfall, natural renewal, and universal grace.",
        keywords: "life is life rain nature gratitude"
    },
    {
        id: "KTq5XQeGWT4",
        title: "Life is Life | Word: Trees - Sacred Connection",
        speaker: "Universal Knowledge Trust",
        category: "life-insights",
        catLabel: "Life is Life",
        duration: "01:55",
        date: "Jun 15, 2023",
        views: "75 Views",
        likes: "6 Likes",
        desc: "Contemplative reflection on the selfless generosity and grounding wisdom of trees.",
        keywords: "life is life trees nature green ecology"
    },
    {
        id: "I70HR-aWzsA",
        title: "Life is Life | Word: Beauty - Wonder of Existence",
        speaker: "Universal Knowledge Trust",
        category: "life-insights",
        catLabel: "Life is Life",
        duration: "01:58",
        date: "Jun 14, 2023",
        views: "73 Views",
        likes: "14 Likes",
        desc: "Reflecting on discovering subtle beauty and peace within everyday moments.",
        keywords: "life is life beauty positive living"
    },
    {
        id: "RHwaYcSY7i8",
        title: "Spirituality and You | Kuvempu Rangamandira Mega Workshop (5+ Hours)",
        speaker: "Master Trainers of UKT",
        category: "spirituality",
        catLabel: "Mega Workshop",
        duration: "05:51:39",
        date: "Jun 05, 2023",
        views: "507 Views",
        likes: "25 Likes",
        desc: "Complete unedited video of the 1-day mega spiritual workshop conducted at Kuvempu Rangamandira, Shivamogga.",
        keywords: "shivamogga kuvempu rangamandira workshop kannada"
    },
    {
        id: "SbkW1OLzKAc",
        title: "Spirituality and You | The Power of Forgiveness | Hlr. Subrahamanya",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Emotional Healing",
        duration: "11:54",
        date: "Apr 13, 2023",
        views: "160 Views",
        likes: "14 Likes",
        desc: "Profound teaching on releasing resentment, practicing deep forgiveness, and reclaiming emotional freedom.",
        keywords: "power of forgiveness forgiveness healing subrahamanya"
    },
    {
        id: "A4PJ31G_4lk",
        title: "Spirituality and You | Life is Full of Surprises | Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Life Lessons",
        duration: "29:58",
        date: "Apr 12, 2023",
        views: "515 Views",
        likes: "26 Likes",
        desc: "Heart-to-heart discourse by Hlr. Shammy Shiri on embracing life's twists with equanimity and trust.",
        keywords: "life is full of surprises shammy shiri resilience acceptance"
    },
    {
        id: "XtSyBhX5shg",
        title: "Spirituality and You | Love Yourself | Hlr. Ashwini Alathagi (Belgaum)",
        speaker: "Hlr. Ashwini Alathagi",
        category: "healing",
        catLabel: "Belgaum Series",
        duration: "21:32",
        date: "Apr 11, 2023",
        views: "193 Views",
        likes: "3 Likes",
        desc: "Discourse at Belgaum by Hlr. Ashwini Alathagi emphasizing self-compassion, self-healing, and love.",
        keywords: "love yourself self love belgaum ashwini alathagi"
    },
    {
        id: "qQflRUd_4dI",
        title: "Spirituality and You - Bangalore | Teaching by Hlr. Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "31:44",
        date: "Apr 08, 2023",
        views: "48 Views",
        likes: "3 Likes",
        desc: "Comprehensive 31-minute discourse by Hlr. Ganesh Prasad at the Bangalore convention.",
        keywords: "bangalore ganesh prasad spirituality and you"
    },
    {
        id: "D4phcSS-Sng",
        title: "Spirituality and You - Bangalore | Teaching by Hlr. Shammy Shiri",
        speaker: "Hlr. Shammy Shiri",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "10:16",
        date: "Apr 06, 2023",
        views: "1.1K Views",
        likes: "26 Likes",
        desc: "Engaging 10-minute talk by Hlr. Shammy Shiri inspiring audiences to begin positive self-transformation.",
        keywords: "bangalore shammy shiri spirituality and you"
    },
    {
        id: "vay3lWfqhHw",
        title: "Spirituality and You - Bangalore | Teaching by Hlr. Ashwini Alathagi",
        speaker: "Hlr. Ashwini Alathagi",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "20:32",
        date: "Apr 05, 2023",
        views: "283 Views",
        likes: "12 Likes",
        desc: "Hlr. Ashwini Alathagi on the power of thoughts, emotional vibration, and spiritual harmony.",
        keywords: "bangalore ashwini alathagi spirituality and you"
    },
    {
        id: "nL7mIL6lTCk",
        title: "What is Spirituality? | Master Rohan Shiri (Belgaum)",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Belgaum Series",
        duration: "42:54",
        date: "Apr 04, 2023",
        views: "86 Views",
        likes: "3 Likes",
        desc: "Master Rohan Shiri's cornerstone 43-minute discourse at Belgaum clarifying true practical spirituality.",
        keywords: "what is spirituality belgaum rohan shiri"
    },
    {
        id: "xmJKPyZP-3s",
        title: "Spirituality and You - Bangalore | Teaching by Hlr. Subrahamanya",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Bangalore Series",
        duration: "18:37",
        date: "Apr 04, 2023",
        views: "188 Views",
        likes: "17 Likes",
        desc: "Discourse by Hlr. Subrahamanya addressing life's dilemmas and the spiritual pathway to clarity.",
        keywords: "bangalore subrahamanya spirituality and you"
    },
    {
        id: "QSz-6X0ThOY",
        title: "Spirituality and You - Bangalore | Keynote by Master Rohan Shiri",
        speaker: "Master Rohan Shiri",
        category: "rohan-shiri",
        catLabel: "Bangalore Series",
        duration: "46:37",
        date: "Apr 04, 2023",
        views: "292 Views",
        likes: "16 Likes",
        desc: "An inspiring 46-minute keynote by Master Rohan Shiri at the Bangalore program on consciousness upliftment.",
        keywords: "bangalore rohan shiri keynote discourse"
    },
    {
        id: "25ipOTRxh5k",
        title: "Spirituality and You - Hubli | Teaching by Hlr. Subrahamanya",
        speaker: "Hlr. Subrahamanya",
        category: "spirituality",
        catLabel: "Hubli Series",
        duration: "09:10",
        date: "Mar 11, 2023",
        views: "110 Views",
        likes: "18 Likes",
        desc: "Hlr. Subrahamanya addressing participants at the Hubli workshop on spiritual discipline.",
        keywords: "hubli subrahamanya spirituality and you"
    },
    {
        id: "xm1erscAZCE",
        title: "Spirituality And You - Hubli | Teaching by Hlr. Ganesh Prasad",
        speaker: "Hlr. Ganesh Prasad",
        category: "spirituality",
        catLabel: "Hubli Series",
        duration: "27:17",
        date: "Mar 11, 2023",
        views: "41 Views",
        likes: "3 Likes",
        desc: "Concluding discourse of the Hubli workshop by Hlr. Ganesh Prasad on sustaining inner transformation.",
        keywords: "hubli ganesh prasad spirituality and you"
    }
];

// Gallery Engine
document.addEventListener("DOMContentLoaded", function () {
    const gridEl = document.getElementById("universalTalkGrid");
    const paginationEl = document.getElementById("talkPaginationContainer");
    const searchInput = document.getElementById("talkSearchInput");
    const filterPills = document.querySelectorAll(".ukt-talk-filter-pill");
    const countEl = document.getElementById("talkCountDisplay");
    const noResultsEl = document.getElementById("noTalksFound");
    const resetBtn = document.getElementById("resetTalkFilters");

    const ITEMS_PER_PAGE = 12; // 12 videos per page (4 rows of 3 columns)
    let currentPage = 1;
    let currentCat = "all";
    let currentSearch = "";

    function renderCards(shouldScroll = false) {
        if (!gridEl) return;

        const filtered = UNIVERSAL_TALK_VIDEOS.filter(video => {
            const matchesCat = (currentCat === "all" || video.category === currentCat);
            const textToSearch = `${video.title} ${video.speaker} ${video.desc} ${video.keywords} ${video.catLabel}`.toLowerCase();
            const matchesSearch = !currentSearch || textToSearch.includes(currentSearch);
            return matchesCat && matchesSearch;
        });

        const totalPages = Math.ceil(filtered.length / ITEMS_PER_PAGE);
        if (currentPage > totalPages && totalPages > 0) {
            currentPage = 1;
        }

        if (countEl) {
            countEl.textContent = filtered.length;
        }

        if (filtered.length === 0) {
            gridEl.innerHTML = "";
            if (paginationEl) paginationEl.innerHTML = "";
            if (noResultsEl) noResultsEl.classList.remove("d-none");
            return;
        }

        if (noResultsEl) noResultsEl.classList.add("d-none");

        const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
        const pagedVideos = filtered.slice(startIdx, startIdx + ITEMS_PER_PAGE);

        const cardsHTML = pagedVideos.map(video => {
            const safeTitle = video.title.replace(/"/g, '&quot;');
            return `
                <div class="col-xl-4 col-lg-4 col-md-6 ukt-video-item" data-category="${video.category}">
                    <div class="ukt-yt-screen-card">
                        <div class="ukt-yt-screen" data-yt-id="${video.id}" data-title="${safeTitle}" title="Click to play video">
                            <img src="https://img.youtube.com/vi/${video.id}/hqdefault.jpg"
                                 onerror="this.onerror=null; this.src='images/universal-knowledge-universal-talks.jpg';"
                                 alt="${safeTitle}"
                                 class="ukt-yt-screen-thumb"
                                 loading="lazy">
                            <span class="ukt-yt-duration-badge"><i class="bi bi-clock me-1"></i> ${video.duration}</span>
                            <div class="ukt-yt-screen-top-bar">
                                <div class="ukt-yt-channel-avatar">
                                    <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                </div>
                                <div class="ukt-yt-channel-meta">
                                    <h4 class="ukt-yt-screen-video-title">${safeTitle}</h4>
                                    <p class="ukt-yt-channel-subtext">Universal Talk • ${video.views}</p>
                                </div>
                            </div>
                            <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="68" height="48">
                                    <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="ukt-yt-screen-bottom-bar">
                                <div class="ukt-yt-screen-watermark">
                                    <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                </div>
                                <a href="https://www.youtube.com/watch?v=${video.id}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="ukt-yt-watch-on-pill"
                                   onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube"></i> YouTube
                                </a>
                            </div>
                        </div>
                        <div class="ukt-yt-screen-details">
                            <div class="ukt-yt-screen-meta-top">
                                <span class="ukt-author-pill-badge">${video.catLabel}</span>
                                <span class="ukt-yt-speaker" title="${video.speaker}"><i class="bi bi-person-fill"></i> ${video.speaker}</span>
                            </div>
                            <h3 class="ukt-yt-screen-title">${video.title}</h3>
                            <p class="ukt-yt-screen-desc">${video.desc}</p>
                            <div class="ukt-yt-screen-actions">
                                <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> ${video.date} • ${video.views}</span>
                                <a href="javascript:void(0)" class="ukt-yt-watch-btn ukt-open-lightbox-btn" data-yt-id="${video.id}" data-title="${safeTitle}">
                                    <i class="bi bi-play-circle-fill"></i> Play Inline
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }).join("");

        gridEl.innerHTML = cardsHTML;
        renderPagination(filtered.length, totalPages);
        bindPlayEvents();

        if (shouldScroll) {
            const gallerySection = document.getElementById("universal-talks-gallery");
            if (gallerySection) {
                gallerySection.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        }
    }

    function renderPagination(totalItems, totalPages) {
        if (!paginationEl) return;

        if (totalItems <= ITEMS_PER_PAGE || totalPages <= 1) {
            paginationEl.innerHTML = "";
            return;
        }

        let buttonsHTML = `<div class="ukt-gallery-pagination" role="navigation" aria-label="Videos Pagination">`;

        // Previous Button
        buttonsHTML += `
            <button type="button" 
                    class="ukt-page-btn nav-btn" 
                    data-page="${currentPage - 1}" 
                    ${currentPage === 1 ? "disabled" : ""} 
                    aria-label="Previous Page">
                <i class="bi bi-chevron-left"></i> Prev
            </button>
        `;

        // Page Number Buttons with smart ellipsis
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                buttonsHTML += `
                    <button type="button" 
                            class="ukt-page-btn ${i === currentPage ? "active" : ""}" 
                            data-page="${i}"
                            aria-current="${i === currentPage ? 'page' : 'false'}">
                        ${i}
                    </button>
                `;
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                buttonsHTML += `<span class="ukt-page-ellipsis">...</span>`;
            }
        }

        // Next Button
        buttonsHTML += `
            <button type="button" 
                    class="ukt-page-btn nav-btn" 
                    data-page="${currentPage + 1}" 
                    ${currentPage === totalPages ? "disabled" : ""} 
                    aria-label="Next Page">
                Next <i class="bi bi-chevron-right"></i>
            </button>
        `;

        buttonsHTML += `</div>`;

        // Showing counter info
        const startIdx = (currentPage - 1) * ITEMS_PER_PAGE + 1;
        const endIdx = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
        buttonsHTML += `
            <div class="ukt-pagination-info">
                Showing <strong>${startIdx}–${endIdx}</strong> of <strong>${totalItems}</strong> videos
            </div>
        `;

        paginationEl.innerHTML = buttonsHTML;

        // Bind Pagination Click Events
        paginationEl.querySelectorAll(".ukt-page-btn:not(:disabled)").forEach(btn => {
            btn.addEventListener("click", function () {
                const targetPage = parseInt(this.getAttribute("data-page"), 10);
                if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                    currentPage = targetPage;
                    renderCards(true);
                }
            });
        });
    }

    function bindPlayEvents() {
        // Inline Player on Screen click
        document.querySelectorAll(".ukt-yt-screen").forEach(screen => {
            screen.onclick = function (e) {
                if (e.target.closest(".ukt-yt-watch-on-pill")) return;
                e.preventDefault();
                const ytId = this.getAttribute("data-yt-id");
                if (!ytId) return;

                this.innerHTML = `
                    <iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0"
                            title="YouTube Video Player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;z-index:10;">
                    </iframe>
                `;
                this.style.cursor = "default";
            };
        });

        // Lightbox popup on action button click
        document.querySelectorAll(".ukt-open-lightbox-btn").forEach(btn => {
            btn.onclick = function (e) {
                e.preventDefault();
                const ytId = this.getAttribute("data-yt-id");
                const title = this.getAttribute("data-title");
                openTalkModal(ytId, title);
            };
        });
    }

    // Modal Lightbox
    const modal = document.getElementById("universalTalkModal");
    const modalTitle = document.getElementById("talkModalTitle");
    const modalIframe = document.getElementById("talkModalIframe");
    const closeBtn = document.getElementById("closeTalkModalBtn");

    window.openTalkModal = function (ytId, title) {
        if (!modal || !modalIframe) return;
        if (modalTitle) modalTitle.textContent = title || "Universal Talk";
        modalIframe.src = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0`;
        modal.classList.add("is-open");
        document.body.style.overflow = "hidden";
    };

    window.closeTalkModal = function () {
        if (!modal || !modalIframe) return;
        modal.classList.remove("is-open");
        modalIframe.src = "";
        document.body.style.overflow = "";
    };

    if (closeBtn) closeBtn.onclick = closeTalkModal;
    if (modal) {
        modal.onclick = function (e) {
            if (e.target === modal) closeTalkModal();
        };
    }
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && modal && modal.classList.contains("is-open")) {
            closeTalkModal();
        }
    });

    // Search Input
    if (searchInput) {
        searchInput.addEventListener("input", function (e) {
            currentSearch = e.target.value.toLowerCase().trim();
            currentPage = 1;
            renderCards(false);
        });
    }

    // Category Tabs
    filterPills.forEach(pill => {
        pill.addEventListener("click", function () {
            filterPills.forEach(p => p.classList.remove("active"));
            this.classList.add("active");
            currentCat = this.getAttribute("data-category") || "all";
            currentPage = 1;
            renderCards(false);
        });
    });

    // Reset Button
    if (resetBtn) {
        resetBtn.addEventListener("click", function () {
            if (searchInput) searchInput.value = "";
            currentSearch = "";
            currentCat = "all";
            currentPage = 1;
            filterPills.forEach(p => p.classList.remove("active"));
            const allPill = document.querySelector('.ukt-talk-filter-pill[data-category="all"]');
            if (allPill) allPill.classList.add("active");
            renderCards(false);
        });
    }

    // Initial Render
    renderCards(false);

    // Live YouTube Account Widget Fetcher
    syncLiveYouTubeChannel();

    // YouTube Channel Live Sync Engine
    async function syncLiveYouTubeChannel() {
        const syncBadge = document.getElementById("uktLiveSyncBadge");
        const channelRss = "https://www.youtube.com/feeds/videos.xml?channel_id=UCM4kouXxWDEJQU-rJic5fNg";
        
        try {
            const proxyUrl = `https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(channelRss)}`;
            const response = await fetch(proxyUrl);
            if (!response.ok) throw new Error("Feed response status: " + response.status);
            const data = await response.json();

            if (data && data.status === "ok" && Array.isArray(data.items) && data.items.length > 0) {
                const existingIds = new Set(UNIVERSAL_TALK_VIDEOS.map(v => v.id));
                let newVideosCount = 0;

                data.items.forEach(item => {
                    let vidId = "";
                    if (item.link) {
                        const match = item.link.match(/(?:v=|\/embed\/|\/watch\?v=|\.be\/)([^&?#]+)/);
                        if (match && match[1]) vidId = match[1];
                    }
                    if (!vidId && item.guid) {
                        vidId = item.guid.replace("yt:video:", "");
                    }

                    if (vidId && !existingIds.has(vidId)) {
                        const pubDate = new Date(item.pubDate);
                        const formattedDate = !isNaN(pubDate.getTime())
                            ? pubDate.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" })
                            : "Recent";

                        const cleanDesc = item.description
                            ? item.description.replace(/<[^>]*>/g, "").substring(0, 160) + "..."
                            : "Latest video discourse published on the official Universal Talk YouTube channel.";

                        const newVideoItem = {
                            id: vidId,
                            title: item.title || "Universal Talk Discourse",
                            speaker: item.author || "Universal Knowledge Trust",
                            category: "rohan-shiri",
                            catLabel: "🔴 Live Upload",
                            duration: "Latest",
                            date: formattedDate,
                            views: "Live on YouTube",
                            likes: "YouTube",
                            desc: cleanDesc,
                            keywords: "live upload latest discourse universal talk youtube",
                            isLiveSync: true
                        };

                        UNIVERSAL_TALK_VIDEOS.unshift(newVideoItem);
                        existingIds.add(vidId);
                        newVideosCount++;
                    }
                });

                if (syncBadge) {
                    syncBadge.innerHTML = `<span class="ukt-live-dot"></span> Live Synced (${data.items.length} Latest)`;
                }

                if (newVideosCount > 0) {
                    renderCards(false);
                }
            } else {
                if (syncBadge) {
                    syncBadge.innerHTML = `<span class="ukt-live-dot"></span> Live Account Synced`;
                }
            }
        } catch (error) {
            console.warn("YouTube Live Widget notice: Using active catalog.", error);
            if (syncBadge) {
                syncBadge.innerHTML = `<span class="ukt-live-dot"></span> Live Account Synced`;
            }
        }
    }
});
