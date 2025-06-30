// FreeFolio Admin Panel JavaScript

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
document.addEventListener("DOMContentLoaded", () => {
    initializeTabs()
    loadData()
    setupFileUploads()
})

// Tab Management
function initializeTabs() {
    const tabButtons = document.querySelectorAll(".tab-btn")
    const tabContents = document.querySelectorAll(".tab-content")

    tabButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const targetTab = this.getAttribute("data-tab")

            // Remove active class from all buttons and contents
            tabButtons.forEach((btn) => btn.classList.remove("active"))
            tabContents.forEach((content) => content.classList.remove("active"))

            // Add active class to clicked button and corresponding content
            this.classList.add("active")
            document.getElementById(targetTab + "-tab").classList.add("active")
        })
    })
}

// Data Management
function loadData() {
    const savedData = localStorage.getItem("freefolio-data")
    if (savedData) {
        portfolioData = JSON.parse(savedData)
        populateFields()
        renderDynamicSections()
    }
}

function saveData() {
    localStorage.setItem("freefolio-data", JSON.stringify(portfolioData))
}

function populateFields() {
    // Profile fields
    document.getElementById("profile-name").value = portfolioData.profile.name || ""
    document.getElementById("profile-title").value = portfolioData.profile.title || ""
    document.getElementById("profile-description").value = portfolioData.profile.description || ""
    document.getElementById("profile-video").value = portfolioData.profile.video || ""

    // About fields
    document.getElementById("about-name").value = portfolioData.about.name || ""
    document.getElementById("about-birthday").value = portfolioData.about.birthday || ""
    document.getElementById("about-degree").value = portfolioData.about.degree || ""
    document.getElementById("about-experience").value = portfolioData.about.experience || ""
    document.getElementById("about-phone").value = portfolioData.about.phone || ""
    document.getElementById("about-email").value = portfolioData.about.email || ""
    document.getElementById("about-address").value = portfolioData.about.address || ""
    document.getElementById("about-freelance").value = portfolioData.about.freelance || "Available"
    document.getElementById("about-description").value = portfolioData.about.description || ""

    // Show image previews
    if (portfolioData.profile.image) {
        showImagePreview("profile-image-preview", portfolioData.profile.image)
    }
    if (portfolioData.about.image) {
        showImagePreview("about-image-preview", portfolioData.about.image)
    }
}

// File Upload Management
function setupFileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]')
    fileInputs.forEach((input) => {
        input.addEventListener("change", handleFileUpload)
    })
}

function handleFileUpload(event) {
    const file = event.target.files[0]
    const inputId = event.target.id

    if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
            const result = e.target.result

            // Store in data object
            if (inputId === "profile-image") {
                portfolioData.profile.image = result
                showImagePreview("profile-image-preview", result)
            } else if (inputId === "about-image") {
                portfolioData.about.image = result
                showImagePreview("about-image-preview", result)
            } else if (inputId === "profile-cv") {
                portfolioData.profile.cv = result
                showFilePreview("profile-cv-preview", file.name)
            }

            saveData()
        }
        reader.readAsDataURL(file)
    }
}

function showImagePreview(containerId, imageSrc) {
    const container = document.getElementById(containerId)
    container.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-20 h-20 object-cover rounded border">`
}

function showFilePreview(containerId, fileName) {
    const container = document.getElementById(containerId)
    container.innerHTML = `<div class="text-sm text-gray-600 mt-2"><i class="fas fa-file mr-2"></i>${fileName}</div>`
}

// Profile Management
function saveProfile() {
    portfolioData.profile.name = document.getElementById("profile-name").value
    portfolioData.profile.title = document.getElementById("profile-title").value
    portfolioData.profile.description = document.getElementById("profile-description").value
    portfolioData.profile.video = document.getElementById("profile-video").value

    saveData()
    showMessage("Profile saved successfully!", "success")
}

// About Management
function saveAbout() {
    portfolioData.about.name = document.getElementById("about-name").value
    portfolioData.about.birthday = document.getElementById("about-birthday").value
    portfolioData.about.degree = document.getElementById("about-degree").value
    portfolioData.about.experience = document.getElementById("about-experience").value
    portfolioData.about.phone = document.getElementById("about-phone").value
    portfolioData.about.email = document.getElementById("about-email").value
    portfolioData.about.address = document.getElementById("about-address").value
    portfolioData.about.freelance = document.getElementById("about-freelance").value
    portfolioData.about.description = document.getElementById("about-description").value

    saveData()
    showMessage("About information saved successfully!", "success")
}

// Education Management
function addEducation() {
    const newEducation = {
        id: Date.now().toString(),
        degree: "",
        institution: "",
        year: "",
        description: "",
    }

    portfolioData.education.push(newEducation)
    renderEducation()
    saveData()
}

function renderEducation() {
    const container = document.getElementById("education-list")
    container.innerHTML = ""

    portfolioData.education.forEach((item) => {
        const educationHTML = `
            <div class="dynamic-item fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                        <input type="text" value="${item.degree}" onchange="updateEducation('${item.id}', 'degree', this.value)" class="input-field" placeholder="Bachelor's Degree">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Institution</label>
                        <input type="text" value="${item.institution}" onchange="updateEducation('${item.id}', 'institution', this.value)" class="input-field" placeholder="University Name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <input type="text" value="${item.year}" onchange="updateEducation('${item.id}', 'year', this.value)" class="input-field" placeholder="2020-2024">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea onchange="updateEducation('${item.id}', 'description', this.value)" rows="2" class="input-field" placeholder="Description of your education">${item.description}</textarea>
                </div>
                <button onclick="removeEducation('${item.id}')" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i>Remove
                </button>
            </div>
        `
        container.innerHTML += educationHTML
    })
}

function updateEducation(id, field, value) {
    const item = portfolioData.education.find((edu) => edu.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removeEducation(id) {
    portfolioData.education = portfolioData.education.filter((item) => item.id !== id)
    renderEducation()
    saveData()
    showMessage("Education item removed!", "success")
}

// Experience Management
function addExperience() {
    const newExperience = {
        id: Date.now().toString(),
        position: "",
        company: "",
        duration: "",
        description: "",
    }

    portfolioData.experience.push(newExperience)
    renderExperience()
    saveData()
}

function renderExperience() {
    const container = document.getElementById("experience-list")
    container.innerHTML = ""

    portfolioData.experience.forEach((item) => {
        const experienceHTML = `
            <div class="dynamic-item fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                        <input type="text" value="${item.position}" onchange="updateExperience('${item.id}', 'position', this.value)" class="input-field" placeholder="Frontend Developer">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                        <input type="text" value="${item.company}" onchange="updateExperience('${item.id}', 'company', this.value)" class="input-field" placeholder="Company Name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                        <input type="text" value="${item.duration}" onchange="updateExperience('${item.id}', 'duration', this.value)" class="input-field" placeholder="2022-2024">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea onchange="updateExperience('${item.id}', 'description', this.value)" rows="2" class="input-field" placeholder="Description of your work experience">${item.description}</textarea>
                </div>
                <button onclick="removeExperience('${item.id}')" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i>Remove
                </button>
            </div>
        `
        container.innerHTML += experienceHTML
    })
}

function updateExperience(id, field, value) {
    const item = portfolioData.experience.find((exp) => exp.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removeExperience(id) {
    portfolioData.experience = portfolioData.experience.filter((item) => item.id !== id)
    renderExperience()
    saveData()
    showMessage("Experience item removed!", "success")
}

// Skills Management
function addSkill() {
    const newSkill = {
        id: Date.now().toString(),
        name: "",
        level: 50,
    }

    portfolioData.skills.push(newSkill)
    renderSkills()
    saveData()
}

function renderSkills() {
    const container = document.getElementById("skills-list")
    container.innerHTML = ""

    portfolioData.skills.forEach((item) => {
        const skillHTML = `
            <div class="dynamic-item fade-in">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                        <input type="text" value="${item.name}" onchange="updateSkill('${item.id}', 'name', this.value)" class="input-field" placeholder="JavaScript">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Level (${item.level}%)</label>
                        <input type="range" min="0" max="100" value="${item.level}" onchange="updateSkill('${item.id}', 'level', this.value)" class="w-full">
                        <div class="skill-progress mt-2">
                            <div class="skill-progress-bar" style="width: ${item.level}%"></div>
                        </div>
                    </div>
                    <button onclick="removeSkill('${item.id}')" class="btn-danger">
                        <i class="fas fa-trash mr-2"></i>Remove
                    </button>
                </div>
            </div>
        `
        container.innerHTML += skillHTML
    })
}

function updateSkill(id, field, value) {
    const item = portfolioData.skills.find((skill) => skill.id === id)
    if (item) {
        item[field] = field === "level" ? Number.parseInt(value) : value
        renderSkills() // Re-render to update progress bar
        saveData()
    }
}

function removeSkill(id) {
    portfolioData.skills = portfolioData.skills.filter((item) => item.id !== id)
    renderSkills()
    saveData()
    showMessage("Skill removed!", "success")
}

// Services Management
function addService() {
    const newService = {
        id: Date.now().toString(),
        title: "",
        description: "",
        icon: "code",
    }

    portfolioData.services.push(newService)
    renderServices()
    saveData()
}

function renderServices() {
    const container = document.getElementById("services-list")
    container.innerHTML = ""

    portfolioData.services.forEach((item) => {
        const serviceHTML = `
            <div class="dynamic-item fade-in">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Title</label>
                        <input type="text" value="${item.title}" onchange="updateService('${item.id}', 'title', this.value)" class="input-field" placeholder="Web Development">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea onchange="updateService('${item.id}', 'description', this.value)" rows="3" class="input-field" placeholder="Service description">${item.description}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                        <input type="text" value="${item.icon}" onchange="updateService('${item.id}', 'icon', this.value)" class="input-field" placeholder="code">
                    </div>
                    <button onclick="removeService('${item.id}')" class="btn-danger">
                        <i class="fas fa-trash mr-2"></i>Remove
                    </button>
                </div>
            </div>
        `
        container.innerHTML += serviceHTML
    })
}

function updateService(id, field, value) {
    const item = portfolioData.services.find((service) => service.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removeService(id) {
    portfolioData.services = portfolioData.services.filter((item) => item.id !== id)
    renderServices()
    saveData()
    showMessage("Service removed!", "success")
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
    }

    portfolioData.portfolio.push(newPortfolio)
    renderPortfolio()
    saveData()
}

function renderPortfolio() {
    const container = document.getElementById("portfolio-list")
    container.innerHTML = ""

    portfolioData.portfolio.forEach((item) => {
        const portfolioHTML = `
            <div class="dynamic-item fade-in">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                        <input type="text" value="${item.title}" onchange="updatePortfolio('${item.id}', 'title', this.value)" class="input-field" placeholder="Project Name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <input type="text" value="${item.category}" onchange="updatePortfolio('${item.id}', 'category', this.value)" class="input-field" placeholder="Web Development">
                    </div>
                    <button onclick="removePortfolio('${item.id}')" class="btn-danger">
                        <i class="fas fa-trash mr-2"></i>Remove
                    </button>
                </div>
            </div>
        `
        container.innerHTML += portfolioHTML
    })
}

function handlePortfolioImageUpload(event, id) {
    const file = event.target.files[0]
    if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
            updatePortfolio(id, "image", e.target.result)
            renderPortfolio()
        }
        reader.readAsDataURL(file)
    }
}

function updatePortfolio(id, field, value) {
    const item = portfolioData.portfolio.find((portfolio) => portfolio.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removePortfolio(id) {
    portfolioData.portfolio = portfolioData.portfolio.filter((item) => item.id !== id)
    renderPortfolio()
    saveData()
    showMessage("Portfolio item removed!", "success")
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
    }

    portfolioData.testimonials.push(newTestimonial)
    renderTestimonials()
    saveData()
}

function renderTestimonials() {
    const container = document.getElementById("testimonials-list")
    container.innerHTML = ""

    portfolioData.testimonials.forEach((item) => {
        const testimonialHTML = `
            <div class="dynamic-item fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Testimonial Content</label>
                    <textarea onchange="updateTestimonial('${item.id}', 'content', this.value)" rows="3" class="input-field" placeholder="Client testimonial content">${item.content}</textarea>
                </div>
                <button onclick="removeTestimonial('${item.id}')" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i>Remove
                </button>
            </div>
        `
        container.innerHTML += testimonialHTML
    })
}

function handleTestimonialImageUpload(event, id) {
    const file = event.target.files[0]
    if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
            updateTestimonial(id, "image", e.target.result)
            renderTestimonials()
        }
        reader.readAsDataURL(file)
    }
}

function updateTestimonial(id, field, value) {
    const item = portfolioData.testimonials.find((testimonial) => testimonial.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removeTestimonial(id) {
    portfolioData.testimonials = portfolioData.testimonials.filter((item) => item.id !== id)
    renderTestimonials()
    saveData()
    showMessage("Testimonial removed!", "success")
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
    }

    portfolioData.blog.push(newBlog)
    renderBlog()
    saveData()
}

function renderBlog() {
    const container = document.getElementById("blog-list")
    container.innerHTML = ""

    portfolioData.blog.forEach((item) => {
        const blogHTML = `
            <div class="dynamic-item fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Blog Title</label>
                        <input type="text" value="${item.title}" onchange="updateBlog('${item.id}', 'title', this.value)" class="input-field" placeholder="Blog Post Title">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Blog Content</label>
                    <textarea onchange="updateBlog('${item.id}', 'content', this.value)" rows="4" class="input-field" placeholder="Blog post content">${item.content}</textarea>
                </div>
                <button onclick="removeBlog('${item.id}')" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i>Remove
                </button>
            </div>
        `
        container.innerHTML += blogHTML
    })
}

function handleBlogImageUpload(event, id) {
    const file = event.target.files[0]
    if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
            updateBlog(id, "image", e.target.result)
            renderBlog()
        }
        reader.readAsDataURL(file)
    }
}

function updateBlog(id, field, value) {
    const item = portfolioData.blog.find((blog) => blog.id === id)
    if (item) {
        item[field] = value
        saveData()
    }
}

function removeBlog(id) {
    portfolioData.blog = portfolioData.blog.filter((item) => item.id !== id)
    renderBlog()
    saveData()
    showMessage("Blog post removed!", "success")
}

// Render all dynamic sections
function renderDynamicSections() {
    renderEducation()
    renderExperience()
    renderSkills()
    renderServices()
    renderPortfolio()
    renderTestimonials()
    renderBlog()
}

// Message System
function showMessage(message, type = "success") {
    const container = document.getElementById("message-container")
    const messageDiv = document.createElement("div")
    messageDiv.className = `message ${type} show`
    messageDiv.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg">&times;</button>
        </div>
    `

    container.appendChild(messageDiv)

    // Auto remove after 3 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.classList.remove("show")
            messageDiv.classList.add("hide")
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove()
                }
            }, 300)
        }
    }, 3000)
}

// Export/Import Functions
function exportData() {
    const dataStr = JSON.stringify(portfolioData, null, 2)
    const dataBlob = new Blob([dataStr], { type: "application/json" })
    const url = URL.createObjectURL(dataBlob)
    const link = document.createElement("a")
    link.href = url
    link.download = "freefolio-data.json"
    link.click()
    URL.revokeObjectURL(url)
    showMessage("Data exported successfully!", "success")
}

function importData(event) {
    const file = event.target.files[0]
    if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
            try {
                const importedData = JSON.parse(e.target.result)
                portfolioData = importedData
                saveData()
                populateFields()
                renderDynamicSections()
                showMessage("Data imported successfully!", "success")
            } catch (error) {
                showMessage("Error importing data. Please check the file format.", "error")
            }
        }
        reader.readAsText(file)
    }
}
