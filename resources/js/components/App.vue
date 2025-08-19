
<template>
    
    <div class="bg-gray-50 min-h-screen">
      <!-- Header -->

      <div class="bg-white shadow-sm border-b sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
              <i class="fas fa-cog text-blue-600 text-2xl mr-3"></i>
              <h1 class="text-2xl font-bold text-gray-900">FreeFolio Admin Panel</h1>
            </div>
            <div class="flex items-center gap-3">
              <button @click="exportData" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-download mr-2"></i>Export
              </button>
              <button @click="importData" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
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
            <nav class="flex space-x-1 p-2 overflow-x-auto">
              <button 
                v-for="tab in tabs" 
                :key="tab.id"
                @click="activeTab = tab.id"
                :class="[
                  'whitespace-nowrap py-3 px-4 text-sm font-medium transition-all duration-200 flex items-center rounded-lg',
                  activeTab === tab.id 
                    ? 'bg-blue-100 text-blue-700 border-b-2 border-blue-500' 
                    : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'
                ]"
              >
                <i :class="tab.icon + ' mr-2'"></i>
                <span class="hidden sm:inline">{{ tab.name }}</span>
              </button>
            </nav>
          </div>
        </div>
  
        <!-- Profile Tab -->
        <div v-show="activeTab === 'profile'" class="bg-white rounded-lg shadow-sm border p-6">
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
                <input 
                  v-model="portfolioData.profile.name"
                  type="text" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" 
                  placeholder="Enter your full name"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Profile Image</label>
                <input 
                  @change="handleProfileImageUpload"
                  type="file" 
                  accept="image/*" 
                  class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg"
                >
                <div v-if="portfolioData.profile.image" class="mt-3">
                  <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <img :src="portfolioData.profile.image" alt="Profile" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                    <div class="text-sm text-gray-600">Profile image uploaded</div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">Professional Titles</label>
              <input 
                v-model="portfolioData.profile.title"
                type="text" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" 
                placeholder="Web Designer, Developer, etc."
              >
              <p class="text-xs text-gray-500">Separate multiple titles with commas</p>
            </div>
  
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">Professional Description</label>
              <textarea 
                v-model="portfolioData.profile.description"
                rows="4" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" 
                placeholder="Brief description about yourself and your expertise"
              ></textarea>
            </div>
  
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">CV/Resume File</label>
                <input 
                  @change="handleCvUpload"
                  type="file" 
                  accept=".pdf,.doc,.docx" 
                  class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-300 rounded-lg"
                >
                <div v-if="portfolioData.profile.cv" class="mt-2">
                  <div class="flex items-center space-x-2 p-2 bg-green-50 rounded-lg text-sm text-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>CV file uploaded</span>
                  </div>
                </div>
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Introduction Video URL</label>
                <input 
                  v-model="portfolioData.profile.video"
                  type="url" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" 
                  placeholder="https://youtube.com/embed/..."
                >
              </div>
            </div>
  
            <div class="flex justify-end pt-4">
              <button 
                @click="saveProfile" 
                :disabled="loading"
                class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center"
              >
                <i class="fas fa-save mr-2"></i>
                {{ loading ? 'Saving...' : 'Save Profile' }}
              </button>
            </div>
          </div>
        </div>
  
        <!-- About Tab -->
        <div v-show="activeTab === 'about'" class="bg-white rounded-lg shadow-sm border p-6">
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
                <input 
                  v-model="portfolioData.about.name"
                  type="text" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Birthday</label>
                <input 
                  v-model="portfolioData.about.birthday"
                  type="text" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Degree</label>
                <input 
                  v-model="portfolioData.about.degree"
                  type="text" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Experience</label>
                <input 
                  v-model="portfolioData.about.experience"
                  type="text" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
            </div>
  
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Phone</label>
                <input 
                  v-model="portfolioData.about.phone"
                  type="tel" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Email</label>
                <input 
                  v-model="portfolioData.about.email"
                  type="email" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Address</label>
                <input 
                  v-model="portfolioData.about.address"
                  type="text" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Freelance Status</label>
                <select 
                  v-model="portfolioData.about.freelance"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                >
                  <option value="Available">Available</option>
                  <option value="Busy">Busy</option>
                  <option value="Not Available">Not Available</option>
                </select>
              </div>
            </div>
  
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">About Description</label>
              <textarea 
                v-model="portfolioData.about.description"
                rows="5" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200" 
                placeholder="Write a detailed description about yourself"
              ></textarea>
            </div>
  
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">About Section Image</label>
              <input 
                @change="handleAboutImageUpload"
                type="file" 
                accept="image/*" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-gray-300 rounded-lg"
              >
              <div v-if="portfolioData.about.image" class="mt-3">
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                  <img :src="portfolioData.about.image" alt="About" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                  <div class="text-sm text-gray-600">About section image uploaded</div>
                </div>
              </div>
            </div>
  
            <div class="flex justify-end pt-4">
              <button 
                @click="saveAbout" 
                :disabled="loading"
                class="bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center"
              >
                <i class="fas fa-save mr-2"></i>
                {{ loading ? 'Saving...' : 'Save About Info' }}
              </button>
            </div>
          </div>
        </div>
  
        <!-- Education Tab -->
        <div v-show="activeTab === 'education'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-graduation-cap text-purple-600 mr-3"></i>
              Education
            </h2>
            <button 
              @click="addEducation" 
              class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Education
            </button>
          </div>
  
          <div class="space-y-4">
            <div v-if="portfolioData.education.length === 0" class="text-center py-12 text-gray-500">
              <i class="fas fa-graduation-cap text-4xl mb-4"></i>
              <p class="text-lg font-medium">No education entries yet</p>
              <p class="text-sm">Click "Add Education" to get started</p>
            </div>
  
            <div 
              v-for="(item, index) in portfolioData.education" 
              :key="item.id"
              class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                    <span class="text-purple-600 font-bold">{{ index + 1 }}</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-900">{{ item.title || 'New Education' }}</h3>
                </div>
                <div class="flex gap-2">
                  <button 
                    @click="editEducation(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-edit mr-1"></i>Edit
                  </button>
                  <button 
                    @click="deleteEducation(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-trash mr-1"></i>Delete
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                  <div class="flex items-center space-x-2">
                    <i class="fas fa-university text-purple-600"></i>
                    <span class="font-semibold text-gray-700">Institution:</span>
                    <span class="text-gray-600">{{ item.institution }}</span>
                  </div>
                  <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar text-purple-600"></i>
                    <span class="font-semibold text-gray-700">Period:</span>
                    <span class="text-gray-600">{{ item.period }}</span>
                  </div>
                </div>
                <div class="flex items-start space-x-2">
                  <i class="fas fa-info-circle text-purple-600 mt-1"></i>
                  <div>
                    <span class="font-semibold text-gray-700">Description:</span>
                    <p class="text-gray-600 mt-1">{{ item.description }}</p>
                  </div>
                </div>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <input 
                    v-model="item.title"
                    type="text" 
                    placeholder="Degree Title" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                  >
                  <input 
                    v-model="item.institution"
                    type="text" 
                    placeholder="Institution" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                  >
                </div>
                <input 
                  v-model="item.period"
                  type="text" 
                  placeholder="Period (e.g., 2018-2020)" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                >
                <textarea 
                  v-model="item.description"
                  placeholder="Description" 
                  rows="3" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                ></textarea>
                <div class="flex gap-3">
                  <button 
                    @click="saveEducation(item.id)"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-2"></i>Save Changes
                  </button>
                  <button 
                    @click="cancelEditEducation(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Experience Tab -->
        <div v-show="activeTab === 'experience'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-briefcase text-orange-600 mr-3"></i>
              Work Experience
            </h2>
            <button 
              @click="addExperience" 
              class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Experience
            </button>
          </div>
  
          <div class="space-y-4">
            <div v-if="portfolioData.experience.length === 0" class="text-center py-12 text-gray-500">
              <i class="fas fa-briefcase text-4xl mb-4"></i>
              <p class="text-lg font-medium">No work experience yet</p>
              <p class="text-sm">Click "Add Experience" to get started</p>
            </div>
  
            <div 
              v-for="(item, index) in portfolioData.experience" 
              :key="item.id"
              class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                    <span class="text-orange-600 font-bold">{{ index + 1 }}</span>
                  </div>
                  <h3 class="text-xl font-bold text-gray-900">{{ item.title || 'New Experience' }}</h3>
                </div>
                <div class="flex gap-2">
                  <button 
                    @click="editExperience(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-edit mr-1"></i>Edit
                  </button>
                  <button 
                    @click="deleteExperience(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-trash mr-1"></i>Delete
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                  <div class="flex items-center space-x-2">
                    <i class="fas fa-building text-orange-600"></i>
                    <span class="font-semibold text-gray-700">Company:</span>
                    <span class="text-gray-600">{{ item.company }}</span>
                  </div>
                  <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar text-orange-600"></i>
                    <span class="font-semibold text-gray-700">Period:</span>
                    <span class="text-gray-600">{{ item.period }}</span>
                  </div>
                </div>
                <div class="flex items-start space-x-2">
                  <i class="fas fa-tasks text-orange-600 mt-1"></i>
                  <div>
                    <span class="font-semibold text-gray-700">Responsibilities:</span>
                    <p class="text-gray-600 mt-1">{{ item.description }}</p>
                  </div>
                </div>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <input 
                    v-model="item.title"
                    type="text" 
                    placeholder="Job Title" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                  >
                  <input 
                    v-model="item.company"
                    type="text" 
                    placeholder="Company" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                  >
                </div>
                <input 
                  v-model="item.period"
                  type="text" 
                  placeholder="Period (e.g., 2020-Present)" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                >
                <textarea 
                  v-model="item.description"
                  placeholder="Job Description & Responsibilities" 
                  rows="3" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                ></textarea>
                <div class="flex gap-3">
                  <button 
                    @click="saveExperience(item.id)"
                    class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-2"></i>Save Changes
                  </button>
                  <button 
                    @click="cancelEditExperience(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Skills Tab -->
        <div v-show="activeTab === 'skills'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-code text-indigo-600 mr-3"></i>
              Skills & Expertise
            </h2>
            <button 
              @click="addSkill" 
              class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Skill
            </button>
          </div>
  
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-if="portfolioData.skills.length === 0" class="col-span-full text-center py-12 text-gray-500">
              <i class="fas fa-code text-4xl mb-4"></i>
              <p class="text-lg font-medium">No skills added yet</p>
              <p class="text-sm">Click "Add Skill" to showcase your expertise</p>
            </div>
  
            <div 
              v-for="item in portfolioData.skills" 
              :key="item.id"
              class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                  <i class="fas fa-code text-indigo-600 mr-2"></i>
                  {{ item.name || 'New Skill' }}
                </h3>
                <div class="flex gap-2">
                  <button 
                    @click="editSkill(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                  <button 
                    @click="deleteSkill(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-2xl font-bold text-indigo-600">{{ item.percentage }}%</span>
                  <div :class="`w-3 h-3 ${item.color} rounded-full`"></div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                  <div 
                    :class="`${item.color} h-3 rounded-full transition-all duration-1000 ease-out`" 
                    :style="`width: ${item.percentage}%`"
                  ></div>
                </div>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-3">
                <input 
                  v-model="item.name"
                  type="text" 
                  placeholder="Skill Name" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                <input 
                  v-model.number="item.percentage"
                  type="number" 
                  placeholder="Percentage (0-100)" 
                  min="0" 
                  max="100" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                <select 
                  v-model="item.color"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                  <option value="bg-blue-500">Blue</option>
                  <option value="bg-green-500">Green</option>
                  <option value="bg-yellow-500">Yellow</option>
                  <option value="bg-purple-500">Purple</option>
                  <option value="bg-red-500">Red</option>
                  <option value="bg-indigo-500">Indigo</option>
                  <option value="bg-pink-500">Pink</option>
                  <option value="bg-cyan-500">Cyan</option>
                  <option value="bg-orange-500">Orange</option>
                </select>
                <div class="flex gap-2">
                  <button 
                    @click="saveSkill(item.id)"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-1"></i>Save
                  </button>
                  <button 
                    @click="cancelEditSkill(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Services Tab -->
        <div v-show="activeTab === 'services'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-cogs text-teal-600 mr-3"></i>
              Services Offered
            </h2>
            <button 
              @click="addService" 
              class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Service
            </button>
          </div>
  
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div v-if="portfolioData.services.length === 0" class="col-span-full text-center py-12 text-gray-500">
              <i class="fas fa-cogs text-4xl mb-4"></i>
              <p class="text-lg font-medium">No services listed yet</p>
              <p class="text-sm">Click "Add Service" to showcase what you offer</p>
            </div>
  
            <div 
              v-for="item in portfolioData.services" 
              :key="item.id"
              class="bg-gradient-to-br from-teal-50 to-cyan-50 border border-teal-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <i :class="item.icon + ' text-teal-600 text-xl'"></i>
                  </div>
                  <h3 class="text-lg font-bold text-gray-900">{{ item.title || 'New Service' }}</h3>
                </div>
                <div class="flex gap-2">
                  <button 
                    @click="editService(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                  <button 
                    @click="deleteService(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-2 py-1 rounded-lg text-xs font-medium transition-colors duration-200"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <p class="text-gray-600 leading-relaxed">{{ item.description }}</p>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-3">
                <input 
                  v-model="item.title"
                  type="text" 
                  placeholder="Service Title" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                >
                <input 
                  v-model="item.icon"
                  type="text" 
                  placeholder="Icon Class (e.g., fas fa-laptop-code)" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                >
                <textarea 
                  v-model="item.description"
                  placeholder="Service Description" 
                  rows="3" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                ></textarea>
                <div class="flex gap-2">
                  <button 
                    @click="saveService(item.id)"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-1"></i>Save
                  </button>
                  <button 
                    @click="cancelEditService(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Portfolio Tab -->
        <div v-show="activeTab === 'portfolio'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-folder-open text-pink-600 mr-3"></i>
              Portfolio Projects
            </h2>
            <button 
              @click="addPortfolio" 
              class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Project
            </button>
          </div>
  
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-if="portfolioData.portfolio.length === 0" class="col-span-full text-center py-12 text-gray-500">
              <i class="fas fa-folder-open text-4xl mb-4"></i>
              <p class="text-lg font-medium">No portfolio projects yet</p>
              <p class="text-sm">Click "Add Project" to showcase your work</p>
            </div>
  
            <div 
              v-for="item in portfolioData.portfolio" 
              :key="item.id"
              class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300"
            >
              <div class="relative">
                <img 
                  v-if="item.image" 
                  :src="item.image" 
                  :alt="item.title" 
                  class="w-full h-48 object-cover"
                >
                <div v-else class="w-full h-48 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                  <i class="fas fa-image text-4xl text-gray-400"></i>
                </div>
                <div class="absolute top-3 right-3 flex gap-2">
                  <button 
                    @click="editPortfolio(item.id)"
                    class="bg-white bg-opacity-90 hover:bg-opacity-100 text-yellow-600 p-2 rounded-lg shadow-sm transition-all duration-200"
                  >
                    <i class="fas fa-edit"></i>
                  </button>
                  <button 
                    @click="deletePortfolio(item.id)"
                    class="bg-white bg-opacity-90 hover:bg-opacity-100 text-red-600 p-2 rounded-lg shadow-sm transition-all duration-200"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
              <div class="p-6">
                <!-- View Mode -->
                <div v-if="!item.editing">
                  <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xl font-bold text-gray-900">{{ item.title || 'New Project' }}</h3>
                    <span :class="getCategoryColor(item.category)">{{ item.category }}</span>
                  </div>
                  <p class="text-gray-600 leading-relaxed">{{ item.description }}</p>
                </div>
  
                <!-- Edit Mode -->
                <div v-else class="space-y-4">
                  <input 
                    v-model="item.title"
                    type="text" 
                    placeholder="Project Title" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                  >
                  <select 
                    v-model="item.category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                  >
                    <option value="Design">Design</option>
                    <option value="Development">Development</option>
                    <option value="Marketing">Marketing</option>
                  </select>
                  <input 
                    @change="handlePortfolioImageUpload(item.id, $event)"
                    type="file" 
                    accept="image/*" 
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer border border-gray-300 rounded-lg"
                  >
                  <textarea 
                    v-model="item.description"
                    placeholder="Project Description" 
                    rows="3" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                  ></textarea>
                  <div class="flex gap-2">
                    <button 
                      @click="savePortfolio(item.id)"
                      class="bg-pink-600 hover:bg-pink-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                    >
                      <i class="fas fa-save mr-1"></i>Save
                    </button>
                    <button 
                      @click="cancelEditPortfolio(item.id)"
                      class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Testimonials Tab -->
        <div v-show="activeTab === 'testimonials'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-comments text-yellow-600 mr-3"></i>
              Client Testimonials
            </h2>
            <button 
              @click="addTestimonial" 
              class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Testimonial
            </button>
          </div>
  
          <div class="space-y-4">
            <div v-if="portfolioData.testimonials.length === 0" class="text-center py-12 text-gray-500">
              <i class="fas fa-comments text-4xl mb-4"></i>
              <p class="text-lg font-medium">No testimonials yet</p>
              <p class="text-sm">Click "Add Testimonial" to showcase client feedback</p>
            </div>
  
            <div 
              v-for="item in portfolioData.testimonials" 
              :key="item.id"
              class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-bold text-gray-900">{{ item.name || 'New Testimonial' }}</h3>
                <div class="flex gap-2">
                  <button 
                    @click="editTestimonial(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-edit mr-1"></i>Edit
                  </button>
                  <button 
                    @click="deleteTestimonial(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-trash mr-1"></i>Delete
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <div class="flex items-start space-x-4 mb-4">
                  <img 
                    v-if="item.image" 
                    :src="item.image" 
                    :alt="item.name" 
                    class="w-16 h-16 rounded-full object-cover border-2 border-yellow-200"
                  >
                  <div v-else class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center border-2 border-yellow-200">
                    <i class="fas fa-user text-yellow-600 text-xl"></i>
                  </div>
                  <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">{{ item.name }}</h4>
                    <p class="text-sm text-yellow-600 font-medium">{{ item.profession }}</p>
                  </div>
                </div>
                <blockquote class="text-gray-700 italic leading-relaxed border-l-4 border-yellow-300 pl-4">
                  "{{ item.message }}"
                </blockquote>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <input 
                    v-model="item.name"
                    type="text" 
                    placeholder="Client Name" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                  >
                  <input 
                    v-model="item.profession"
                    type="text" 
                    placeholder="Profession/Company" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                  >
                </div>
                <input 
                  @change="handleTestimonialImageUpload(item.id, $event)"
                  type="file" 
                  accept="image/*" 
                  class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 cursor-pointer border border-gray-300 rounded-lg"
                >
                <textarea 
                  v-model="item.message"
                  placeholder="Testimonial Message" 
                  rows="4" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                ></textarea>
                <div class="flex gap-2">
                  <button 
                    @click="saveTestimonial(item.id)"
                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-1"></i>Save
                  </button>
                  <button 
                    @click="cancelEditTestimonial(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Blog Tab -->
        <div v-show="activeTab === 'blog'" class="bg-white rounded-lg shadow-sm border p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <i class="fas fa-blog text-red-600 mr-3"></i>
              Blog Posts
            </h2>
            <button 
              @click="addBlog" 
              class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i class="fas fa-plus mr-2"></i>Add Blog Post
            </button>
          </div>
  
          <div class="space-y-4">
            <div v-if="portfolioData.blog.length === 0" class="text-center py-12 text-gray-500">
              <i class="fas fa-blog text-4xl mb-4"></i>
              <p class="text-lg font-medium">No blog posts yet</p>
              <p class="text-sm">Click "Add Blog Post" to start sharing your thoughts</p>
            </div>
  
            <div 
              v-for="item in portfolioData.blog" 
              :key="item.id"
              class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-bold text-gray-900">{{ item.title || 'New Blog Post' }}</h3>
                <div class="flex gap-2">
                  <button 
                    @click="editBlog(item.id)"
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-edit mr-1"></i>Edit
                  </button>
                  <button 
                    @click="deleteBlog(item.id)"
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-trash mr-1"></i>Delete
                  </button>
                </div>
              </div>
  
              <!-- View Mode -->
              <div v-if="!item.editing">
                <div class="flex items-start space-x-4">
                  <img 
                    v-if="item.image" 
                    :src="item.image" 
                    :alt="item.title" 
                    class="w-24 h-20 object-cover rounded-lg border-2 border-red-200"
                  >
                  <div v-else class="w-24 h-20 bg-red-100 rounded-lg flex items-center justify-center border-2 border-red-200">
                    <i class="fas fa-image text-red-400 text-xl"></i>
                  </div>
                  <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                      <i class="fas fa-calendar text-red-600"></i>
                      <span class="text-sm text-red-600 font-medium">{{ item.date }}</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed">{{ item.excerpt }}</p>
                  </div>
                </div>
              </div>
  
              <!-- Edit Mode -->
              <div v-else class="space-y-4">
                <input 
                  v-model="item.title"
                  type="text" 
                  placeholder="Blog Title" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                >
                <input 
                  v-model="item.date"
                  type="date" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                >
                <input 
                  @change="handleBlogImageUpload(item.id, $event)"
                  type="file" 
                  accept="image/*" 
                  class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer border border-gray-300 rounded-lg"
                >
                <textarea 
                  v-model="item.excerpt"
                  placeholder="Excerpt/Summary" 
                  rows="2" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                ></textarea>
                <textarea 
                  v-model="item.content"
                  placeholder="Full Content" 
                  rows="6" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                ></textarea>
                <div class="flex gap-2">
                  <button 
                    @click="saveBlog(item.id)"
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center"
                  >
                    <i class="fas fa-save mr-1"></i>Save
                  </button>
                  <button 
                    @click="cancelEditBlog(item.id)"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Success/Error Messages -->
      <div class="fixed top-20 right-4 z-50 space-y-2">
        <div 
          v-for="message in messages" 
          :key="message.id"
          :class="[
            'border px-4 py-3 rounded-lg shadow-lg flex items-center justify-between transition-all duration-300',
            message.type === 'success' 
              ? 'bg-green-100 border-green-400 text-green-700' 
              : 'bg-red-100 border-red-400 text-red-700'
          ]"
        >
          <div class="flex items-center">
            <i :class="message.type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'" class="mr-2"></i>
            <span class="font-medium">{{ message.text }}</span>
          </div>
          <button @click="removeMessage(message.id)" class="ml-4 text-lg hover:opacity-70">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
  
      <!-- Loading Overlay -->
      <div v-if="loading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
          <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
          <span class="text-gray-700 font-medium">Processing...</span>
        </div>
      </div>
      
    </div>
  </template>
  
  <script setup>
  import { ref, reactive, onMounted, watch } from 'vue'
  
  // Reactive state
  const activeTab = ref('profile')
  const loading = ref(false)
  const messages = ref([])
  
  // Tab configuration
  const tabs = [
    { id: 'profile', name: 'Profile', icon: 'fas fa-user' },
    { id: 'about', name: 'About', icon: 'fas fa-info-circle' },
    { id: 'education', name: 'Education', icon: 'fas fa-graduation-cap' },
    { id: 'experience', name: 'Experience', icon: 'fas fa-briefcase' },
    { id: 'skills', name: 'Skills', icon: 'fas fa-code' },
    { id: 'services', name: 'Services', icon: 'fas fa-cogs' },
    { id: 'portfolio', name: 'Portfolio', icon: 'fas fa-folder-open' },
    { id: 'testimonials', name: 'Reviews', icon: 'fas fa-comments' },
    { id: 'blog', name: 'Blog', icon: 'fas fa-blog' }
  ]
  
  // Portfolio data
  const portfolioData = reactive({
    profile: {
      name: "Kate Winslet",
      title: "Web Designer, Web Developer, Front End Developer, Apps Designer, Apps Developer",
      description: "Creative and passionate developer with 10+ years of experience in creating beautiful and functional web solutions.",
      image: "",
      cv: "",
      video: "https://www.youtube.com/embed/DWRcNpR6Kdc"
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
      description: "I am a passionate web developer with over 10 years of experience in creating innovative digital solutions. My expertise spans across modern web technologies, responsive design, and user experience optimization.",
      image: ""
    },
    education: [
      {
        id: "1",
        title: "Master in Computer Science",
        institution: "Cambridge University",
        period: "2018 - 2020",
        description: "Advanced computer science studies focusing on software engineering, web technologies, and artificial intelligence. Graduated with distinction.",
        editing: false
      },
      {
        id: "2",
        title: "Bachelor in Computer Science",
        institution: "MIT University",
        period: "2014 - 2018",
        description: "Foundation in computer science with specialization in web development, programming languages, and database management systems.",
        editing: false
      }
    ],
    experience: [
      {
        id: "1",
        title: "Senior Web Developer",
        company: "Tech Solutions Inc",
        period: "2020 - Present",
        description: "Leading web development projects, mentoring junior developers, and implementing modern web technologies. Responsible for full-stack development and project architecture.",
        editing: false
      },
      {
        id: "2",
        title: "Web Developer",
        company: "Digital Agency",
        period: "2018 - 2020",
        description: "Developed responsive websites and web applications using modern frameworks. Collaborated with design teams to create pixel-perfect implementations.",
        editing: false
      }
    ],
    skills: [
      { id: "1", name: "HTML5", percentage: 95, color: "bg-orange-500", editing: false },
      { id: "2", name: "CSS3", percentage: 90, color: "bg-blue-500", editing: false },
      { id: "3", name: "JavaScript", percentage: 92, color: "bg-yellow-500", editing: false },
      { id: "4", name: "React", percentage: 88, color: "bg-cyan-500", editing: false },
      { id: "5", name: "Node.js", percentage: 85, color: "bg-green-500", editing: false },
      { id: "6", name: "PHP", percentage: 80, color: "bg-purple-500", editing: false }
    ],
    services: [
      {
        id: "1",
        title: "Web Design",
        icon: "fas fa-laptop-code",
        description: "Creating beautiful and functional web designs that engage users and drive conversions. Focus on modern UI/UX principles.",
        editing: false
      },
      {
        id: "2",
        title: "Web Development",
        icon: "fas fa-code",
        description: "Building responsive and dynamic websites using modern technologies and best practices. Full-stack development services.",
        editing: false
      },
      {
        id: "3",
        title: "Mobile Apps",
        icon: "fas fa-mobile-alt",
        description: "Developing cross-platform mobile applications for iOS and Android devices using React Native and Flutter.",
        editing: false
      },
      {
        id: "4",
        title: "SEO Optimization",
        icon: "fas fa-search",
        description: "Optimizing websites for search engines to improve visibility and organic traffic. Technical SEO and content optimization.",
        editing: false
      }
    ],
    portfolio: [
      {
        id: "1",
        title: "E-commerce Platform",
        category: "Development",
        image: "",
        description: "Modern e-commerce platform with payment integration, inventory management, and responsive design.",
        editing: false
      },
      {
        id: "2",
        title: "Mobile App UI Design",
        category: "Design",
        image: "",
        description: "Complete UI/UX design for fitness tracking mobile application with modern interface and user-friendly navigation.",
        editing: false
      },
      {
        id: "3",
        title: "Brand Identity Package",
        category: "Marketing",
        image: "",
        description: "Complete brand identity design including logo, business cards, and marketing materials for startup company.",
        editing: false
      }
    ],
    testimonials: [
      {
        id: "1",
        name: "John Smith",
        profession: "CEO, Tech Corp",
        message: "Excellent work quality and professional approach. Kate delivered our project on time and exceeded our expectations. Highly recommended for web development projects.",
        image: "",
        editing: false
      },
      {
        id: "2",
        name: "Sarah Johnson",
        profession: "Marketing Director",
        message: "Creative solutions and timely delivery. Great experience working with Kate on our website redesign. The results were outstanding and our conversion rates improved significantly.",
        image: "",
        editing: false
      }
    ],
    blog: [
      {
        id: "1",
        title: "Modern Web Development Trends 2024",
        date: "2024-01-15",
        image: "",
        excerpt: "Exploring the latest trends in web development and what to expect in 2024. From AI integration to new frameworks.",
        content: "The web development landscape continues to evolve rapidly. In 2024, we're seeing exciting trends that are reshaping how we build and interact with websites...",
        editing: false
      },
      {
        id: "2",
        title: "Best Practices for Responsive Design",
        date: "2024-01-10",
        image: "",
        excerpt: "Learn how to create websites that work perfectly on all devices. Essential tips for modern responsive design.",
        content: "Responsive design is no longer optional in today's multi-device world. Here are the essential practices every developer should know...",
        editing: false
      }
    ]
  })
  
  // Utility functions
  const generateId = () => Math.random().toString(36).substr(2, 9)
  
  const showMessage = (text, type = 'success') => {
    const message = {
      id: generateId(),
      text,
      type
    }
    messages.value.push(message)
    setTimeout(() => {
      removeMessage(message.id)
    }, 5000)
  }
  
  const removeMessage = (id) => {
    const index = messages.value.findIndex(msg => msg.id === id)
    if (index > -1) {
      messages.value.splice(index, 1)
    }
  }
  
  const handleFileUpload = (file) => {
    return new Promise((resolve) => {
      const reader = new FileReader()
      reader.onload = (e) => resolve(e.target.result)
      reader.readAsDataURL(file)
    })
  }
  
  // API functions for Laravel backend
  const apiCall = async (endpoint, method = 'GET', data = null) => {
    try {
      const config = {
        method,
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('auth_token') || ''}`
        }
      }
      
      if (data) {
        config.body = JSON.stringify(data)
      }
  
      const response = await fetch(`${import.meta.env.VITE_API_URL || '/api'}${endpoint}`, config)
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      
      return await response.json()
    } catch (error) {
      console.error('API call failed:', error)
      showMessage(`API call failed: ${error.message}`, 'error')
      throw error
    }
  }
  
  // Profile functions
  const saveProfile = async () => {
    loading.value = true
    try {
      await apiCall('/profile', 'PUT', portfolioData.profile)
      showMessage('Profile information saved successfully!')
    } catch (error) {
      showMessage('Failed to save profile information', 'error')
    } finally {
      loading.value = false
    }
  }
  
  const handleProfileImageUpload = async (event) => {
    const file = event.target.files[0]
    if (file) {
      portfolioData.profile.image = await handleFileUpload(file)
    }
  }
  
  const handleCvUpload = async (event) => {
    const file = event.target.files[0]
    if (file) {
      portfolioData.profile.cv = await handleFileUpload(file)
    }
  }
  
  // About functions
  const saveAbout = async () => {
    loading.value = true
    try {
      await apiCall('/about', 'PUT', portfolioData.about)
      showMessage('About information saved successfully!')
    } catch (error) {
      showMessage('Failed to save about information', 'error')
    } finally {
      loading.value = false
    }
  }
  
  const handleAboutImageUpload = async (event) => {
    const file = event.target.files[0]
    if (file) {
      portfolioData.about.image = await handleFileUpload(file)
    }
  }
  
  // Education functions
  const addEducation = () => {
    const newEducation = {
      id: generateId(),
      title: "",
      institution: "",
      period: "",
      description: "",
      editing: true
    }
    portfolioData.education.push(newEducation)
  }
  
  const editEducation = (id) => {
    const item = portfolioData.education.find(edu => edu.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditEducation = (id) => {
    const item = portfolioData.education.find(edu => edu.id === id)
    if (item) item.editing = false
  }
  
  const saveEducation = async (id) => {
    const item = portfolioData.education.find(edu => edu.id === id)
    if (item) {
      try {
        await apiCall('/education', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Education entry saved successfully!')
      } catch (error) {
        showMessage('Failed to save education entry', 'error')
      }
    }
  }
  
  const deleteEducation = async (id) => {
    if (confirm('Are you sure you want to delete this education entry?')) {
      try {
        await apiCall(`/education/${id}`, 'DELETE')
        const index = portfolioData.education.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.education.splice(index, 1)
        }
        showMessage('Education entry deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete education entry', 'error')
      }
    }
  }
  
  // Experience functions
  const addExperience = () => {
    const newExperience = {
      id: generateId(),
      title: "",
      company: "",
      period: "",
      description: "",
      editing: true
    }
    portfolioData.experience.push(newExperience)
  }
  
  const editExperience = (id) => {
    const item = portfolioData.experience.find(exp => exp.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditExperience = (id) => {
    const item = portfolioData.experience.find(exp => exp.id === id)
    if (item) item.editing = false
  }
  
  const saveExperience = async (id) => {
    const item = portfolioData.experience.find(exp => exp.id === id)
    if (item) {
      try {
        await apiCall('/experience', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Work experience saved successfully!')
      } catch (error) {
        showMessage('Failed to save work experience', 'error')
      }
    }
  }
  
  const deleteExperience = async (id) => {
    if (confirm('Are you sure you want to delete this work experience?')) {
      try {
        await apiCall(`/experience/${id}`, 'DELETE')
        const index = portfolioData.experience.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.experience.splice(index, 1)
        }
        showMessage('Work experience deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete work experience', 'error')
      }
    }
  }
  
  // Skills functions
  const addSkill = () => {
    const newSkill = {
      id: generateId(),
      name: "",
      percentage: 0,
      color: "bg-blue-500",
      editing: true
    }
    portfolioData.skills.push(newSkill)
  }
  
  const editSkill = (id) => {
    const item = portfolioData.skills.find(skill => skill.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditSkill = (id) => {
    const item = portfolioData.skills.find(skill => skill.id === id)
    if (item) item.editing = false
  }
  
  const saveSkill = async (id) => {
    const item = portfolioData.skills.find(skill => skill.id === id)
    if (item) {
      try {
        await apiCall('/skills', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Skill saved successfully!')
      } catch (error) {
        showMessage('Failed to save skill', 'error')
      }
    }
  }
  
  const deleteSkill = async (id) => {
    if (confirm('Are you sure you want to delete this skill?')) {
      try {
        await apiCall(`/skills/${id}`, 'DELETE')
        const index = portfolioData.skills.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.skills.splice(index, 1)
        }
        showMessage('Skill deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete skill', 'error')
      }
    }
  }
  
  // Services functions
  const addService = () => {
    const newService = {
      id: generateId(),
      title: "",
      icon: "fas fa-laptop-code",
      description: "",
      editing: true
    }
    portfolioData.services.push(newService)
  }
  
  const editService = (id) => {
    const item = portfolioData.services.find(service => service.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditService = (id) => {
    const item = portfolioData.services.find(service => service.id === id)
    if (item) item.editing = false
  }
  
  const saveService = async (id) => {
    const item = portfolioData.services.find(service => service.id === id)
    if (item) {
      try {
        await apiCall('/services', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Service saved successfully!')
      } catch (error) {
        showMessage('Failed to save service', 'error')
      }
    }
  }
  
  const deleteService = async (id) => {
    if (confirm('Are you sure you want to delete this service?')) {
      try {
        await apiCall(`/services/${id}`, 'DELETE')
        const index = portfolioData.services.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.services.splice(index, 1)
        }
        showMessage('Service deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete service', 'error')
      }
    }
  }
  
  // Portfolio functions
  const addPortfolio = () => {
    const newPortfolio = {
      id: generateId(),
      title: "",
      category: "Design",
      image: "",
      description: "",
      editing: true
    }
    portfolioData.portfolio.push(newPortfolio)
  }
  
  const editPortfolio = (id) => {
    const item = portfolioData.portfolio.find(portfolio => portfolio.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditPortfolio = (id) => {
    const item = portfolioData.portfolio.find(portfolio => portfolio.id === id)
    if (item) item.editing = false
  }
  
  const savePortfolio = async (id) => {
    const item = portfolioData.portfolio.find(portfolio => portfolio.id === id)
    if (item) {
      try {
        await apiCall('/portfolio', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Portfolio project saved successfully!')
      } catch (error) {
        showMessage('Failed to save portfolio project', 'error')
      }
    }
  }
  
  const deletePortfolio = async (id) => {
    if (confirm('Are you sure you want to delete this portfolio project?')) {
      try {
        await apiCall(`/portfolio/${id}`, 'DELETE')
        const index = portfolioData.portfolio.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.portfolio.splice(index, 1)
        }
        showMessage('Portfolio project deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete portfolio project', 'error')
      }
    }
  }
  
  const handlePortfolioImageUpload = async (id, event) => {
    const file = event.target.files[0]
    if (file) {
      const item = portfolioData.portfolio.find(portfolio => portfolio.id === id)
      if (item) {
        item.image = await handleFileUpload(file)
      }
    }
  }
  
  // Testimonials functions
  const addTestimonial = () => {
    const newTestimonial = {
      id: generateId(),
      name: "",
      profession: "",
      message: "",
      image: "",
      editing: true
    }
    portfolioData.testimonials.push(newTestimonial)
  }
  
  const editTestimonial = (id) => {
    const item = portfolioData.testimonials.find(testimonial => testimonial.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditTestimonial = (id) => {
    const item = portfolioData.testimonials.find(testimonial => testimonial.id === id)
    if (item) item.editing = false
  }
  
  const saveTestimonial = async (id) => {
    const item = portfolioData.testimonials.find(testimonial => testimonial.id === id)
    if (item) {
      try {
        await apiCall('/testimonials', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Testimonial saved successfully!')
      } catch (error) {
        showMessage('Failed to save testimonial', 'error')
      }
    }
  }
  
  const deleteTestimonial = async (id) => {
    if (confirm('Are you sure you want to delete this testimonial?')) {
      try {
        await apiCall(`/testimonials/${id}`, 'DELETE')
        const index = portfolioData.testimonials.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.testimonials.splice(index, 1)
        }
        showMessage('Testimonial deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete testimonial', 'error')
      }
    }
  }
  
  const handleTestimonialImageUpload = async (id, event) => {
    const file = event.target.files[0]
    if (file) {
      const item = portfolioData.testimonials.find(testimonial => testimonial.id === id)
      if (item) {
        item.image = await handleFileUpload(file)
      }
    }
  }
  
  // Blog functions
  const addBlog = () => {
    const newBlog = {
      id: generateId(),
      title: "",
      date: new Date().toISOString().split('T')[0],
      image: "",
      excerpt: "",
      content: "",
      editing: true
    }
    portfolioData.blog.push(newBlog)
  }
  
  const editBlog = (id) => {
    const item = portfolioData.blog.find(blog => blog.id === id)
    if (item) item.editing = true
  }
  
  const cancelEditBlog = (id) => {
    const item = portfolioData.blog.find(blog => blog.id === id)
    if (item) item.editing = false
  }
  
  const saveBlog = async (id) => {
    const item = portfolioData.blog.find(blog => blog.id === id)
    if (item) {
      try {
        await apiCall('/blog', 'PUT', { id, ...item })
        item.editing = false
        showMessage('Blog post saved successfully!')
      } catch (error) {
        showMessage('Failed to save blog post', 'error')
      }
    }
  }
  
  const deleteBlog = async (id) => {
    if (confirm('Are you sure you want to delete this blog post?')) {
      try {
        await apiCall(`/blog/${id}`, 'DELETE')
        const index = portfolioData.blog.findIndex(item => item.id === id)
        if (index > -1) {
          portfolioData.blog.splice(index, 1)
        }
        showMessage('Blog post deleted successfully!')
      } catch (error) {
        showMessage('Failed to delete blog post', 'error')
      }
    }
  }
  
  const handleBlogImageUpload = async (id, event) => {
    const file = event.target.files[0]
    if (file) {
      const item = portfolioData.blog.find(blog => blog.id === id)
      if (item) {
        item.image = await handleFileUpload(file)
      }
    }
  }
  
  // Data management functions
  const exportData = () => {
    const dataStr = JSON.stringify(portfolioData, null, 2)
    const dataBlob = new Blob([dataStr], { type: 'application/json' })
    const url = URL.createObjectURL(dataBlob)
    const link = document.createElement('a')
    link.href = url
    link.download = `portfolio-data-${new Date().toISOString().split('T')[0]}.json`
    link.click()
    URL.revokeObjectURL(url)
    showMessage('Portfolio data exported successfully!')
  }
  
  const importData = () => {
    const input = document.createElement('input')
    input.type = 'file'
    input.accept = '.json'
    input.onchange = (e) => {
      const file = e.target.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          try {
            const importedData = JSON.parse(e.target.result)
            Object.assign(portfolioData, importedData)
            showMessage('Portfolio data imported successfully!')
          } catch (error) {
            showMessage('Error importing data: Invalid JSON file', 'error')
          }
        }
        reader.readAsText(file)
      }
    }
    input.click()
  }
  
  const getCategoryColor = (category) => {
    const colors = {
      'Design': 'px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800',
      'Development': 'px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800',
      'Marketing': 'px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800'
    }
    return colors[category] || 'px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800'
  }
  
  // Load all data from API
  const loadAllData = async () => {
    loading.value = true
    try {
      const [profile, about, education, experience, skills, services, portfolio, testimonials, blog] = await Promise.all([
        apiCall('/profile'),
        apiCall('/about'),
        apiCall('/education'),
        apiCall('/experience'),
        apiCall('/skills'),
        apiCall('/services'),
        apiCall('/portfolio'),
        apiCall('/testimonials'),
        apiCall('/blog')
      ])
  
      Object.assign(portfolioData.profile, profile)
      Object.assign(portfolioData.about, about)
      portfolioData.education = education.map(item => ({ ...item, editing: false }))
      portfolioData.experience = experience.map(item => ({ ...item, editing: false }))
      portfolioData.skills = skills.map(item => ({ ...item, editing: false }))
      portfolioData.services = services.map(item => ({ ...item, editing: false }))
      portfolioData.portfolio = portfolio.map(item => ({ ...item, editing: false }))
      portfolioData.testimonials = testimonials.map(item => ({ ...item, editing: false }))
      portfolioData.blog = blog.map(item => ({ ...item, editing: false }))
  
      showMessage('Data loaded successfully!')
    } catch (error) {
      console.error('Failed to load data:', error)
      showMessage('Using local data - API connection failed', 'error')
    } finally {
      loading.value = false
    }
  }
  
  // Auto-save functionality
  watch(portfolioData, () => {
    localStorage.setItem('portfolioData', JSON.stringify(portfolioData))
  }, { deep: true })
  
  // Initialize
  onMounted(() => {
    // Load from localStorage first
    const savedData = localStorage.getItem('portfolioData')
    if (savedData) {
      try {
        Object.assign(portfolioData, JSON.parse(savedData))
      } catch (error) {
        console.error('Error loading saved data:', error)
      }
    }
    
    // Then try to load from API
    loadAllData()
    
    showMessage('FreeFolio Admin Panel loaded successfully!')
  })
  </script>
  
  <style scoped>
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
  
  .progress-bar {
    transition: width 0.3s ease;
  }
  </style>
  <script>
  export default {
    name: "App",
    mounted() {
      console.log("test")
    }
  }
  </script>