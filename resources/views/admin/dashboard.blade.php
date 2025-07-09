<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FreeFolio Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .progress-bar { transition: width 0.3s ease; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<!-- Header -->
<div class="bg-white shadow-sm border-b sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <i class="fas fa-cog text-blue-600 text-2xl mr-3"></i>
                <h1 class="text-2xl font-bold text-gray-900">FreeFolio Admin Panel</h1>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="exportData()" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button onclick="importData()" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
                <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">
                        Portfolio Manager
                    </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Tab Navigation -->
    <div class="mb-8">
        <div class="border-b border-gray-200 bg-white rounded-t-lg">
            <nav class="flex justify-center w-full bg-gray-50 border-b border-gray-100 py-3">
                <div class="flex space-x-8">
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="profile">
                        <i class="fas fa-user mr-2"></i>
                        <span>Profile</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="about">
                        <i class="fas fa-user mr-2"></i>
                        <span>About</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="education">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        <span>Education</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="experience">
                        <i class="fas fa-briefcase mr-2"></i>
                        <span>Experience</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="skills">
                        <i class="fas fa-code mr-2"></i>
                        <span>Skills</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="services">
                        <i class="fas fa-cogs mr-2"></i>
                        <span>Services</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="portfolio">
                        <i class="fas fa-folder-open mr-2"></i>
                        <span>Portfolio</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-500 font-medium hover:bg-gray-100 focus:outline-none transition-all" data-tab="testimonials">
                        <i class="fas fa-comment-alt mr-2"></i>
                        <span>Reviews</span>
                    </button>
                    <button class="tab-btn flex items-center px-2 py-1 rounded-md text-gray-900 font-semibold bg-white shadow-sm" data-tab="blog">
                        <i class="fas fa-file-alt mr-2"></i>
                        <span>Blog</span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!-- Tab Contents -->

    <!-- Profile Tab -->
    <div id="profile-tab" class="tab-content active">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                    Profile Information
                </h2>
                <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                    Personal Details
                </div>
            </div>
            <div class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" id="profile-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter your full name">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Profile Image</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="profile-image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg">
                        </div>
                        <div id="profile-image-preview" class="mt-3"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Professional Titles</label>
                    <input type="text" id="profile-title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Web Designer, Developer, etc.">
                    <p class="text-xs text-gray-500">Separate multiple titles with commas</p>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Professional Description</label>
                    <textarea id="profile-description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Brief description about yourself and your expertise"></textarea>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">CV/Resume File</label>
                        <input type="file" id="profile-cv" accept=".pdf,.doc,.docx" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-300 rounded-lg">
                        <div id="profile-cv-preview" class="mt-2"></div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Introduction Video URL</label>
                        <input type="url" id="profile-video" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="https://youtube.com/embed/...">
                    </div>
                </div>
                <div class="flex justify-end pt-4">
                    <button onclick="saveProfile()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>Save Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Tab -->
    <div id="about-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle text-green-600 mr-3"></i>
                    About Information
                </h2>
                <div class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                    Personal Info
                </div>
            </div>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" id="about-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Birthday</label>
                        <input type="text" id="about-birthday" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Degree</label>
                        <input type="text" id="about-degree" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Experience</label>
                        <input type="text" id="about-experience" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Phone</label>
                        <input type="tel" id="about-phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="about-email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Address</label>
                        <input type="text" id="about-address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Freelance Status</label>
                        <select id="about-freelance" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                            <option value="Available">Available</option>
                            <option value="Busy">Busy</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">About Description</label>
                    <textarea id="about-description" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200" placeholder="Write a detailed description about yourself"></textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">About Section Image</label>
                    <input type="file" id="about-image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-300 rounded-lg">
                    <div id="about-image-preview" class="mt-3"></div>
                </div>
                <div class="flex justify-end pt-4">
                    <button onclick="saveAbout()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>Save About Info
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Education Tab -->
    <div id="education-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-graduation-cap text-purple-600 mr-3"></i>
                    Education
                </h2>
                <button onclick="addEducation()" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Education
                </button>
            </div>
            <div id="education-list" class="space-y-4">
                <!-- Education items will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Experience Tab -->
    <div id="experience-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-briefcase text-orange-600 mr-3"></i>
                    Work Experience
                </h2>
                <button onclick="addExperience()" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Experience
                </button>
            </div>
            <div id="experience-list" class="space-y-4">
                <!-- Experience items will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Skills Tab -->
    <div id="skills-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-code text-indigo-600 mr-3"></i>
                    Skills & Expertise
                </h2>
                <button onclick="addSkill()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Skill
                </button>
            </div>
            <div id="skills-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Skills will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Services Tab -->
    <div id="services-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-cogs text-teal-600 mr-3"></i>
                    Services Offered
                </h2>
                <button onclick="addService()" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Service
                </button>
            </div>
            <div id="services-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Services will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Portfolio Tab -->
    <div id="portfolio-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-folder-open text-pink-600 mr-3"></i>
                    Portfolio Projects
                </h2>
                <button onclick="addPortfolio()" class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Project
                </button>
            </div>
            <div id="portfolio-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Portfolio items will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Testimonials Tab -->
    <div id="testimonials-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-comments text-yellow-600 mr-3"></i>
                    Client Testimonials
                </h2>
                <button onclick="addTestimonial()" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Testimonial
                </button>
            </div>
            <div id="testimonials-list" class="space-y-4">
                <!-- Testimonials will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Blog Tab -->
    <div id="blog-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-blog text-red-600 mr-3"></i>
                    Blog Posts
                </h2>
                <button onclick="addBlog()" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Add Blog Post
                </button>
            </div>
            <div id="blog-list" class="space-y-4">
                <!-- Blog posts will be dynamically added here -->
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
<div id="message-container" class="fixed top-20 right-4 z-50 space-y-2"></div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
        <span class="text-gray-700 font-medium">Processing...</span>
    </div>
</div>

<script>
    // Global Data Storage
    let portfolioData = {
        profile: {
            name: "Kate Winslet",
            title: "Web Designer, Web Developer, Front End Developer, Apps Designer, Apps Developer",
            description: "Creative and passionate developer with 10+ years of experience in creating beautiful and functional web solutions.",
            image: "",
            cv: "",
            video: "https://www.youtube.com/embed/DWRcNpR6Kdc",
        },
        about: {
            name: "Kate Winslet",
            birthday: "1 April 1990",
            degree: "Master in Computer Science",
            experience: "10+ Years",
            phone: "+012 345 6789",
            email: "info@example.com",
            address: "123 Street, New York, USA",
            freelance: "Available",
            description: "I am a passionate web developer with over 10 years of experience in creating innovative digital solutions. My expertise spans across modern web technologies, responsive design, and user experience optimization. I believe in creating websites that not only look great but also provide exceptional functionality and performance.",
            image: "",
        },
        education: [
            {
                id: "1",
                title: "Master in Computer Science",
                institution: "Cambridge University",
                period: "2018 - 2020",
                description: "Advanced computer science studies focusing on software engineering, web technologies, and artificial intelligence. Graduated with distinction.",
            },
            {
                id: "2",
                title: "Bachelor in Computer Science",
                institution: "MIT University",
                period: "2014 - 2018",
                description: "Foundation in computer science with specialization in web development, programming languages, and database management systems.",
            },
        ],
        experience: [
            {
                id: "1",
                title: "Senior Web Developer",
                company: "Tech Solutions Inc",
                period: "2020 - Present",
                description: "Leading web development projects, mentoring junior developers, and implementing modern web technologies. Responsible for full-stack development and project architecture.",
            },
            {
                id: "2",
                title: "Web Developer",
                company: "Digital Agency",
                period: "2018 - 2020",
                description: "Developed responsive websites and web applications using modern frameworks. Collaborated with design teams to create pixel-perfect implementations.",
            },
        ],
        skills: [
            { id: "1", name: "HTML5", percentage: 95, color: "bg-orange-500" },
            { id: "2", name: "CSS3", percentage: 90, color: "bg-blue-500" },
            { id: "3", name: "JavaScript", percentage: 92, color: "bg-yellow-500" },
            { id: "4", name: "React", percentage: 88, color: "bg-cyan-500" },
            { id: "5", name: "Node.js", percentage: 85, color: "bg-green-500" },
            { id: "6", name: "PHP", percentage: 80, color: "bg-purple-500" },
        ],
        services: [
            {
                id: "1",
                title: "Web Design",
                icon: "fas fa-laptop-code",
                description: "Creating beautiful and functional web designs that engage users and drive conversions. Focus on modern UI/UX principles.",
            },
            {
                id: "2",
                title: "Web Development",
                icon: "fas fa-code",
                description: "Building responsive and dynamic websites using modern technologies and best practices. Full-stack development services.",
            },
            {
                id: "3",
                title: "Mobile Apps",
                icon: "fas fa-mobile-alt",
                description: "Developing cross-platform mobile applications for iOS and Android devices using React Native and Flutter.",
            },
            {
                id: "4",
                title: "SEO Optimization",
                icon: "fas fa-search",
                description: "Optimizing websites for search engines to improve visibility and organic traffic. Technical SEO and content optimization.",
            },
        ],
        portfolio: [
            {
                id: "1",
                title: "E-commerce Platform",
                category: "Development",
                image: "",
                description: "Modern e-commerce platform with payment integration, inventory management, and responsive design.",
            },
            {
                id: "2",
                title: "Mobile App UI Design",
                category: "Design",
                image: "",
                description: "Complete UI/UX design for fitness tracking mobile application with modern interface and user-friendly navigation.",
            },
            {
                id: "3",
                title: "Brand Identity Package",
                category: "Marketing",
                image: "",
                description: "Complete brand identity design including logo, business cards, and marketing materials for startup company.",
            },
        ],
        testimonials: [
            {
                id: "1",
                name: "John Smith",
                profession: "CEO, Tech Corp",
                message: "Excellent work quality and professional approach. Kate delivered our project on time and exceeded our expectations. Highly recommended for web development projects.",
                image: "",
            },
            {
                id: "2",
                name: "Sarah Johnson",
                profession: "Marketing Director",
                message: "Creative solutions and timely delivery. Great experience working with Kate on our website redesign. The results were outstanding and our conversion rates improved significantly.",
                image: "",
            },
        ],
        blog: [
            {
                id: "1",
                title: "Modern Web Development Trends 2024",
                date: "2024-01-15",
                image: "",
                excerpt: "Exploring the latest trends in web development and what to expect in 2024. From AI integration to new frameworks.",
                content: "The web development landscape continues to evolve rapidly. In 2024, we're seeing exciting trends that are reshaping how we build and interact with websites...",
            },
            {
                id: "2",
                title: "Best Practices for Responsive Design",
                date: "2024-01-10",
                image: "",
                excerpt: "Learn how to create websites that work perfectly on all devices. Essential tips for modern responsive design.",
                content: "Responsive design is no longer optional in today's multi-device world. Here are the essential practices every developer should know...",
            },
        ],
    }

    // Utility Functions
    function generateId() {
        return Math.random().toString(36).substr(2, 9)
    }

    function showMessage(message, type = "success") {
        const container = document.getElementById("message-container")
        const messageDiv = document.createElement("div")

        const bgColor = type === "success" ? "bg-green-100 border-green-400 text-green-700" : "bg-red-100 border-red-400 text-red-700"
        const icon = type === "success" ? "fas fa-check-circle" : "fas fa-exclamation-circle"

        messageDiv.className = `${bgColor} border px-4 py-3 rounded-lg shadow-lg fade-in flex items-center justify-between`
        messageDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="${icon} mr-2"></i>
                    <span class="font-medium">${message}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4 text-lg hover:opacity-70">
                    <i class="fas fa-times"></i>
                </button>
            `
        container.appendChild(messageDiv)

        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove()
            }
        }, 5000)
    }

    function showLoading(show = true) {
        const overlay = document.getElementById("loading-overlay")
        if (show) {
            overlay.classList.remove("hidden")
        } else {
            overlay.classList.add("hidden")
        }
    }

    function handleFileUpload(file) {
        return new Promise((resolve) => {
            const reader = new FileReader()
            reader.onload = (e) => resolve(e.target.result)
            reader.readAsDataURL(file)
        })
    }

    // Tab Management
    function initializeTabs() {
        const tabButtons = document.querySelectorAll(".tab-btn")
        const tabContents = document.querySelectorAll(".tab-content")

        tabButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const tabName = button.getAttribute("data-tab")

                // Remove active classes
                tabButtons.forEach((btn) => {
                    btn.classList.remove("bg-blue-100", "text-blue-700", "border-b-2", "border-blue-500")
                    btn.classList.add("text-gray-500", "hover:text-gray-700")
                })
                tabContents.forEach((content) => content.classList.remove("active"))

                // Add active classes
                button.classList.remove("text-gray-500", "hover:text-gray-700")
                button.classList.add("bg-blue-100", "text-blue-700", "border-b-2", "border-blue-500")
                document.getElementById(`${tabName}-tab`).classList.add("active")
            })
        })
    }

    // Profile Functions
    function loadProfile() {
        const profile = portfolioData.profile
        document.getElementById("profile-name").value = profile.name
        document.getElementById("profile-title").value = profile.title
        document.getElementById("profile-description").value = profile.description
        document.getElementById("profile-video").value = profile.video

        if (profile.image) {
            document.getElementById("profile-image-preview").innerHTML =
                `<div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <img src="${profile.image}" alt="Profile" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                        <div class="text-sm text-gray-600">Profile image uploaded</div>
                    </div>`
        }

        if (profile.cv) {
            document.getElementById("profile-cv-preview").innerHTML =
                `<div class="flex items-center space-x-2 p-2 bg-green-50 rounded-lg text-sm text-green-700">
                        <i class="fas fa-file-pdf"></i>
                        <span>CV file uploaded</span>
                    </div>`
        }
    }

    function saveProfile() {
        showLoading(true)
        setTimeout(() => {
            portfolioData.profile.name = document.getElementById("profile-name").value
            portfolioData.profile.title = document.getElementById("profile-title").value
            portfolioData.profile.description = document.getElementById("profile-description").value
            portfolioData.profile.video = document.getElementById("profile-video").value

            showLoading(false)
            showMessage("Profile information saved successfully!")
            saveToLocalStorage()
        }, 1000)
    }

    // About Functions
    function loadAbout() {
        const about = portfolioData.about
        document.getElementById("about-name").value = about.name
        document.getElementById("about-birthday").value = about.birthday
        document.getElementById("about-degree").value = about.degree
        document.getElementById("about-experience").value = about.experience
        document.getElementById("about-phone").value = about.phone
        document.getElementById("about-email").value = about.email
        document.getElementById("about-address").value = about.address
        document.getElementById("about-freelance").value = about.freelance
        document.getElementById("about-description").value = about.description

        if (about.image) {
            document.getElementById("about-image-preview").innerHTML =
                `<div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <img src="${about.image}" alt="About" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                        <div class="text-sm text-gray-600">About section image uploaded</div>
                    </div>`
        }
    }

    function saveAbout() {
        showLoading(true)
        setTimeout(() => {
            portfolioData.about.name = document.getElementById("about-name").value
            portfolioData.about.birthday = document.getElementById("about-birthday").value
            portfolioData.about.degree = document.getElementById("about-degree").value
            portfolioData.about.experience = document.getElementById("about-experience").value
            portfolioData.about.phone = document.getElementById("about-phone").value
            portfolioData.about.email = document.getElementById("about-email").value
            portfolioData.about.address = document.getElementById("about-address").value
            portfolioData.about.freelance = document.getElementById("about-freelance").value
            portfolioData.about.description = document.getElementById("about-description").value

            showLoading(false)
            showMessage("About information saved successfully!")
            saveToLocalStorage()
        }, 1000)
    }

    // Education Functions
    function loadEducation() {
        const container = document.getElementById("education-list")
        container.innerHTML = ""

        if (portfolioData.education.length === 0) {
            container.innerHTML = `
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-graduation-cap text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No education entries yet</p>
                        <p class="text-sm">Click "Add Education" to get started</p>
                    </div>
                `
            return
        }

        portfolioData.education.forEach((item, index) => {
            const educationHTML = `
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="education-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600 font-bold">${index + 1}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">${item.title || "New Education"}</h3>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="editEducation('${item.id}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="deleteEducation('${item.id}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                        <div id="education-view-${item.id}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-university text-purple-600"></i>
                                    <span class="font-semibold text-gray-700">Institution:</span>
                                    <span class="text-gray-600">${item.institution}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar text-purple-600"></i>
                                    <span class="font-semibold text-gray-700">Period:</span>
                                    <span class="text-gray-600">${item.period}</span>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-info-circle text-purple-600 mt-1"></i>
                                <div>
                                    <span class="font-semibold text-gray-700">Description:</span>
                                    <p class="text-gray-600 mt-1">${item.description}</p>
                                </div>
                            </div>
                        </div>
                        <div id="education-edit-${item.id}" class="hidden space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" placeholder="Degree Title" value="${item.title}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" id="education-title-${item.id}">
                                <input type="text" placeholder="Institution" value="${item.institution}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" id="education-institution-${item.id}">
                            </div>
                            <input type="text" placeholder="Period (e.g., 2018-2020)" value="${item.period}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" id="education-period-${item.id}">
                            <textarea placeholder="Description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" id="education-description-${item.id}">${item.description}</textarea>
                            <div class="flex gap-3">
                                <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center" onclick="saveEducation('${item.id}')">
                                    <i class="fas fa-save mr-2"></i>Save Changes
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200" onclick="cancelEditEducation('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += educationHTML
        })
    }

    function addEducation() {
        const newEducation = {
            id: generateId(),
            title: "",
            institution: "",
            period: "",
            description: "",
        }
        portfolioData.education.push(newEducation)
        loadEducation()
        editEducation(newEducation.id)
    }

    function editEducation(id) {
        document.getElementById(`education-view-${id}`).classList.add("hidden")
        document.getElementById(`education-edit-${id}`).classList.remove("hidden")
    }

    function cancelEditEducation(id) {
        document.getElementById(`education-view-${id}`).classList.remove("hidden")
        document.getElementById(`education-edit-${id}`).classList.add("hidden")
    }

    function saveEducation(id) {
        const item = portfolioData.education.find((edu) => edu.id === id)
        item.title = document.getElementById(`education-title-${id}`).value
        item.institution = document.getElementById(`education-institution-${id}`).value
        item.period = document.getElementById(`education-period-${id}`).value
        item.description = document.getElementById(`education-description-${id}`).value

        loadEducation()
        showMessage("Education entry saved successfully!")
        saveToLocalStorage()
    }

    function deleteEducation(id) {
        if (confirm("Are you sure you want to delete this education entry?")) {
            portfolioData.education = portfolioData.education.filter((item) => item.id !== id)
            loadEducation()
            showMessage("Education entry deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Experience Functions
    function loadExperience() {
        const container = document.getElementById("experience-list")
        container.innerHTML = ""

        if (portfolioData.experience.length === 0) {
            container.innerHTML = `
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-briefcase text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No work experience yet</p>
                        <p class="text-sm">Click "Add Experience" to get started</p>
                    </div>
                `
            return
        }

        portfolioData.experience.forEach((item, index) => {
            const experienceHTML = `
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="experience-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                    <span class="text-orange-600 font-bold">${index + 1}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">${item.title || "New Experience"}</h3>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="editExperience('${item.id}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="deleteExperience('${item.id}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                        <div id="experience-view-${item.id}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-building text-orange-600"></i>
                                    <span class="font-semibold text-gray-700">Company:</span>
                                    <span class="text-gray-600">${item.company}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar text-orange-600"></i>
                                    <span class="font-semibold text-gray-700">Period:</span>
                                    <span class="text-gray-600">${item.period}</span>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-tasks text-orange-600 mt-1"></i>
                                <div>
                                    <span class="font-semibold text-gray-700">Responsibilities:</span>
                                    <p class="text-gray-600 mt-1">${item.description}</p>
                                </div>
                            </div>
                        </div>
                        <div id="experience-edit-${item.id}" class="hidden space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" placeholder="Job Title" value="${item.title}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" id="experience-title-${item.id}">
                                <input type="text" placeholder="Company" value="${item.company}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" id="experience-company-${item.id}">
                            </div>
                            <input type="text" placeholder="Period (e.g., 2020-Present)" value="${item.period}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" id="experience-period-${item.id}">
                            <textarea placeholder="Job Description & Responsibilities" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" id="experience-description-${item.id}">${item.description}</textarea>
                            <div class="flex gap-3">
                                <button class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center" onclick="saveExperience('${item.id}')">
                                    <i class="fas fa-save mr-2"></i>Save Changes
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200" onclick="cancelEditExperience('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += experienceHTML
        })
    }

    function addExperience() {
        const newExperience = {
            id: generateId(),
            title: "",
            company: "",
            period: "",
            description: "",
        }
        portfolioData.experience.push(newExperience)
        loadExperience()
        editExperience(newExperience.id)
    }

    function editExperience(id) {
        document.getElementById(`experience-view-${id}`).classList.add("hidden")
        document.getElementById(`experience-edit-${id}`).classList.remove("hidden")
    }

    function cancelEditExperience(id) {
        document.getElementById(`experience-view-${id}`).classList.remove("hidden")
        document.getElementById(`experience-edit-${id}`).classList.add("hidden")
    }

    function saveExperience(id) {
        const item = portfolioData.experience.find((exp) => exp.id === id)
        item.title = document.getElementById(`experience-title-${id}`).value
        item.company = document.getElementById(`experience-company-${id}`).value
        item.period = document.getElementById(`experience-period-${id}`).value
        item.description = document.getElementById(`experience-description-${id}`).value

        loadExperience()
        showMessage("Work experience saved successfully!")
        saveToLocalStorage()
    }

    function deleteExperience(id) {
        if (confirm("Are you sure you want to delete this work experience?")) {
            portfolioData.experience = portfolioData.experience.filter((item) => item.id !== id)
            loadExperience()
            showMessage("Work experience deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Skills Functions
    function loadSkills() {
        const container = document.getElementById("skills-list")
        container.innerHTML = ""

        if (portfolioData.skills.length === 0) {
            container.innerHTML = `
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-code text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No skills added yet</p>
                        <p class="text-sm">Click "Add Skill" to showcase your expertise</p>
                    </div>
                `
            return
        }

        portfolioData.skills.forEach((item) => {
            const skillHTML = `
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="skill-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-code text-indigo-600 mr-2"></i>
                                ${item.name || "New Skill"}
                            </h3>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200" onclick="editSkill('${item.id}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200" onclick="deleteSkill('${item.id}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div id="skill-view-${item.id}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-2xl font-bold text-indigo-600">${item.percentage}%</span>
                                <div class="w-3 h-3 ${item.color} rounded-full"></div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="${item.color} h-3 rounded-full progress-bar transition-all duration-1000 ease-out" style="width: ${item.percentage}%"></div>
                            </div>
                        </div>
                        <div id="skill-edit-${item.id}" class="hidden space-y-3">
                            <input type="text" placeholder="Skill Name" value="${item.name}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="skill-name-${item.id}">
                            <input type="number" placeholder="Percentage (0-100)" value="${item.percentage}" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="skill-percentage-${item.id}">
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="skill-color-${item.id}">
                                <option value="bg-blue-500" ${item.color === "bg-blue-500" ? "selected" : ""}>Blue</option>
                                <option value="bg-green-500" ${item.color === "bg-green-500" ? "selected" : ""}>Green</option>
                                <option value="bg-yellow-500" ${item.color === "bg-yellow-500" ? "selected" : ""}>Yellow</option>
                                <option value="bg-purple-500" ${item.color === "bg-purple-500" ? "selected" : ""}>Purple</option>
                                <option value="bg-red-500" ${item.color === "bg-red-500" ? "selected" : ""}>Red</option>
                                <option value="bg-indigo-500" ${item.color === "bg-indigo-500" ? "selected" : ""}>Indigo</option>
                                <option value="bg-pink-500" ${item.color === "bg-pink-500" ? "selected" : ""}>Pink</option>
                                <option value="bg-cyan-500" ${item.color === "bg-cyan-500" ? "selected" : ""}>Cyan</option>
                                <option value="bg-orange-500" ${item.color === "bg-orange-500" ? "selected" : ""}>Orange</option>
                            </select>
                            <div class="flex gap-2">
                                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="saveSkill('${item.id}')">
                                    <i class="fas fa-save mr-1"></i>Save
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200" onclick="cancelEditSkill('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += skillHTML
        })
    }

    function addSkill() {
        const newSkill = {
            id: generateId(),
            name: "",
            percentage: 0,
            color: "bg-blue-500",
        }
        portfolioData.skills.push(newSkill)
        loadSkills()
        editSkill(newSkill.id)
    }

    function editSkill(id) {
        document.getElementById(`skill-view-${id}`).classList.add("hidden")
        document.getElementById(`skill-edit-${id}`).classList.remove("hidden")
    }

    function cancelEditSkill(id) {
        document.getElementById(`skill-view-${id}`).classList.remove("hidden")
        document.getElementById(`skill-edit-${id}`).classList.add("hidden")
    }

    function saveSkill(id) {
        const item = portfolioData.skills.find((skill) => skill.id === id)
        item.name = document.getElementById(`skill-name-${id}`).value
        item.percentage = parseInt(document.getElementById(`skill-percentage-${id}`).value) || 0
        item.color = document.getElementById(`skill-color-${id}`).value

        loadSkills()
        showMessage("Skill saved successfully!")
        saveToLocalStorage()
    }

    function deleteSkill(id) {
        if (confirm("Are you sure you want to delete this skill?")) {
            portfolioData.skills = portfolioData.skills.filter((item) => item.id !== id)
            loadSkills()
            showMessage("Skill deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Services Functions
    function loadServices() {
        const container = document.getElementById("services-list")
        container.innerHTML = ""

        if (portfolioData.services.length === 0) {
            container.innerHTML = `
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-cogs text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No services listed yet</p>
                        <p class="text-sm">Click "Add Service" to showcase what you offer</p>
                    </div>
                `
            return
        }

        portfolioData.services.forEach((item) => {
            const serviceHTML = `
                    <div class="bg-gradient-to-br from-teal-50 to-cyan-50 border border-teal-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="service-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                    <i class="${item.icon} text-teal-600 text-xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">${item.title || "New Service"}</h3>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200" onclick="editService('${item.id}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200" onclick="deleteService('${item.id}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div id="service-view-${item.id}">
                            <p class="text-gray-600 leading-relaxed">${item.description}</p>
                        </div>
                        <div id="service-edit-${item.id}" class="hidden space-y-3">
                            <input type="text" placeholder="Service Title" value="${item.title}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" id="service-title-${item.id}">
                            <input type="text" placeholder="Icon Class (e.g., fas fa-laptop-code)" value="${item.icon}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" id="service-icon-${item.id}">
                            <textarea placeholder="Service Description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" id="service-description-${item.id}">${item.description}</textarea>
                            <div class="flex gap-2">
                                <button class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="saveService('${item.id}')">
                                    <i class="fas fa-save mr-1"></i>Save
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200" onclick="cancelEditService('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += serviceHTML
        })
    }

    function addService() {
        const newService = {
            id: generateId(),
            title: "",
            icon: "fas fa-laptop-code",
            description: "",
        }
        portfolioData.services.push(newService)
        loadServices()
        editService(newService.id)
    }

    function editService(id) {
        document.getElementById(`service-view-${id}`).classList.add("hidden")
        document.getElementById(`service-edit-${id}`).classList.remove("hidden")
    }

    function cancelEditService(id) {
        document.getElementById(`service-view-${id}`).classList.remove("hidden")
        document.getElementById(`service-edit-${id}`).classList.add("hidden")
    }

    function saveService(id) {
        const item = portfolioData.services.find((service) => service.id === id)
        item.title = document.getElementById(`service-title-${id}`).value
        item.icon = document.getElementById(`service-icon-${id}`).value
        item.description = document.getElementById(`service-description-${id}`).value

        loadServices()
        showMessage("Service saved successfully!")
        saveToLocalStorage()
    }

    function deleteService(id) {
        if (confirm("Are you sure you want to delete this service?")) {
            portfolioData.services = portfolioData.services.filter((item) => item.id !== id)
            loadServices()
            showMessage("Service deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Portfolio Functions
    function loadPortfolio() {
        const container = document.getElementById("portfolio-list")
        container.innerHTML = ""

        if (portfolioData.portfolio.length === 0) {
            container.innerHTML = `
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-folder-open text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No portfolio projects yet</p>
                        <p class="text-sm">Click "Add Project" to showcase your work</p>
                    </div>
                `
            return
        }

        portfolioData.portfolio.forEach((item) => {
            const categoryColors = {
                'Design': 'bg-purple-100 text-purple-800',
                'Development': 'bg-blue-100 text-blue-800',
                'Marketing': 'bg-green-100 text-green-800'
            }

            const portfolioHTML = `
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300" id="portfolio-${item.id}">
                        <div class="relative">
                            ${item.image ?
                `<img src="${item.image}" alt="${item.title}" class="w-full h-48 object-cover">` :
                `<div class="w-full h-48 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>`
            }
                            <div class="absolute top-3 right-3 flex gap-2">
                                <button class="bg-white bg-opacity-90 hover:bg-opacity-100 text-yellow-600 p-2 rounded-lg shadow-sm transition-all duration-200" onclick="editPortfolio('${item.id}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="bg-white bg-opacity-90 hover:bg-opacity-100 text-red-600 p-2 rounded-lg shadow-sm transition-all duration-200" onclick="deletePortfolio('${item.id}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div id="portfolio-view-${item.id}">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">${item.title || "New Project"}</h3>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ${categoryColors[item.category] || 'bg-gray-100 text-gray-800'}">${item.category}</span>
                                </div>
                                <p class="text-gray-600 leading-relaxed">${item.description}</p>
                            </div>
                            <div id="portfolio-edit-${item.id}" class="hidden space-y-4">
                                <input type="text" placeholder="Project Title" value="${item.title}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" id="portfolio-title-${item.id}">
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" id="portfolio-category-${item.id}">
                                    <option value="Design" ${item.category === "Design" ? "selected" : ""}>Design</option>
                                    <option value="Development" ${item.category === "Development" ? "selected" : ""}>Development</option>
                                    <option value="Marketing" ${item.category === "Marketing" ? "selected" : ""}>Marketing</option>
                                </select>
                                <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer border border-gray-300 rounded-lg" id="portfolio-image-${item.id}">
                                <div id="portfolio-image-preview-${item.id}" class="mt-2">
                                    ${item.image ? `<img src="${item.image}" alt="Preview" class="w-full h-32 object-cover rounded-lg">` : ""}
                                </div>
                                <textarea placeholder="Project Description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" id="portfolio-description-${item.id}">${item.description}</textarea>
                                <div class="flex gap-2">
                                    <button class="bg-pink-600 hover:bg-pink-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="savePortfolio('${item.id}')">
                                        <i class="fas fa-save mr-1"></i>Save
                                    </button>
                                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200" onclick="cancelEditPortfolio('${item.id}')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += portfolioHTML
        })
    }

    function addPortfolio() {
        const newPortfolio = {
            id: generateId(),
            title: "",
            category: "Design",
            image: "",
            description: "",
        }
        portfolioData.portfolio.push(newPortfolio)
        loadPortfolio()
        editPortfolio(newPortfolio.id)
    }

    function editPortfolio(id) {
        document.getElementById(`portfolio-view-${id}`).classList.add("hidden")
        document.getElementById(`portfolio-edit-${id}`).classList.remove("hidden")

        // Add file upload handler
        const fileInput = document.getElementById(`portfolio-image-${id}`)
        fileInput.addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                document.getElementById(`portfolio-image-preview-${id}`).innerHTML = `<img src="${dataUrl}" alt="Preview" class="w-full h-32 object-cover rounded-lg">`
                fileInput.dataset.imageData = dataUrl
            }
        })
    }

    function cancelEditPortfolio(id) {
        document.getElementById(`portfolio-view-${id}`).classList.remove("hidden")
        document.getElementById(`portfolio-edit-${id}`).classList.add("hidden")
    }

    function savePortfolio(id) {
        const item = portfolioData.portfolio.find((portfolio) => portfolio.id === id)
        item.title = document.getElementById(`portfolio-title-${id}`).value
        item.category = document.getElementById(`portfolio-category-${id}`).value
        item.description = document.getElementById(`portfolio-description-${id}`).value

        const fileInput = document.getElementById(`portfolio-image-${id}`)
        if (fileInput.dataset.imageData) {
            item.image = fileInput.dataset.imageData
        }

        loadPortfolio()
        showMessage("Portfolio project saved successfully!")
        saveToLocalStorage()
    }

    function deletePortfolio(id) {
        if (confirm("Are you sure you want to delete this portfolio project?")) {
            portfolioData.portfolio = portfolioData.portfolio.filter((item) => item.id !== id)
            loadPortfolio()
            showMessage("Portfolio project deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Testimonials Functions
    function loadTestimonials() {
        const container = document.getElementById("testimonials-list")
        container.innerHTML = ""

        if (portfolioData.testimonials.length === 0) {
            container.innerHTML = `
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-comments text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No testimonials yet</p>
                        <p class="text-sm">Click "Add Testimonial" to showcase client feedback</p>
                    </div>
                `
            return
        }

        portfolioData.testimonials.forEach((item) => {
            const testimonialHTML = `
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="testimonial-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-gray-900">${item.name || "New Testimonial"}</h3>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="editTestimonial('${item.id}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="deleteTestimonial('${item.id}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                        <div id="testimonial-view-${item.id}">
                            <div class="flex items-start space-x-4 mb-4">
                                ${item.image ?
                `<img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-full object-cover border-2 border-yellow-200">` :
                `<div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center border-2 border-yellow-200">
                                        <i class="fas fa-user text-yellow-600 text-xl"></i>
                                    </div>`
            }
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">${item.name}</h4>
                                    <p class="text-sm text-yellow-600 font-medium">${item.profession}</p>
                                </div>
                            </div>
                            <blockquote class="text-gray-700 italic leading-relaxed border-l-4 border-yellow-300 pl-4">
                                "${item.message}"
                            </blockquote>
                        </div>
                        <div id="testimonial-edit-${item.id}" class="hidden space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" placeholder="Client Name" value="${item.name}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" id="testimonial-name-${item.id}">
                                <input type="text" placeholder="Profession/Company" value="${item.profession}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" id="testimonial-profession-${item.id}">
                            </div>
                            <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 cursor-pointer border border-gray-300 rounded-lg" id="testimonial-image-${item.id}">
                            <div id="testimonial-image-preview-${item.id}" class="mt-2">
                                ${item.image ? `<img src="${item.image}" alt="Preview" class="w-16 h-16 rounded-full object-cover">` : ""}
                            </div>
                            <textarea placeholder="Testimonial Message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" id="testimonial-message-${item.id}">${item.message}</textarea>
                            <div class="flex gap-2">
                                <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="saveTestimonial('${item.id}')">
                                    <i class="fas fa-save mr-1"></i>Save
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200" onclick="cancelEditTestimonial('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += testimonialHTML
        })
    }

    function addTestimonial() {
        const newTestimonial = {
            id: generateId(),
            name: "",
            profession: "",
            message: "",
            image: "",
        }
        portfolioData.testimonials.push(newTestimonial)
        loadTestimonials()
        editTestimonial(newTestimonial.id)
    }

    function editTestimonial(id) {
        document.getElementById(`testimonial-view-${id}`).classList.add("hidden")
        document.getElementById(`testimonial-edit-${id}`).classList.remove("hidden")

        // Add file upload handler
        const fileInput = document.getElementById(`testimonial-image-${id}`)
        fileInput.addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                document.getElementById(`testimonial-image-preview-${id}`).innerHTML = `<img src="${dataUrl}" alt="Preview" class="w-16 h-16 rounded-full object-cover">`
                fileInput.dataset.imageData = dataUrl
            }
        })
    }

    function cancelEditTestimonial(id) {
        document.getElementById(`testimonial-view-${id}`).classList.remove("hidden")
        document.getElementById(`testimonial-edit-${id}`).classList.add("hidden")
    }

    function saveTestimonial(id) {
        const item = portfolioData.testimonials.find((testimonial) => testimonial.id === id)
        item.name = document.getElementById(`testimonial-name-${id}`).value
        item.profession = document.getElementById(`testimonial-profession-${id}`).value
        item.message = document.getElementById(`testimonial-message-${id}`).value

        const fileInput = document.getElementById(`testimonial-image-${id}`)
        if (fileInput.dataset.imageData) {
            item.image = fileInput.dataset.imageData
        }

        loadTestimonials()
        showMessage("Testimonial saved successfully!")
        saveToLocalStorage()
    }

    function deleteTestimonial(id) {
        if (confirm("Are you sure you want to delete this testimonial?")) {
            portfolioData.testimonials = portfolioData.testimonials.filter((item) => item.id !== id)
            loadTestimonials()
            showMessage("Testimonial deleted successfully!")
            saveToLocalStorage()
        }
    }

    // Blog Functions
    function loadBlog() {
        const container = document.getElementById("blog-list")
        container.innerHTML = ""

        if (portfolioData.blog.length === 0) {
            container.innerHTML = `
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-blog text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No blog posts yet</p>
                        <p class="text-sm">Click "Add Blog Post" to start sharing your thoughts</p>
                    </div>
                `
            return
        }

        portfolioData.blog.forEach((item) => {
            const blogHTML = `
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300" id="blog-${item.id}">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-gray-900">${item.title || "New Blog Post"}</h3>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="editBlog('${item.id}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="deleteBlog('${item.id}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                        <div id="blog-view-${item.id}">
                            <div class="flex items-start space-x-4">
                                ${item.image ?
                `<img src="${item.image}" alt="${item.title}" class="w-24 h-20 object-cover rounded-lg border-2 border-red-200">` :
                `<div class="w-24 h-20 bg-red-100 rounded-lg flex items-center justify-center border-2 border-red-200">
                                        <i class="fas fa-image text-red-400 text-xl"></i>
                                    </div>`
            }
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-calendar text-red-600"></i>
                                        <span class="text-sm text-red-600 font-medium">${item.date}</span>
                                    </div>
                                    <p class="text-gray-600 leading-relaxed">${item.excerpt}</p>
                                </div>
                            </div>
                        </div>
                        <div id="blog-edit-${item.id}" class="hidden space-y-4">
                            <input type="text" placeholder="Blog Title" value="${item.title}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" id="blog-title-${item.id}">
                            <input type="date" value="${item.date}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" id="blog-date-${item.id}">
                            <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer border border-gray-300 rounded-lg" id="blog-image-${item.id}">
                            <div id="blog-image-preview-${item.id}" class="mt-2">
                                ${item.image ? `<img src="${item.image}" alt="Preview" class="w-24 h-20 object-cover rounded-lg">` : ""}
                            </div>
                            <textarea placeholder="Excerpt/Summary" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" id="blog-excerpt-${item.id}">${item.excerpt}</textarea>
                            <textarea placeholder="Full Content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" id="blog-content-${item.id}">${item.content}</textarea>
                            <div class="flex gap-2">
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center" onclick="saveBlog('${item.id}')">
                                    <i class="fas fa-save mr-1"></i>Save
                                </button>
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200" onclick="cancelEditBlog('${item.id}')">Cancel</button>
                            </div>
                        </div>
                    </div>
                `
            container.innerHTML += blogHTML
        })
    }

    function addBlog() {
        const newBlog = {
            id: generateId(),
            title: "",
            date: new Date().toISOString().split("T")[0],
            image: "",
            excerpt: "",
            content: "",
        }
        portfolioData.blog.push(newBlog)
        loadBlog()
        editBlog(newBlog.id)
    }

    function editBlog(id) {
        document.getElementById(`blog-view-${id}`).classList.add("hidden")
        document.getElementById(`blog-edit-${id}`).classList.remove("hidden")

        // Add file upload handler
        const fileInput = document.getElementById(`blog-image-${id}`)
        fileInput.addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                document.getElementById(`blog-image-preview-${id}`).innerHTML = `<img src="${dataUrl}" alt="Preview" class="w-24 h-20 object-cover rounded-lg">`
                fileInput.dataset.imageData = dataUrl
            }
        })
    }

    function cancelEditBlog(id) {
        document.getElementById(`blog-view-${id}`).classList.remove("hidden")
        document.getElementById(`blog-edit-${id}`).classList.add("hidden")
    }

    function saveBlog(id) {
        const item = portfolioData.blog.find((blog) => blog.id === id)
        item.title = document.getElementById(`blog-title-${id}`).value
        item.date = document.getElementById(`blog-date-${id}`).value
        item.excerpt = document.getElementById(`blog-excerpt-${id}`).value
        item.content = document.getElementById(`blog-content-${id}`).value

        const fileInput = document.getElementById(`blog-image-${id}`)
        if (fileInput.dataset.imageData) {
            item.image = fileInput.dataset.imageData
        }

        loadBlog()
        showMessage("Blog post saved successfully!")
        saveToLocalStorage()
    }

    function deleteBlog(id) {
        if (confirm("Are you sure you want to delete this blog post?")) {
            portfolioData.blog = portfolioData.blog.filter((item) => item.id !== id)
            loadBlog()
            showMessage("Blog post deleted successfully!")
            saveToLocalStorage()
        }
    }

    // File Upload Handlers
    function setupFileUploads() {
        // Profile image upload
        document.getElementById("profile-image").addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                portfolioData.profile.image = dataUrl
                document.getElementById("profile-image-preview").innerHTML =
                    `<div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <img src="${dataUrl}" alt="Profile" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                            <div class="text-sm text-gray-600">Profile image uploaded successfully</div>
                        </div>`
            }
        })

        // Profile CV upload
        document.getElementById("profile-cv").addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                portfolioData.profile.cv = dataUrl
                document.getElementById("profile-cv-preview").innerHTML =
                    `<div class="flex items-center space-x-2 p-2 bg-green-50 rounded-lg text-sm text-green-700">
                            <i class="fas fa-file-pdf"></i>
                            <span>CV file uploaded: ${file.name}</span>
                        </div>`
            }
        })

        // About image upload
        document.getElementById("about-image").addEventListener("change", async (e) => {
            const file = e.target.files[0]
            if (file) {
                const dataUrl = await handleFileUpload(file)
                portfolioData.about.image = dataUrl
                document.getElementById("about-image-preview").innerHTML =
                    `<div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <img src="${dataUrl}" alt="About" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                            <div class="text-sm text-gray-600">About section image uploaded successfully</div>
                        </div>`
            }
        })
    }

    // Data Management Functions
    function saveToLocalStorage() {
        localStorage.setItem("portfolioData", JSON.stringify(portfolioData))
    }

    function loadFromLocalStorage() {
        const savedData = localStorage.getItem("portfolioData")
        if (savedData) {
            try {
                portfolioData = JSON.parse(savedData)
            } catch (error) {
                console.log("Error loading saved data:", error)
                showMessage("Error loading saved data", "error")
            }
        }
    }

    function exportData() {
        const dataStr = JSON.stringify(portfolioData, null, 2)
        const dataBlob = new Blob([dataStr], { type: "application/json" })
        const url = URL.createObjectURL(dataBlob)
        const link = document.createElement("a")
        link.href = url
        link.download = `portfolio-data-${new Date().toISOString().split('T')[0]}.json`
        link.click()
        URL.revokeObjectURL(url)
        showMessage("Portfolio data exported successfully!")
    }

    function importData() {
        const input = document.createElement("input")
        input.type = "file"
        input.accept = ".json"
        input.onchange = (e) => {
            const file = e.target.files[0]
            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    try {
                        const importedData = JSON.parse(e.target.result)
                        portfolioData = importedData
                        initializeApp()
                        showMessage("Portfolio data imported successfully!")
                    } catch (error) {
                        showMessage("Error importing data: Invalid JSON file", "error")
                    }
                }
                reader.readAsText(file)
            }
        }
        input.click()
    }

    // Initialize Application
    function initializeApp() {
        loadFromLocalStorage()
        initializeTabs()
        setupFileUploads()
        loadProfile()
        loadAbout()
        loadEducation()
        loadExperience()
        loadSkills()
        loadServices()
        loadPortfolio()
        loadTestimonials()
        loadBlog()

        showMessage("FreeFolio Admin Panel loaded successfully!")
    }

    // Auto-save functionality
    setInterval(() => {
        saveToLocalStorage()
    }, 30000) // Auto-save every 30 seconds

    // Initialize when DOM is loaded
    document.addEventListener("DOMContentLoaded", initializeApp)

    // Add tab button styling
    document.addEventListener("DOMContentLoaded", function() {
        const style = document.createElement('style')
        style.textContent = `
                .tab-btn {
                    @apply whitespace-nowrap py-3 px-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-lg transition-all duration-200 flex items-center;
                }
                .tab-btn.active {
                    @apply bg-blue-100 text-blue-700 border-b-2 border-blue-500;
                }
            `
        document.head.appendChild(style)
    })
</script>
</body>
</html>
</x-app-layout>
