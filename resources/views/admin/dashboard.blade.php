<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FreeFolio Admin Panel</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            /* Tab Navigation */
            .tab-btn {
                white-space: nowrap;
                padding: 0.5rem 0.25rem;
                border-bottom: 2px solid transparent;
                font-weight: 500;
                font-size: 0.875rem;
                color: #6b7280;
                transition: all 0.2s;
                cursor: pointer;
                background: none;
                border-top: none;
                border-left: none;
                border-right: none;
            }

            .tab-btn:hover {
                color: #374151;
                border-bottom-color: #d1d5db;
            }

            .tab-btn.active {
                border-bottom-color: #3b82f6;
                color: #3b82f6;
            }

            /* Tab Content */
            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
            }

            /* Form Elements */
            .input-field {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                transition: all 0.2s;
            }

            .input-field:focus {
                outline: none;
                ring: 2px;
                ring-color: #3b82f6;
                border-color: #3b82f6;
            }

            .input-field.error {
                border-color: #dc2626;
                background-color: #fef2f2;
            }

            .input-field.success {
                border-color: #16a34a;
                background-color: #f0fdf4;
            }

            /* Buttons */
            .btn-primary {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border: 1px solid transparent;
                font-size: 0.875rem;
                font-weight: 500;
                border-radius: 0.375rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                color: white;
                background-color: #3b82f6;
                cursor: pointer;
                transition: all 0.2s;
                margin-right: 0.5rem;
            }

            .btn-primary:hover {
                background-color: #2563eb;
            }

            .btn-secondary {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border: 1px solid #d1d5db;
                font-size: 0.875rem;
                font-weight: 500;
                border-radius: 0.375rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                color: #374151;
                background-color: white;
                cursor: pointer;
                transition: all 0.2s;
                margin-right: 0.5rem;
            }

            .btn-secondary:hover {
                background-color: #f9fafb;
            }

            .btn-success {
                display: inline-flex;
                align-items: center;
                padding: 0.375rem 0.75rem;
                border: 1px solid transparent;
                font-size: 0.75rem;
                font-weight: 500;
                border-radius: 0.25rem;
                color: white;
                background-color: #16a34a;
                cursor: pointer;
                transition: all 0.2s;
                margin-right: 0.5rem;
            }

            .btn-success:hover {
                background-color: #15803d;
            }

            .btn-danger {
                display: inline-flex;
                align-items: center;
                padding: 0.375rem 0.75rem;
                border: 1px solid transparent;
                font-size: 0.75rem;
                font-weight: 500;
                border-radius: 0.25rem;
                color: white;
                background-color: #dc2626;
                cursor: pointer;
                transition: all 0.2s;
            }

            .btn-danger:hover {
                background-color: #b91c1c;
            }

            /* File Upload */
            .file-input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .file-preview img {
                width: 5rem;
                height: 5rem;
                object-fit: cover;
                border-radius: 0.25rem;
                border: 1px solid #d1d5db;
            }

            /* Dynamic Items */
            .dynamic-item {
                background-color: #f9fafb;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-bottom: 1rem;
            }

            /* Skills Progress Bar */
            .skill-progress {
                width: 100%;
                background-color: #e5e7eb;
                border-radius: 9999px;
                height: 0.5rem;
            }

            .skill-progress-bar {
                background-color: #3b82f6;
                height: 0.5rem;
                border-radius: 9999px;
                transition: all 0.3s;
            }

            /* Messages */
            .message {
                padding: 1rem;
                border-radius: 0.375rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                font-size: 0.875rem;
                font-weight: 500;
                transition: all 0.3s;
                margin-bottom: 0.5rem;
            }

            .message.success {
                background-color: #dcfce7;
                border: 1px solid #86efac;
                color: #166534;
            }

            .message.error {
                background-color: #fef2f2;
                border: 1px solid #fca5a5;
                color: #991b1b;
            }

            .message.warning {
                background-color: #fefce8;
                border: 1px solid #fde047;
                color: #a16207;
            }

            /* Validation Error Text */
            .error-text {
                color: #dc2626;
                font-size: 0.75rem;
                margin-top: 0.25rem;
            }

            /* Animation */
            .fade-in {
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Responsive */
            @media (max-width: 768px) {
                .tab-btn {
                    font-size: 0.75rem;
                    padding: 0.5rem;
                }
            }
        </style>
    </head>
    <body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <i class="fas fa-cog text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-900">Portfolio Admin Panel</h1>
                </div>
                <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">
                    FreeFolio Management
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Tab Navigation -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 overflow-x-auto">
                    <button class="tab-btn active" onclick="switchTab('profile')">
                        <i class="fas fa-user mr-2"></i>Profile
                    </button>
                    <button class="tab-btn" onclick="switchTab('about')">
                        <i class="fas fa-info-circle mr-2"></i>About
                    </button>
                    <button class="tab-btn" onclick="switchTab('education')">
                        <i class="fas fa-graduation-cap mr-2"></i>Education
                    </button>
                    <button class="tab-btn" onclick="switchTab('experience')">
                        <i class="fas fa-briefcase mr-2"></i>Experience
                    </button>
                    <button class="tab-btn" onclick="switchTab('skills')">
                        <i class="fas fa-code mr-2"></i>Skills
                    </button>
                    <button class="tab-btn" onclick="switchTab('services')">
                        <i class="fas fa-cogs mr-2"></i>Services
                    </button>
                    <button class="tab-btn" onclick="switchTab('portfolio')">
                        <i class="fas fa-folder-open mr-2"></i>Portfolio
                    </button>
                    <button class="tab-btn" onclick="switchTab('testimonials')">
                        <i class="fas fa-comments mr-2"></i>Reviews
                    </button>
                    <button class="tab-btn" onclick="switchTab('blog')">
                        <i class="fas fa-blog mr-2"></i>Blog
                    </button>
                </nav>
            </div>
        </div>

        <!-- Profile Tab -->
        <div id="profile-tab" class="tab-content active">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <h2 class="text-xl font-semibold mb-6">Profile Information</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" id="profile-name" class="input-field" placeholder="Full Name" required>
                            <div class="error-text" id="profile-name-error"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                            <input type="file" id="profile-image" accept="image/*" class="file-input">
                            <div class="file-preview mt-2" id="profile-image-preview"></div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Professional Titles *</label>
                        <input type="text" id="profile-title" class="input-field" placeholder="Web Designer, Developer, etc." required>
                        <div class="error-text" id="profile-title-error"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="profile-description" rows="3" class="input-field" placeholder="Brief description about yourself" required></textarea>
                        <div class="error-text" id="profile-description-error"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CV File</label>
                            <input type="file" id="profile-cv" accept=".pdf,.doc,.docx" class="file-input">
                            <div class="file-preview mt-2" id="profile-cv-preview"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                            <input type="url" id="profile-video" class="input-field" placeholder="YouTube embed URL">
                        </div>
                    </div>
                    <button class="btn-primary" onclick="saveProfile()">
                        <i class="fas fa-save mr-2"></i>Save Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- About Tab -->
        <div id="about-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <h2 class="text-xl font-semibold mb-6">About Information</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" id="about-name" class="input-field" required>
                            <div class="error-text" id="about-name-error"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Birthday</label>
                            <input type="text" id="about-birthday" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                            <input type="text" id="about-degree" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                            <input type="text" id="about-experience" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                            <input type="tel" id="about-phone" class="input-field" required>
                            <div class="error-text" id="about-phone-error"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="about-email" class="input-field" required>
                            <div class="error-text" id="about-email-error"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" id="about-address" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Freelance Status</label>
                            <select id="about-freelance" class="input-field">
                                <option value="Available">Available</option>
                                <option value="Busy">Busy</option>
                                <option value="Not Available">Not Available</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="about-description" rows="4" class="input-field" required></textarea>
                        <div class="error-text" id="about-description-error"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">About Image</label>
                        <input type="file" id="about-image" accept="image/*" class="file-input">
                        <div class="file-preview mt-2" id="about-image-preview"></div>
                    </div>
                    <button class="btn-primary" onclick="saveAbout()">
                        <i class="fas fa-save mr-2"></i>Save About Info
                    </button>
                </div>
            </div>
        </div>

        <!-- Education Tab -->
        <div id="education-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Education</h2>
                    <button class="btn-secondary" onclick="addEducation()">
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Work Experience</h2>
                    <button class="btn-secondary" onclick="addExperience()">
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Skills</h2>
                    <button class="btn-secondary" onclick="addSkill()">
                        <i class="fas fa-plus mr-2"></i>Add Skill
                    </button>
                </div>
                <div id="skills-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Skills will be dynamically added here -->
                </div>
            </div>
        </div>

        <!-- Services Tab -->
        <div id="services-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Services</h2>
                    <button class="btn-secondary" onclick="addService()">
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Portfolio</h2>
                    <button class="btn-secondary" onclick="addPortfolio()">
                        <i class="fas fa-plus mr-2"></i>Add Portfolio Item
                    </button>
                </div>
                <div id="portfolio-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Portfolio items will be dynamically added here -->
                </div>
            </div>
        </div>

        <!-- Testimonials Tab -->
        <div id="testimonials-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Testimonials</h2>
                    <button class="btn-secondary" onclick="addTestimonial()">
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Blog Posts</h2>
                    <button class="btn-secondary" onclick="addBlog()">
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
    <div id="message-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        // Global Data Storage
        let portfolioData = {
            profile: {
                name: "",
                title: "",
                description: "",
                image: "",
                cv: "",
                video: "",
            },
            about: {
                name: "",
                birthday: "",
                degree: "",
                experience: "",
                phone: "",
                email: "",
                address: "",
                freelance: "Available",
                description: "",
                image: "",
            },
            education: [],
            experience: [],
            skills: [],
            services: [],
            portfolio: [],
            testimonials: [],
            blog: [],
        }

        // Initialize the application
        document.addEventListener("DOMContentLoaded", function() {
            console.log("DOM loaded, initializing...");
            loadData();
            setupFileUploads();
        });

        // Validation Functions
        function validateField(fieldId, fieldName, isRequired = false) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(fieldId + '-error');

            if (!field) return true;

            const value = field.value.trim();

            // Clear previous error
            field.classList.remove('error', 'success');
            if (errorElement) errorElement.textContent = '';

            if (isRequired && !value) {
                field.classList.add('error');
                if (errorElement) errorElement.textContent = `${fieldName} majburiy maydon`;
                return false;
            }

            // Email validation
            if (fieldId.includes('email') && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    field.classList.add('error');
                    if (errorElement) errorElement.textContent = 'Email formati noto\'g\'ri';
                    return false;
                }
            }

            // Phone validation
            if (fieldId.includes('phone') && value) {
                const phoneRegex = /^[\+]?[0-9\s\-$$$$]{10,}$/;
                if (!phoneRegex.test(value)) {
                    field.classList.add('error');
                    if (errorElement) errorElement.textContent = 'Telefon raqami noto\'g\'ri';
                    return false;
                }
            }

            if (value) {
                field.classList.add('success');
            }

            return true;
        }

        function validateItemFields(item, requiredFields) {
            let isValid = true;
            const errors = [];

            requiredFields.forEach(field => {
                if (!item[field] || item[field].trim() === '') {
                    isValid = false;
                    errors.push(field);
                }
            });

            return { isValid, errors };
        }

        // Tab Management
        function switchTab(tabName) {
            console.log("Switching to tab:", tabName);

            // Remove active class from all buttons and contents
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content");

            tabButtons.forEach(btn => btn.classList.remove("active"));
            tabContents.forEach(content => content.classList.remove("active"));

            // Add active class to clicked button and corresponding content
            event.target.classList.add("active");
            const targetTab = document.getElementById(tabName + "-tab");
            if (targetTab) {
                targetTab.classList.add("active");
            }
        }

        // Data Management
        function loadData() {
            const savedData = localStorage.getItem("freefolio-data");
            if (savedData) {
                try {
                    portfolioData = JSON.parse(savedData);
                    populateFields();
                    renderDynamicSections();
                } catch (e) {
                    console.error("Error loading data:", e);
                }
            }
        }

        function saveData() {
            localStorage.setItem("freefolio-data", JSON.stringify(portfolioData));
        }

        function populateFields() {
            // Profile fields
            const profileName = document.getElementById("profile-name");
            const profileTitle = document.getElementById("profile-title");
            const profileDescription = document.getElementById("profile-description");
            const profileVideo = document.getElementById("profile-video");

            if (profileName) profileName.value = portfolioData.profile.name || "";
            if (profileTitle) profileTitle.value = portfolioData.profile.title || "";
            if (profileDescription) profileDescription.value = portfolioData.profile.description || "";
            if (profileVideo) profileVideo.value = portfolioData.profile.video || "";

            // About fields
            const aboutName = document.getElementById("about-name");
            const aboutBirthday = document.getElementById("about-birthday");
            const aboutDegree = document.getElementById("about-degree");
            const aboutExperience = document.getElementById("about-experience");
            const aboutPhone = document.getElementById("about-phone");
            const aboutEmail = document.getElementById("about-email");
            const aboutAddress = document.getElementById("about-address");
            const aboutFreelance = document.getElementById("about-freelance");
            const aboutDescription = document.getElementById("about-description");

            if (aboutName) aboutName.value = portfolioData.about.name || "";
            if (aboutBirthday) aboutBirthday.value = portfolioData.about.birthday || "";
            if (aboutDegree) aboutDegree.value = portfolioData.about.degree || "";
            if (aboutExperience) aboutExperience.value = portfolioData.about.experience || "";
            if (aboutPhone) aboutPhone.value = portfolioData.about.phone || "";
            if (aboutEmail) aboutEmail.value = portfolioData.about.email || "";
            if (aboutAddress) aboutAddress.value = portfolioData.about.address || "";
            if (aboutFreelance) aboutFreelance.value = portfolioData.about.freelance || "Available";
            if (aboutDescription) aboutDescription.value = portfolioData.about.description || "";

            // Show image previews
            if (portfolioData.profile.image) {
                showImagePreview("profile-image-preview", portfolioData.profile.image);
            }
            if (portfolioData.about.image) {
                showImagePreview("about-image-preview", portfolioData.about.image);
            }
        }

        // File Upload Management
        function setupFileUploads() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener("change", handleFileUpload);
            });
        }

        function handleFileUpload(event) {
            const file = event.target.files[0];
            const inputId = event.target.id;

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const result = e.target.result;

                    // Store in data object
                    if (inputId === "profile-image") {
                        portfolioData.profile.image = result;
                        showImagePreview("profile-image-preview", result);
                    } else if (inputId === "about-image") {
                        portfolioData.about.image = result;
                        showImagePreview("about-image-preview", result);
                    } else if (inputId === "profile-cv") {
                        portfolioData.profile.cv = result;
                        showFilePreview("profile-cv-preview", file.name);
                    }

                    saveData();
                };
                reader.readAsDataURL(file);
            }
        }

        function showImagePreview(containerId, imageSrc) {
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-20 h-20 object-cover rounded border">`;
            }
        }

        function showFilePreview(containerId, fileName) {
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = `<div class="text-sm text-gray-600 mt-2"><i class="fas fa-file mr-2"></i>${fileName}</div>`;
            }
        }

        // Profile Management with Validation
        function saveProfile() {
            // Validate required fields
            const nameValid = validateField('profile-name', 'Ism', true);
            const titleValid = validateField('profile-title', 'Kasb nomi', true);
            const descriptionValid = validateField('profile-description', 'Tavsif', true);

            if (!nameValid || !titleValid || !descriptionValid) {
                showMessage("Iltimos, barcha majburiy maydonlarni to'ldiring!", "error");
                return;
            }

            const profileName = document.getElementById("profile-name");
            const profileTitle = document.getElementById("profile-title");
            const profileDescription = document.getElementById("profile-description");
            const profileVideo = document.getElementById("profile-video");

            portfolioData.profile.name = profileName ? profileName.value : "";
            portfolioData.profile.title = profileTitle ? profileTitle.value : "";
            portfolioData.profile.description = profileDescription ? profileDescription.value : "";
            portfolioData.profile.video = profileVideo ? profileVideo.value : "";

            saveData();
            showMessage("Profil muvaffaqiyatli saqlandi!", "success");
        }

        // About Management with Validation
        function saveAbout() {
            // Validate required fields
            const nameValid = validateField('about-name', 'Ism', true);
            const phoneValid = validateField('about-phone', 'Telefon', true);
            const emailValid = validateField('about-email', 'Email', true);
            const descriptionValid = validateField('about-description', 'Tavsif', true);

            if (!nameValid || !phoneValid || !emailValid || !descriptionValid) {
                showMessage("Iltimos, barcha majburiy maydonlarni to'g'ri to'ldiring!", "error");
                return;
            }

            const aboutName = document.getElementById("about-name");
            const aboutBirthday = document.getElementById("about-birthday");
            const aboutDegree = document.getElementById("about-degree");
            const aboutExperience = document.getElementById("about-experience");
            const aboutPhone = document.getElementById("about-phone");
            const aboutEmail = document.getElementById("about-email");
            const aboutAddress = document.getElementById("about-address");
            const aboutFreelance = document.getElementById("about-freelance");
            const aboutDescription = document.getElementById("about-description");

            portfolioData.about.name = aboutName ? aboutName.value : "";
            portfolioData.about.birthday = aboutBirthday ? aboutBirthday.value : "";
            portfolioData.about.degree = aboutDegree ? aboutDegree.value : "";
            portfolioData.about.experience = aboutExperience ? aboutExperience.value : "";
            portfolioData.about.phone = aboutPhone ? aboutPhone.value : "";
            portfolioData.about.email = aboutEmail ? aboutEmail.value : "";
            portfolioData.about.address = aboutAddress ? aboutAddress.value : "";
            portfolioData.about.freelance = aboutFreelance ? aboutFreelance.value : "Available";
            portfolioData.about.description = aboutDescription ? aboutDescription.value : "";

            saveData();
            showMessage("Ma'lumotlar muvaffaqiyatli saqlandi!", "success");
        }

        // Education Management
        function addEducation() {
            const newEducation = {
                id: Date.now().toString(),
                degree: "",
                institution: "",
                year: "",
                description: "",
            };

            portfolioData.education.push(newEducation);
            renderEducation();
            saveData();
        }

        function renderEducation() {
            const container = document.getElementById("education-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.education.forEach(item => {
                const educationHTML = `
                <div class="dynamic-item fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Degree *</label>
                            <input type="text" value="${item.degree}" onchange="updateEducation('${item.id}', 'degree', this.value)" class="input-field" placeholder="Bachelor's Degree">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institution *</label>
                            <input type="text" value="${item.institution}" onchange="updateEducation('${item.id}', 'institution', this.value)" class="input-field" placeholder="University Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year *</label>
                            <input type="text" value="${item.year}" onchange="updateEducation('${item.id}', 'year', this.value)" class="input-field" placeholder="2020-2024">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea onchange="updateEducation('${item.id}', 'description', this.value)" rows="2" class="input-field" placeholder="Description of your education">${item.description}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="saveEducationItem('${item.id}')" class="btn-success">
                            <i class="fas fa-save mr-2"></i>Save
                        </button>
                        <button onclick="removeEducation('${item.id}')" class="btn-danger">
                            <i class="fas fa-trash mr-2"></i>Remove
                        </button>
                    </div>
                </div>
            `;
                container.innerHTML += educationHTML;
            });
        }

        function saveEducationItem(id) {
            const item = portfolioData.education.find(edu => edu.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['degree', 'institution', 'year']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Ta'lim ma'lumoti saqlandi!", "success");
        }

        function updateEducation(id, field, value) {
            const item = portfolioData.education.find(edu => edu.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removeEducation(id) {
            portfolioData.education = portfolioData.education.filter(item => item.id !== id);
            renderEducation();
            saveData();
            showMessage("Ta'lim ma'lumoti o'chirildi!", "success");
        }

        // Experience Management
        function addExperience() {
            const newExperience = {
                id: Date.now().toString(),
                position: "",
                company: "",
                duration: "",
                description: "",
            };

            portfolioData.experience.push(newExperience);
            renderExperience();
            saveData();
        }

        function renderExperience() {
            const container = document.getElementById("experience-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.experience.forEach(item => {
                const experienceHTML = `
                <div class="dynamic-item fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Position *</label>
                            <input type="text" value="${item.position}" onchange="updateExperience('${item.id}', 'position', this.value)" class="input-field" placeholder="Frontend Developer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                            <input type="text" value="${item.company}" onchange="updateExperience('${item.id}', 'company', this.value)" class="input-field" placeholder="Company Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                            <input type="text" value="${item.duration}" onchange="updateExperience('${item.id}', 'duration', this.value)" class="input-field" placeholder="2022-2024">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea onchange="updateExperience('${item.id}', 'description', this.value)" rows="2" class="input-field" placeholder="Description of your work experience">${item.description}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="saveExperienceItem('${item.id}')" class="btn-success">
                            <i class="fas fa-save mr-2"></i>Save
                        </button>
                        <button onclick="removeExperience('${item.id}')" class="btn-danger">
                            <i class="fas fa-trash mr-2"></i>Remove
                        </button>
                    </div>
                </div>
            `;
                container.innerHTML += experienceHTML;
            });
        }

        function saveExperienceItem(id) {
            const item = portfolioData.experience.find(exp => exp.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['position', 'company', 'duration']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Ish tajribasi saqlandi!", "success");
        }

        function updateExperience(id, field, value) {
            const item = portfolioData.experience.find(exp => exp.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removeExperience(id) {
            portfolioData.experience = portfolioData.experience.filter(item => item.id !== id);
            renderExperience();
            saveData();
            showMessage("Ish tajribasi o'chirildi!", "success");
        }

        // Skills Management
        function addSkill() {
            const newSkill = {
                id: Date.now().toString(),
                name: "",
                level: 50,
            };

            portfolioData.skills.push(newSkill);
            renderSkills();
            saveData();
        }

        function renderSkills() {
            const container = document.getElementById("skills-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.skills.forEach(item => {
                const skillHTML = `
                <div class="dynamic-item fade-in">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name *</label>
                            <input type="text" value="${item.name}" onchange="updateSkill('${item.id}', 'name', this.value)" class="input-field" placeholder="JavaScript">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Level (${item.level}%)</label>
                            <input type="range" min="0" max="100" value="${item.level}" onchange="updateSkill('${item.id}', 'level', this.value)" class="w-full">
                            <div class="skill-progress mt-2">
                                <div class="skill-progress-bar" style="width: ${item.level}%"></div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="saveSkillItem('${item.id}')" class="btn-success">
                                <i class="fas fa-save mr-2"></i>Save
                            </button>
                            <button onclick="removeSkill('${item.id}')" class="btn-danger">
                                <i class="fas fa-trash mr-2"></i>Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;
                container.innerHTML += skillHTML;
            });
        }

        function saveSkillItem(id) {
            const item = portfolioData.skills.find(skill => skill.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['name']);
            if (!validation.isValid) {
                showMessage("Ko'nikma nomini kiriting!", "error");
                return;
            }

            saveData();
            showMessage("Ko'nikma saqlandi!", "success");
        }

        function updateSkill(id, field, value) {
            const item = portfolioData.skills.find(skill => skill.id === id);
            if (item) {
                item[field] = field === "level" ? parseInt(value) : value;
                renderSkills(); // Re-render to update progress bar
            }
        }

        function removeSkill(id) {
            portfolioData.skills = portfolioData.skills.filter(item => item.id !== id);
            renderSkills();
            saveData();
            showMessage("Ko'nikma o'chirildi!", "success");
        }

        // Services Management
        function addService() {
            const newService = {
                id: Date.now().toString(),
                title: "",
                description: "",
                icon: "code",
            };

            portfolioData.services.push(newService);
            renderServices();
            saveData();
        }

        function renderServices() {
            const container = document.getElementById("services-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.services.forEach(item => {
                const serviceHTML = `
                <div class="dynamic-item fade-in">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Title *</label>
                            <input type="text" value="${item.title}" onchange="updateService('${item.id}', 'title', this.value)" class="input-field" placeholder="Web Development">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                            <textarea onchange="updateService('${item.id}', 'description', this.value)" rows="3" class="input-field" placeholder="Service description">${item.description}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                            <input type="text" value="${item.icon}" onchange="updateService('${item.id}', 'icon', this.value)" class="input-field" placeholder="code">
                        </div>
                        <div class="flex gap-2">
                            <button onclick="saveServiceItem('${item.id}')" class="btn-success">
                                <i class="fas fa-save mr-2"></i>Save
                            </button>
                            <button onclick="removeService('${item.id}')" class="btn-danger">
                                <i class="fas fa-trash mr-2"></i>Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;
                container.innerHTML += serviceHTML;
            });
        }

        function saveServiceItem(id) {
            const item = portfolioData.services.find(service => service.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['title', 'description']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Xizmat saqlandi!", "success");
        }

        function updateService(id, field, value) {
            const item = portfolioData.services.find(service => service.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removeService(id) {
            portfolioData.services = portfolioData.services.filter(item => item.id !== id);
            renderServices();
            saveData();
            showMessage("Xizmat o'chirildi!", "success");
        }

        // Portfolio Management
        function addPortfolio() {
            const newPortfolio = {
                id: Date.now().toString(),
                title: "",
                description: "",
                image: "",
                url: "",
                category: "",
            };

            portfolioData.portfolio.push(newPortfolio);
            renderPortfolio();
            saveData();
        }

        function renderPortfolio() {
            const container = document.getElementById("portfolio-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.portfolio.forEach(item => {
                const portfolioHTML = `
                <div class="dynamic-item fade-in">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Title *</label>
                            <input type="text" value="${item.title}" onchange="updatePortfolio('${item.id}', 'title', this.value)" class="input-field" placeholder="Project Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                            <textarea onchange="updatePortfolio('${item.id}', 'description', this.value)" rows="2" class="input-field" placeholder="Project description">${item.description}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Image</label>
                            <input type="file" accept="image/*" onchange="handlePortfolioImageUpload(event, '${item.id}')" class="file-input">
                            ${item.image ? `<img src="${item.image}" alt="Portfolio" class="mt-2 w-full h-32 object-cover rounded">` : ""}
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project URL</label>
                            <input type="url" value="${item.url}" onchange="updatePortfolio('${item.id}', 'url', this.value)" class="input-field" placeholder="https://project-url.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <input type="text" value="${item.category}" onchange="updatePortfolio('${item.id}', 'category', this.value)" class="input-field" placeholder="Web Development">
                        </div>
                        <div class="flex gap-2">
                            <button onclick="savePortfolioItem('${item.id}')" class="btn-success">
                                <i class="fas fa-save mr-2"></i>Save
                            </button>
                            <button onclick="removePortfolio('${item.id}')" class="btn-danger">
                                <i class="fas fa-trash mr-2"></i>Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;
                container.innerHTML += portfolioHTML;
            });
        }

        function savePortfolioItem(id) {
            const item = portfolioData.portfolio.find(portfolio => portfolio.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['title', 'description', 'category']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Portfolio loyihasi saqlandi!", "success");
        }

        function handlePortfolioImageUpload(event, id) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    updatePortfolio(id, "image", e.target.result);
                    renderPortfolio();
                };
                reader.readAsDataURL(file);
            }
        }

        function updatePortfolio(id, field, value) {
            const item = portfolioData.portfolio.find(portfolio => portfolio.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removePortfolio(id) {
            portfolioData.portfolio = portfolioData.portfolio.filter(item => item.id !== id);
            renderPortfolio();
            saveData();
            showMessage("Portfolio loyihasi o'chirildi!", "success");
        }

        // Testimonials Management
        function addTestimonial() {
            const newTestimonial = {
                id: Date.now().toString(),
                name: "",
                position: "",
                company: "",
                content: "",
                image: "",
            };

            portfolioData.testimonials.push(newTestimonial);
            renderTestimonials();
            saveData();
        }

        function renderTestimonials() {
            const container = document.getElementById("testimonials-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.testimonials.forEach(item => {
                const testimonialHTML = `
                <div class="dynamic-item fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Client Name *</label>
                            <input type="text" value="${item.name}" onchange="updateTestimonial('${item.id}', 'name', this.value)" class="input-field" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                            <input type="text" value="${item.position}" onchange="updateTestimonial('${item.id}', 'position', this.value)" class="input-field" placeholder="CEO">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                            <input type="text" value="${item.company}" onchange="updateTestimonial('${item.id}', 'company', this.value)" class="input-field" placeholder="Company Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Client Image</label>
                            <input type="file" accept="image/*" onchange="handleTestimonialImageUpload(event, '${item.id}')" class="file-input">
                            ${item.image ? `<img src="${item.image}" alt="Client" class="mt-2 w-16 h-16 object-cover rounded-full">` : ""}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Testimonial Content *</label>
                        <textarea onchange="updateTestimonial('${item.id}', 'content', this.value)" rows="3" class="input-field" placeholder="Client testimonial content">${item.content}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="saveTestimonialItem('${item.id}')" class="btn-success">
                            <i class="fas fa-save mr-2"></i>Save
                        </button>
                        <button onclick="removeTestimonial('${item.id}')" class="btn-danger">
                            <i class="fas fa-trash mr-2"></i>Remove
                        </button>
                    </div>
                </div>
            `;
                container.innerHTML += testimonialHTML;
            });
        }

        function saveTestimonialItem(id) {
            const item = portfolioData.testimonials.find(testimonial => testimonial.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['name', 'content']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Sharh saqlandi!", "success");
        }

        function handleTestimonialImageUpload(event, id) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    updateTestimonial(id, "image", e.target.result);
                    renderTestimonials();
                };
                reader.readAsDataURL(file);
            }
        }

        function updateTestimonial(id, field, value) {
            const item = portfolioData.testimonials.find(testimonial => testimonial.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removeTestimonial(id) {
            portfolioData.testimonials = portfolioData.testimonials.filter(item => item.id !== id);
            renderTestimonials();
            saveData();
            showMessage("Sharh o'chirildi!", "success");
        }

        // Blog Management
        function addBlog() {
            const newBlog = {
                id: Date.now().toString(),
                title: "",
                content: "",
                image: "",
                date: new Date().toISOString().split("T")[0],
                category: "",
            };

            portfolioData.blog.push(newBlog);
            renderBlog();
            saveData();
        }

        function renderBlog() {
            const container = document.getElementById("blog-list");
            if (!container) return;

            container.innerHTML = "";

            portfolioData.blog.forEach(item => {
                const blogHTML = `
                <div class="dynamic-item fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Blog Title *</label>
                            <input type="text" value="${item.title}" onchange="updateBlog('${item.id}', 'title', this.value)" class="input-field" placeholder="Blog Post Title">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <input type="text" value="${item.category}" onchange="updateBlog('${item.id}', 'category', this.value)" class="input-field" placeholder="Technology">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" value="${item.date}" onchange="updateBlog('${item.id}', 'date', this.value)" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                            <input type="file" accept="image/*" onchange="handleBlogImageUpload(event, '${item.id}')" class="file-input">
                            ${item.image ? `<img src="${item.image}" alt="Blog" class="mt-2 w-full h-32 object-cover rounded">` : ""}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Blog Content *</label>
                        <textarea onchange="updateBlog('${item.id}', 'content', this.value)" rows="4" class="input-field" placeholder="Blog post content">${item.content}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="saveBlogItem('${item.id}')" class="btn-success">
                            <i class="fas fa-save mr-2"></i>Save
                        </button>
                        <button onclick="removeBlog('${item.id}')" class="btn-danger">
                            <i class="fas fa-trash mr-2"></i>Remove
                        </button>
                    </div>
                </div>
            `;
                container.innerHTML += blogHTML;
            });
        }

        function saveBlogItem(id) {
            const item = portfolioData.blog.find(blog => blog.id === id);
            if (!item) return;

            const validation = validateItemFields(item, ['title', 'content', 'category']);
            if (!validation.isValid) {
                showMessage(`Quyidagi maydonlarni to'ldiring: ${validation.errors.join(', ')}`, "error");
                return;
            }

            saveData();
            showMessage("Blog maqolasi saqlandi!", "success");
        }

        function handleBlogImageUpload(event, id) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    updateBlog(id, "image", e.target.result);
                    renderBlog();
                };
                reader.readAsDataURL(file);
            }
        }

        function updateBlog(id, field, value) {
            const item = portfolioData.blog.find(blog => blog.id === id);
            if (item) {
                item[field] = value;
            }
        }

        function removeBlog(id) {
            portfolioData.blog = portfolioData.blog.filter(item => item.id !== id);
            renderBlog();
            saveData();
            showMessage("Blog maqolasi o'chirildi!", "success");
        }

        // Render all dynamic sections
        function renderDynamicSections() {
            renderEducation();
            renderExperience();
            renderSkills();
            renderServices();
            renderPortfolio();
            renderTestimonials();
            renderBlog();
        }

        // Message System
        function showMessage(message, type = "success") {
            const container = document.getElementById("message-container");
            if (!container) return;

            const messageDiv = document.createElement("div");
            messageDiv.className = `message ${type}`;
            messageDiv.innerHTML = `
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" style="margin-left: 1rem; font-size: 1.125rem; cursor: pointer; background: none; border: none; color: inherit;">&times;</button>
            </div>
        `;

            container.appendChild(messageDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 5000);
        }
    </script>
    </body>
    </html>

</x-app-layout>
